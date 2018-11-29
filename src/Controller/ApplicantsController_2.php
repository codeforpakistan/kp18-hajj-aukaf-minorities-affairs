<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Applicants Controller
 *
 * @property \App\Model\Table\ApplicantsTable $Applicants
 *
 * @method \App\Model\Entity\Applicant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
//        $this->Auth->allow(['add']);
    }

    public function isAuthorized($user) {
        if (isset($user['role_id']) && $user['role_id'] === 2) {
            $allow_user = array('dashboard', 'profile', 'add', 'services');
            if (in_array($this->request->params['action'], $allow_user)) {
                return true;
            }
        }
// Default deny
        return false;
    }

    public function index() {
        $this->paginate = [
            'contain' => ['Religions']
        ];
        $applicants = $this->paginate($this->Applicants);

        $this->set(compact('applicants'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $applicant = $this->Applicants->get($id, [
            'contain' => ['Religions', 'ApplicantAttachments', 'ApplicantHouseholdDetails', 'Applicantaddresses', 'Applicantcontacts', 'Applicantincomes', 'Applicantprofessions', 'Applies', 'ProvidedFunds']
        ]);

        $this->set('applicant', $applicant);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    private function image_validation($image_details = null) {
        $extentions = array('jpg', 'JPG', 'PNG', 'png', 'jpeg', 'JPEG', 'gif', 'GIF', 'svg', 'SVG');
        $continue = 1;
        $error = '';
        foreach ($image_details as $single_img):
            $img_ext = pathinfo($single_img['name'], PATHINFO_EXTENSION);
            if (!in_array($img_ext, $extentions)) {
                $error = 'only image can be uploaded';
                $continue = 0;
                return $error;
            }
            if ($single_img['size'] > 1000000) {
                $error = 'Image size is too big';
                $continue = 0;
                return $error;
            }
        endforeach;
        if ($continue == 1) {
            return $continue;
        }
//        exit();
    }

    public function dashboard() {
        
    }

    public function services() {
        if (isset($_GET['qualification_level'])) {
            $this->loadModel('Disciplines');
            $disciplines = $this->Disciplines->find('list', ['conditions' => ['qualification_level_id' => $_GET['qualification_level']], 'keyField' => 'id', 'valueField' => 'discipline']);
            echo json_encode($disciplines->toArray());
            exit;
        }
        if (isset($_GET['qualification_id'])) {
            $this->loadModel('Qualifications');
            $qualification = $this->Qualifications->find('all', ['conditions' => ['Qualifications.id' => $_GET['qualification_id']]])
                    ->contain([
                        'Disciplines' => function ($q) {
                            return $q
                                    ->select(['id', 'discipline', 'qualification_level_id']);
                        },
                        'Institutes' => function ($r) {
                            return $r
                                    ->select(['id', 'name', 'city_id', 'institute_sector', 'institute_type_id']);
                        }
                    ])
                    ->first()
                    ->toArray();
            if ($qualification['passing_date']) {
                $qualification['passing_date'] = date('Y-m-d', strtotime($qualification['passing_date']));
            }
            unset($qualification['created']);
            unset($qualification['modified']);
            unset($qualification['created_by']);
            unset($qualification['modified_by']);
            if ($qualification) {
                $response = json_encode($qualification);
            } else {
                $response = '';
            }
            echo $response;
            exit();
        }
    }

    public function profile() {
        $this->viewBuilder()->layout('default');
        $this->loadModel('Qualifications');
        $id = $this->Auth->user('id');
        $applicant = $this->Applicants->find('all', ['conditions' => ['user_id' => $id]])
                ->contain(['Applicantaddresses' => function ($q) {
                        return $q
                                ->order(['Applicantaddresses.id' => 'DESC'])
                                ->limit(1);
                    },
                    'Applicantcontacts' => function ($r) {
                        return $r
                                ->order(['Applicantcontacts.id' => 'DESC'])
                                ->limit(1);
                    },
                    'Applicantincomes' => function ($s) {
                        return $s
                                ->order(['Applicantincomes.id' => 'DESC'])
                                ->limit(1);
                    },
                    'ApplicantHouseholdDetails' => function ($t) {
                        return $t
                                ->order(['ApplicantHouseholdDetails.id' => 'DESC'])
                                ->limit(1);
                    },
                    'Applicantprofessions' => function ($u) {
                        return $u
                                ->order(['Applicantprofessions.id' => 'DESC'])
                                ->limit(1);
                    },
                    'Qualifications' => function ($v) {
                        return $v
                                ->contain(['Disciplines', 'Institutes', 'QualificationLevels'])
                                ->order(['Qualifications.qualification_level_id' => 'ASC']);
                    }
                ])
                ->first();
//        debug($applicant->qualifications);
//        exit();
        if (empty($applicant->qualifications)) {
            $qualification = $this->Qualifications->newEntity();
        } else {
            $qualification = $applicant->qualifications;
        }
        $religions = $this->Applicants->Religions->find('list');
        $maritalstatus = $this->Applicants->Maritalstatus->find('list');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['order' => 'name']);
        $qualificationLevels = $this->Qualifications->QualificationLevels->find('list')->toArray();
        $degreeAwardings = $this->Qualifications->DegreeAwardings->find('list')->toArray();
        $institutes = $this->Qualifications->Institutes->find('list', ['conditions' => ['type' => 'university']])->toArray();
//        debug($institutes);exit();

        $this->set(compact('applicant', 'religions', 'qualification', 'maritalstatus', 'cities', 'qualificationLevels', 'degreeAwardings', 'institutes'));
        if (isset($this->request->data['qualification'])) {
            debug($this->request->data);
            exit();
            $this->request->session()->write('qualification_info', 'save qualification details');
            if (isset($applicant->id) && !empty($applicant->id)) {

                $record_exists = $this->Qualifications->find('all', ['conditions' => ['Qualifications.applicant_id' => $applicant->id, 'Qualifications.qualification_level_id' => $this->request->data['Qualifications']['qualification_level_id']]])->count();
                if ($record_exists == 0 || !empty($this->request->data['Qualifications']['id'])) {
                    $index = 'Qualifications';
                    $save = $this->request->data[$index];
//                    if ($index == 'Qualifications') {
                    if (empty($save['institute_id']) && empty($this->request->data['Institutes']['name'])) {
                        $this->Flash->error('Invalid institute details');
                    }
                    if (!empty($this->request->data['Institutes']['name'])) {
                        $this->loadModel('Institutes');
                        $this->loadModel('QualificationLevels');
                        $institute_type = $this->QualificationLevels->get($save['qualification_level_id'], ['fields' => ['institute_type_id']]);
                        $this->request->data['Institutes']['institute_type_id'] = $institute_type->institute_type_id;
                       
                        //if institute is added by user
                        if (!empty($this->request->data['Institutes']['id'])) {
                            //if institute is added by user then he can edit the institute
                            $institute = $this->Institutes->get($this->request->data['Institutes']['id']);
                        } else {
                            // when the users adds the institute for the first time
                            $institute = $this->Institutes->newEntity();
                        }
                        $institute = $this->Institutes->patchEntity($institute, $this->request->data['Institutes']);
                        if ($this->Institutes->save($institute)) {
                            $this->request->data[$index]['institute_id'] = $institute->id;
                        }
                    }
                  // if discipline is added by user and not selected from dropdown
                    if (empty($save['discipline_id']) && empty($this->request->data['Disciplines']['discipline'])) {
                        $this->Flash->error('please provide Discipline Details');
                    }
                    if (!empty($this->request->data['Disciplines']['discipline'])) {
                        $this->loadModel('Disciplines');
                        $this->request->data['Disciplines']['qualification_level_id'] = $this->request->data[$index]['qualification_level_id'];
                        if (!empty($this->request->data['Disciplines']['id'])) {
                            $discipline = $this->Disciplines->get($this->request->data['Disciplines']['id']);
                        } else {
                            $discipline = $this->Disciplines->newEntity();
                        }
//                        debug($discipline);
//                        exit();
                        $discipline = $this->Disciplines->patchEntity($discipline, $this->request->data['Disciplines']);
                        if ($this->Disciplines->save($discipline)) {
                            $this->request->data[$index]['discipline_id'] = $discipline->id;
                        }
                    }
                    $this->request->data[$index]['applicant_id'] = $applicant->id;
                    if (!empty($this->request->data[$index]['total_marks']) && !empty($this->request->data[$index]['obtained_marks'])) {
                        if ($this->request->data[$index]['obtained_marks'] > $this->request->data[$index]['total_marks']) {
                            $this->Flash->error(__("Invalid Obatined Marks"));
//                                return;
                        }
                        $this->request->data[$index]['percentage'] = round(($this->request->data[$index]['obtained_marks'] * 100) / $this->request->data[$index]['total_marks'], 2);
                    }
                    if (!empty($this->request->data[$index]['total_cgpa']) && !empty($this->request->data[$index]['obtained_cgpa'])) {
                        if ($this->request->data[$index]['obtained_cgpa'] > $this->request->data[$index]['total_cgpa']) {
                            $this->Flash->error(__("Invalid Obatined CGPA"));
//                                return;
                        }
                    }
//                    debug($this->request->data[$index]);
//                    exit();
                    if (!empty($this->request->data[$index]['id'])) {
                        $qualification = $this->$index->get($this->request->data[$index]['id']);
//                        debug($qualification);exit();
                    }
                    $qualification = $this->$index->patchEntity($qualification, $this->request->data[$index]);

                    if ($this->$index->save($qualification)) {
                        $this->Flash->success('Qualification details has been saved');
                    }
//                    }
                } else {
                    $this->Flash->error('A record can be inserted only one time.');
                }
            } else {
                $this->Flash->error('First Enter Your Personal Informations');
//                return;
            }
        } else {
            if ($this->request->session()->read('qualification_info') != null) {
                $this->request->session()->delete('qualification_info');
            }
            if (empty($applicant)) {
                $applicant = $this->Applicants->newEntity();
            }
            if ($this->request->is(['patch', 'post', 'put'])) {
//            debug($this->request->data);
//            exit;
                $last_index = @end(array_keys($this->request->data));
                $this->request->data['Applicants']['user_id'] = $this->Auth->user('id');
                foreach ($this->request->data as $key => $save_records):
                    if ($key == 'Applicants') {
                        if (!empty($this->request->data['Applicants']['image']['name'])) {
                            $extentions = array('jpg', 'JPG', 'PNG', 'png', 'jpeg', 'JPEG', 'gif', 'GIF', 'svg', 'SVG');
                            $img_ext = pathinfo($this->request->data['Applicants']['image']['name'], PATHINFO_EXTENSION);
                            if (in_array($img_ext, $extentions)) {
                                $new_name = date('ymdhis') . '.' . $img_ext;
                                $path = WWW_ROOT . 'img' . DS . 'applicants' . DS . $new_name;
                                move_uploaded_file($this->request->data['Applicants']['image']['tmp_name'], $path);
                                $this->request->data['Applicants']['image'] = $new_name;
                            } else {
                                $this->Flash->error(__("Invalid Image Type"));
                                return;
                            }
                        } else {
                            unset($this->request->data['Applicants']['image']);
                        }
                        $applicant = $this->$key->patchEntity($applicant, $this->request->data[$key]);
//                    debug($this->request->data[$key]);exit();
                        $this->$key->save($applicant);
                        $applicant_id = $applicant->id;
                    } else {
                        $this->loadModel($key); // applicantaddress, applicantcontacts etc
                        $form_model_name = strtolower($key); // this will be the name of model comes in the form
                        if ($key == 'ApplicantHouseholdDetails') {
                            $form_model_name = 'applicant_household_details';
                        }
                        $new_rec = $this->request->data[$key]; //the data coming from form
                        $changes_occurs = 1; // applicant does'nt changed any thing
//saving new record & checking eighter the users did any changes in their contact or address
                        if (!empty($applicant[$form_model_name]) || $applicant[$form_model_name] <> null) {
                            $m = $applicant->$form_model_name;
                            $update_rec = $m[0]->toArray(); // if data is changed then update the record
                            foreach ($new_rec as $address_key => $address_value):
                                if ($new_rec[$address_key] != $update_rec[$address_key]) {
                                    $changes_occurs = 0; // if changes had occured then break the loop and save new rec
                                    break;
                                }
                            endforeach;
                        } else {
                            $changes_occurs = 0;
                        }
                        if ($changes_occurs == 0) {
                            $child_table = $this->$key->newEntity();
                            $new_rec['applicant_id'] = $applicant_id;
                            $child_table = $this->$key->patchEntity($child_table, $new_rec);
                            if (!$this->$key->save($child_table)) {
                                debug($key);
                                debug($child_table);
                                exit();
                            }
                        }
                    }
                    if ($key == $last_index) {
                        $this->Flash->success(__('Your Record has been saved successfully'));
                        return $this->redirect(['controller' => 'Applicants', 'action' => 'profile']);
                    }
                endforeach;
            }
//            $this->set(compact('applicant'));
        }
    }

    public function add() {
        $applicant = $this->Applicants->newEntity();
        if ($this->request->is('post')) {
            $last_key = @end(array_keys($this->request->data));
//            debug($this->request->data);
//            exit();
            if ($this->request->data['ApplicantAttachments']['attachments'][0]['name'] <> '') {
                $valid_image = $this->image_validation($this->request->data['ApplicantAttachments']['attachments']);
                if ($valid_image == 1) {
                    foreach ($this->request->data as $key => $save_records):
                        if ($key == 'Applicants') {
                            $applicant = $this->$key->patchEntity($applicant, $save_records);

                            $this->$key->save($applicant);
                            $applicant_id = $applicant->id;
                        } else {
                            if ($key == 'ApplicantAttachments') {
                                $this->loadModel($key);
                                $save_attachment = array();
                                foreach ($save_records['attachments'] as $subkey => $u_img):
//                                    debug($key);
                                    $get_ext = pathinfo($u_img['name'], PATHINFO_EXTENSION);

                                    $new_name = $subkey . '-' . date('ymdhis') . '.' . $get_ext;
                                    $path = WWW_ROOT . 'img' . DS . 'applicants' . DS . $new_name;

                                    move_uploaded_file($u_img['tmp_name'], $path);

                                    $save_attachment[$subkey]['applicant_id'] = $applicant_id;
                                    $save_attachment[$subkey]['attachments'] = $new_name;
                                endforeach;
                                $attachments_details = $this->$key->newEntities($save_attachment);
                                $result = $this->$key->saveMany($attachments_details);
                            } else {
                                if ($key != 'continue' && $key != 'save') {
                                    $this->loadModel($key);
                                    $child_table = $this->$key->newEntity();
                                    $save_records['applicant_id'] = $applicant_id;
                                    $child_table = $this->$key->patchEntity($child_table, $save_records);
                                    $this->$key->save($child_table);
                                }
                            }
                        }
                        if ($key == $last_key) {
                            if (isset($this->request->data['save'])) {
                                $this->Flash->success(__('The applicant has been saved.'));
                                return $this->redirect(['controller' => 'Applies', 'action' => 'add', $applicant_id]);
                            }
                            if (isset($this->request->data['continue'])) {
//                                $this->Flash->success(__('The applicant has been saved.'));
                                return $this->redirect(['controller' => 'Qualifications', 'action' => 'add', $applicant_id]);
                            }
                        }
                    endforeach;
                } else {
//                    echo $valid_image;
                    $this->Flash->error(__($valid_image));
                }
            }
        }
        $religions = $this->Applicants->Religions->find('list');
        $maritalstatus = $this->Applicants->Maritalstatus->find('list');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['order' => 'name']);


        $this->set(compact('applicant', 'religions', 'maritalstatus', 'cities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $applicant = $this->Applicants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicant = $this->Applicants->patchEntity($applicant, $this->request->getData());
            if ($this->Applicants->save($applicant)) {
                $this->Flash->success(__('The applicant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
        }
        $religions = $this->Applicants->Religions->find('list', ['limit' => 200]);
        $this->set(compact('applicant', 'religions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $applicant = $this->Applicants->get($id);
        if ($this->Applicants->delete($applicant)) {
            $this->Flash->success(__('The applicant has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

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
        $this->Auth->allow(['add', 'services', 'printform']);
    }

    public function isAuthorized($user) {
//        if (isset($user['role_id']) && $user['role_id'] === 2) {
//            $allow_user = array('dashboard', 'profile', 'add', 'services');
//            if (in_array($this->request->params['action'], $allow_user)) {
//                return true;
//            }
//        }
        if (isset($user['role_id']) && $user['role_id'] === 3) {
            $allow_user = array('dashboard', 'add', 'services', 'addapplicant', 'edit', 'delete', 'allstudents');
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
                $error = 'only image can be uploaded<br/>';
                $continue = 0;
                return $error;
            }
            if ($single_img['size'] > 2097152) {
                $error = 'Image size is too big<br/>';
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
        $this->loadModel('IsApplicable');
        $this->loadModel('Funds');
        $applicant = $this->Applicants->find('all', ['conditions' => ['Applicants.user_id' => $this->Auth->user('id')]])
                ->contain(['ApplicantAttachments',
                    'Religions',
                    'Maritalstatus',
                    'Applicantaddresses' => function ($q) {
                        return $q
                                ->contain(['cities'])
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
                ])
                ->first();
//debug($applicant->id);exit;
        if (!empty($applicant)) {

            $applicable = $this->IsApplicable->find('all', ['conditions' => ['maritalstatus_id' => $applicant->maritalstatus_id]]);
            $applicable_array = array();
            foreach ($applicable as $a):
                array_push($applicable_array, $a->sub_category_id);
            endforeach;
            $a = $applicant->id;
            $funds = $this->Funds->find('all')
                    ->contain(['SubCategories',
                        'ApplicantFunddetails' => function ($q) use ($a) {
                            return $q->where(['ApplicantFunddetails.applicant_id' => $a]);
                        },
                    ])
                    ->where(['Funds.sub_category_id IN' => $applicable_array, 'active' => '1', 'last_date >=' => date('Y-m-d')]);

            if ($this->request->is(['patch', 'post', 'put'])) {

                $applicant_id = $applicant->id;
//                debug($this->request->data);
//                exit();
                if (!empty($this->request->data['ApplicantAttachments']['attachments'][0]['name'])) {

                    $valid_image = $this->image_validation($this->request->data['ApplicantAttachments']['attachments']);
                    if ($valid_image == 1) {
                        $this->loadModel('ApplicantAttachments');
                        if (!empty($applicant->applicant_attachments)) {
                            foreach ($applicant->applicant_attachments as $attach):
                                if (!empty($attach->attachments) && file_exists(WWW_ROOT . 'img' . DS . 'applicant_documents' . DS . $attach->attachments)) {
                                    unlink(WWW_ROOT . 'img' . DS . 'applicant_documents' . DS . $attach->attachments);
                                }
                            endforeach;
                            $del = $this->ApplicantAttachments->deleteAll(['applicant_id' => $applicant->id]);
                        }
                        $save_attachment = array();
                        foreach ($this->request->data['ApplicantAttachments']['attachments'] as $subkey => $u_img):
                            $get_ext = pathinfo($u_img['name'], PATHINFO_EXTENSION);
                            $new_name = $subkey . '-' . date('ymdhis') . '.' . $get_ext;
                            $path = WWW_ROOT . 'img' . DS . 'applicant_documents' . DS . $new_name;
                            move_uploaded_file($u_img['tmp_name'], $path);
                            $save_attachment[$subkey]['applicant_id'] = $applicant_id;
                            $save_attachment[$subkey]['attachments'] = $new_name;
                            $save_attachment[$subkey]['sub_category_id'] = $this->request->data['ApplicantFunddetails']['sub_category_id'];
                        endforeach;


                        $attachments_details = $this->ApplicantAttachments->newEntities($save_attachment);
//                        debug($attachments_details);exit;
                        $result = $this->ApplicantAttachments->saveMany($attachments_details);
                    } else {
                        $this->Flash->error($valid_image);
                    }
                } else {
                    $this->Flash->error("Please Provide Attachments");
                }

                if (!empty($this->request->data['ApplicantFunddetails']['sub_category_id'])) {
                    $this->loadModel('ApplicantFunddetails');
                    $this->request->data['ApplicantFunddetails']['applicant_id'] = $applicant->id;
                    $this->request->data['ApplicantFunddetails']['appling_date'] = date('Y-m-d');
                    $ApplicantFunddetails = $this->ApplicantFunddetails->newEntity();
                    $ApplicantFunddetails = $this->ApplicantFunddetails->patchEntity($ApplicantFunddetails, $this->request->data['ApplicantFunddetails']);
                    if ($this->ApplicantFunddetails->save($ApplicantFunddetails)) {
                        $this->Flash->success('Your request has been sent');
                    } else {
                        $this->Flash->error('Request can not be processed please try again');
                    }
                }
            }
        }
//debug($applicant);exit;

        $this->set(compact('funds', 'applicant'));
    }

    public function services() {
        $this->viewBuilder()->layout('');
        if (isset($_GET['fund_expired'])) {
            $this->loadModel('Funds');
            $funds = $this->Funds->find('all')
                    ->where(['id' => $_GET['fund_expired'], 'active' => '1', 'last_date >=' => date('Y-m-d'),])
                    ->first();

            if ($funds) {
                $res = 1;
            } else {
                $res = 0;
            }
            if ($this->Auth->user('role_id') == 1 || $this->Auth->user('role_id') == 2) {
                $res = 1;
            }
            echo json_encode($res);
            exit;
        }
        if (isset($_GET['fund_subcategory'])) {
            $this->loadModel('Funds');
            $funds = $this->Funds->find('all')
                    ->contain('SubCategories')
                    ->where(['Funds.id' => $_GET['fund_subcategory']])
                    ->first();

            echo json_encode($funds->sub_category->id);
            exit;
        }
        if (isset($_GET['fund_id'])) {
            $this->loadModel('Funds');
            $funds = $this->Funds->find('all')
                    ->contain('SubCategories')
                    ->where(['Funds.id' => $_GET['fund_id']])
                    ->first();
            echo json_encode($funds->sub_category->description);
            exit;
        }
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
        if (isset($_GET['attachments'])) {
            $this->loadModel('SubCategories');
            $get_description = $this->SubCategories->get($_GET['attachments'], ['fields' => ['description']]);
            echo json_encode($get_description->description);
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
//        if (empty($applicant->qualifications)) {
//            $qualification = $this->Qualifications->newEntity();
//        }
        $religions = $this->Applicants->Religions->find('list');
        $maritalstatus = $this->Applicants->Maritalstatus->find('list');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['order' => 'name']);
        $qualificationLevels = $this->Qualifications->QualificationLevels->find('list')->toArray();
        $degreeAwardings = $this->Qualifications->DegreeAwardings->find('list')->toArray();
        $institutes = $this->Qualifications->Institutes->find('list', ['conditions' => ['type' => 'university']])->toArray();

        $this->set(compact('applicant', 'religions', 'qualification', 'maritalstatus', 'cities', 'qualificationLevels', 'degreeAwardings', 'institutes'));
        if (isset($this->request->data['qualification'])) {

//            $this->request->session()->write('qualification_info', 'save qualification details');
            if (isset($applicant->id) && !empty($applicant->id)) {
                $edit_id = 0;
                if (!empty($this->request->data['Qualifications']['id'])) {
                    $edit_id = $this->request->data['Qualifications']['id'];
                }
                $record_exists = $this->Qualifications->find('all', ['conditions' => ['Qualifications.applicant_id' => $applicant->id, 'Qualifications.qualification_level_id' => $this->request->data['Qualifications']['qualification_level_id'], 'Qualifications.id !=' => $this->request->data['Qualifications']['id']]])->count();

                if ($record_exists == 0) {
                    $index = 'Qualifications';
                    $save = $this->request->data[$index];
//                    if ($index == 'Qualifications') {
                    if (empty($save['institute_id']) && empty($this->request->data['Institutes']['name'])) {
                        $this->Flash->error('Invalid institute details');
                    }
                    if (!empty($this->request->data[$index]['total_marks']) && !empty($this->request->data[$index]['obtained_marks'])) {
                        if ($this->request->data[$index]['obtained_marks'] > $this->request->data[$index]['total_marks']) {
                            $this->Flash->error(__("Invalid Obatined Marks"));
                        }
                        $this->request->data[$index]['percentage'] = round(($this->request->data[$index]['obtained_marks'] * 100) / $this->request->data[$index]['total_marks'], 2);
                    }
                    if (!empty($this->request->data[$index]['total_cgpa']) && !empty($this->request->data[$index]['obtained_cgpa'])) {
                        if ($this->request->data[$index]['obtained_cgpa'] > $this->request->data[$index]['total_cgpa']) {
                            $this->Flash->error(__("Invalid Obatined CGPA"));
                        }
                    }
                    if (empty($save['discipline_id']) && empty($this->request->data['Disciplines']['discipline'])) {
                        $this->Flash->error('please provide Discipline Details');
                    }


                    $this->loadModel('Institutes');
                    if (!empty($this->request->data['Institutes']['id'])) {
                        $del_institute = $this->Institutes->get($this->request->data['Institutes']['id']);
                        $this->Institutes->delete($del_institute);
                        unset($this->request->data['Institutes']['id']);
                    }
                    if (!empty($this->request->data['Institutes']['name'])) {
                        $this->loadModel('QualificationLevels');
                        $institute_type = $this->QualificationLevels->get($save['qualification_level_id'], ['fields' => ['institute_type_id']]);
                        $this->request->data['Institutes']['institute_type_id'] = $institute_type->institute_type_id;
                        $institute = $this->Institutes->newEntity();
                        $institute = $this->Institutes->patchEntity($institute, $this->request->data['Institutes']);
                        if ($this->Institutes->save($institute)) {
                            $this->request->data[$index]['institute_id'] = $institute->id;
                        }
                    }


                    $this->loadModel('Disciplines');
                    if (!empty($this->request->data['Disciplines']['id'])) {
                        $del_discipline = $this->Disciplines->get($this->request->data['Disciplines']['id']);
                        $this->Disciplines->delete($del_discipline);
                        unset($this->request->data['Disciplines']['id']);
                    }
                    if (!empty($this->request->data['Disciplines']['discipline'])) {

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


//                    debug($qualification);
//                    exit();
                    if (!empty($this->request->data[$index]['id'])) {
                        $qualification = $this->$index->get($this->request->data[$index]['id']);
//                        debug($qualification);exit();
                    } else {
                        $qualification = $this->Qualifications->newEntity();
                    }
                    $qualification = $this->$index->patchEntity($qualification, $this->request->data[$index]);

                    if ($this->$index->save($qualification)) {
                        $this->Flash->success('Qualification details has been saved');
                        $this->redirect(['action' => 'profile?success=1']);
                    }
//                    }
                } else {
                    $this->Flash->error('A record can be inserted only one time.');
                }
            } else {
                $this->Flash->error('First Enter Your Personal Informations');
            }
        } else {
//            if ($this->request->session()->read('qualification_info') != null) {
//                $this->request->session()->delete('qualification_info');
//            }
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

    public function addapplicant($instituteclass = null, $fund_id = null) {
        $decodefund_id = base64_decode(base64_decode($fund_id));
//                debug($decodefund_id);exit;

        $this->loadModel('Institutes');
        $this->loadModel('Instituteclasses');
        $class = $this->Instituteclasses->get($instituteclass, ['contain' => ['SchoolClasses']]);
//        debug();exit();

        $institute = $this->Institutes->find('all')
                ->where(['user_id' => $this->Auth->user('id')])
                ->first();

        if ($institute->id != $class->institute_id) {
            $this->Flash->error(__('You are not authorize to access that location'));
            return $this->redirect(['controller' => 'instituteclasses', 'action' => 'index', $fund_id]);
        }

        $this->loadModel('InstituteFunddetails');
        $this->loadModel('Funds');

        $religions = $this->Applicants->Religions->find('list');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['order' => 'name'])->toArray();

        $applicant = $this->Applicants->newEntity();

        $class_applicants = $this->Applicants->find('all')
                ->contain(['Applicantaddresses', 'Applicantcontacts', 'Religions'])
                ->where(['instituteclass_id' => $instituteclass]);

        $institutefunddetails = $this->InstituteFunddetails->find();
        $funds = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['sub_category_id' => 3, 'active' => '1', 'last_date >=' => date('Y-m-d')]);
//        debug($funds->toArray());
//        exit();

        $this->set(compact('applicant', 'religions', 'cities', 'class_applicants', 'funds', 'class'));
        if ($this->request->is(['patch', 'post', 'put'])) {
//            debug($this->request->data);
//            exit;
            extract($this->request->data);
            $check = $this->InstituteFunddetails->find('all')
                    ->contain(['Applicants'])
                    ->where(['InstituteFunddetails.fund_id' => $decodefund_id, 'Applicants.cnic LIKE' => $Applicants['cnic']])
                    ->count();

//            debug($check);
//            exit();
            if ($check === 0) {
                $Applicants['instituteclass_id'] = $instituteclass;
                $applicant = $this->Applicants->patchEntity($applicant, $Applicants);
                $this->Applicants->save($applicant);


                if ($Applicantcontacts['mob_number'] <> '') {
                    $this->loadModel('Applicantcontacts');
                    $Applicantcontacts['applicant_id'] = $applicant->id;
                    $applicantcontacts = $this->Applicantcontacts->newEntity($Applicantcontacts);
                    $this->Applicantcontacts->save($applicantcontacts);
//                debug($applicantcontacts);
                }
                if ($Applicantaddresses['current_address'] <> '') {
                    $this->loadModel('Applicantaddresses');
                    $Applicantaddresses['applicant_id'] = $applicant->id;
                    $applicantaddresses = $this->Applicantaddresses->newEntity($Applicantaddresses);
                    $this->Applicantaddresses->save($applicantaddresses);
                }
                $InstituteFunddetails = array();
                $InstituteFunddetails['applicant_id'] = $applicant->id;
                $InstituteFunddetails['appling_date'] = date('Y-m-d');
                $InstituteFunddetails['fund_id'] = $decodefund_id;
                $institutefunddetails = $this->InstituteFunddetails->newEntity($InstituteFunddetails);

                $institutefunddetails = $this->InstituteFunddetails->save($institutefunddetails);
                if ($institutefunddetails) {
                    $this->Flash->success(__('Your Record has been saved successfully'));
                    return $this->redirect(['controller' => 'Applicants', 'action' => 'addapplicant', $instituteclass, $fund_id]);
                }
            } else {
                $this->Flash->error(__('Record can not be entered multiple time'));
                return $this->redirect(['controller' => 'Applicants', 'action' => 'addapplicant', $instituteclass, $fund_id]);
            }
        }
    }

    public function allstudents($fund_id = null) {
        $decodefund_id = base64_decode(base64_decode($fund_id));
        $this->loadModel('Users');
        $institute_id = $this->Users->get($this->Auth->user('id'), ['contain' => ['Institutes']]);

        $conn = ConnectionManager::get('default');
        $povertybase = $conn->execute(
                'SELECT ifd.id as ifd_id,ifd.appling_date,i.id as institute_id,sc.class_number,ap.name as app_name,ap.father_name,ap.cnic,ap.gender,ap.domicile,c.name as city_name,r.religion_name,aad.current_address,aad.permenent_address,aad.postal_address,ac.mob_number'
                . ' FROM institute_funddetails as ifd '
                . 'inner join applicants as ap ON ap.id=ifd.applicant_id '
                . 'join religions as r ON r.id=ap.religion_id '
                . 'join applicantaddresses aad ON aad.applicant_id=ap.id '
                . 'join applicantcontacts ac ON ac.applicant_id=ap.id '
                . 'join cities as c ON c.id=aad.city_id '
                . 'join funds as f ON ifd.fund_id=f.id '
                . 'join instituteclasses as ic ON ic.id=ap.instituteclass_id '
                . 'join school_classes as sc ON sc.id=ic.school_class_id '
                . 'join institutes as i ON i.id=ic.institute_id '
                . 'where i.id= ' . $institute_id['institutes'][0]['id'] . ' AND ifd.fund_id= ' . $decodefund_id);
        $results = $povertybase->fetchAll('assoc');
//        debug($results);
//        exit();

        $this->set(compact('results'));


//                debug($decodefund_id);exit;
//        $this->loadModel('Institutes');
//        $this->loadModel('Instituteclasses');
//        $class = $this->Instituteclasses->get($instituteclass, ['contain' => ['SchoolClasses']]);
//        debug();exit();
//        $institute = $this->Institutes->find('all')
//                ->where(['user_id' => $this->Auth->user('id')])
//                ->first();
//        if ($institute->id != $class->institute_id) {
//            $this->Flash->error(__('You are not authorize to access that location'));
//            return $this->redirect(['controller' => 'instituteclasses', 'action' => 'index', $fund_id]);
//        }
    }

    public function add_old() {
        $applicant = $this->Applicants->newEntity();
        if ($this->request->is('post')) {
            $last_key = @end(array_keys($this->request->data));
            debug($this->request->data);
            exit();
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

    public function add_10aug() {
        $this->loadModel('Funds');
        $funds = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['active' => '1', 'last_date >=' => date('Y-m-d')]);

        $this->set(compact('funds'));
        $applicant = $this->Applicants->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
//            debug($this->request->data);exit();
            $last_index = @end(array_keys($this->request->data));
//            $this->request->data['Applicants']['user_id'] = $this->Auth->user('id');
            foreach ($this->request->data as $key => $save_records):
                if ($key == 'Applicants') {
                    if (!empty($this->request->data['Applicants']['cnic'])) {
                        $check_if_exists = $this->Applicants->find('all', ['conditions' => ['Applicants.cnic LIKE' => $this->request->data['Applicants']['cnic']]])
                                ->contain([
                                    'ApplicantAttachments',
                                    'Applicantaddresses' => function ($q) {
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
                                ])
                                ->first();

//                       debug($check_if_exists->toArray());
                        if (!empty($check_if_exists) || $check_if_exists <> null) {
                            $applicant = $check_if_exists;
                        }
                    } else {
                        $this->Flash->error('CNIC can not be emty');
                    }
                    $applicant = $this->$key->patchEntity($applicant, $this->request->data[$key]);
//                    debug($applicant);
//                    exit();
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
                        if ($key != 'ApplicantFunddetails') {
                            if ($key == 'ApplicantAttachments') {
                                if (!empty($this->request->data['ApplicantAttachments']['attachments'][0]['name'])) {

                                    $valid_image = $this->image_validation($this->request->data['ApplicantAttachments']['attachments']);
                                    if ($valid_image == 1) {
                                        $this->loadModel('ApplicantAttachments');
                                        if (!empty($applicant->applicant_attachments)) {
                                            foreach ($applicant->applicant_attachments as $attach):
                                                if (!empty($attach->attachments) && file_exists(WWW_ROOT . 'img' . DS . 'applicant_documents' . DS . $attach->attachments)) {
                                                    unlink(WWW_ROOT . 'img' . DS . 'applicant_documents' . DS . $attach->attachments);
                                                }
                                            endforeach;
                                            $del = $this->ApplicantAttachments->deleteAll(['applicant_id' => $applicant->id]);
                                        }
                                        $save_attachment = array();
                                        foreach ($this->request->data['ApplicantAttachments']['attachments'] as $subkey => $u_img):
                                            $get_ext = pathinfo($u_img['name'], PATHINFO_EXTENSION);
                                            $new_name = $subkey . '-' . date('ymdhis') . '.' . $get_ext;
                                            $path = WWW_ROOT . 'img' . DS . 'applicant_documents' . DS . $new_name;
                                            move_uploaded_file($u_img['tmp_name'], $path);
                                            $save_attachment[$subkey]['applicant_id'] = $applicant_id;
                                            $save_attachment[$subkey]['attachments'] = $new_name;
//                                    $save_attachment[$subkey]['sub_category_id'] = $this->request->data['ApplicantFunddetails']['sub_category_id'];
                                        endforeach;


                                        $attachments_details = $this->ApplicantAttachments->newEntities($save_attachment);
//                        debug($attachments_details);exit;
                                        $result = $this->ApplicantAttachments->saveMany($attachments_details);
                                    } else {
                                        $this->Flash->error($valid_image);
                                    }
                                } else {
                                    $this->Flash->error("Please Provide Attachments");
                                }
                            } else {
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
                    }
                }
//                no apply for fund
                if ($key == $last_index) {
                    $this->loadModel('ApplicantFunddetails');
                    $ApplicantFunddetails = $this->ApplicantFunddetails->newEntity();
                    if ($this->request->data['ApplicantFunddetails']) {
                        $this->request->data['ApplicantFunddetails']['applicant_id'] = $applicant_id;
                        $this->request->data['ApplicantFunddetails']['appling_date'] = date('Y-m-d');
                        $ApplicantFunddetails = $this->ApplicantFunddetails->patchEntity($ApplicantFunddetails, $this->request->data['ApplicantFunddetails']);
                        $this->ApplicantFunddetails->save($ApplicantFunddetails);
                    }
                    $this->Flash->success(__('Your Record has been saved successfully'));
                    return $this->redirect(['controller' => 'Applicants', 'action' => 'add']);
                }
            endforeach;
        }
        $religions = $this->Applicants->Religions->find('list');
        $maritalstatus = $this->Applicants->Maritalstatus->find('list');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['order' => 'name']);


        $this->set(compact('applicant', 'religions', 'maritalstatus', 'cities'));
    }

    public function printform() {
//        debug(WWW_ROOT.'img'.DS.'logo.png');

        $this->viewBuilder()->layout('');
        $id = $this->request->session()->read('token');
        if ($id) {
            $conn = ConnectionManager::get('default');
            $povertybase = $conn->execute(
                    'SELECT af.id as af_id,f.fund_name as fund_name,ins.name as ins_name,ins.city_id as ins_city,q.total_marks,q.obtained_marks,total_cgpa,obtained_cgpa,q.grading_system,q.percentage,q.passing_date,q.recent_class,q.current_class,d.discipline,ql.name as qualification_name,sub_cat.id as sub_cat_id,sub_cat.description,af.appling_date,ap.name as app_name,ap.father_name,ap.cnic,ap.gender,ap.disease,ap.dname,ap.clinic_address,gname,gcnic,gfather_name,gcontact,dcontact,ms.status,ahd.dependent_family_members,ai.monthly_income,c.name as city_name,r.religion_name,aad.current_address,aad.permenent_address,aad.postal_address,ac.mob_number,apro.profession'
                    . ' FROM applicant_funddetails as af '
                    . 'inner join applicants as ap ON ap.id=af.applicant_id '
                    . 'left join applicant_household_details as ahd ON ahd.applicant_id=ap.id '
                    . 'join religions as r ON r.id=ap.religion_id '
                    . 'left join applicantincomes as ai ON ai.applicant_id=ap.id '
                    . 'left join maritalstatus as ms ON ms.id = ap.maritalstatus_id '
                    . 'join applicantaddresses aad ON aad.applicant_id=ap.id '
                    . 'left join applicantcontacts ac ON ac.applicant_id=ap.id '
                    . 'left join applicantprofessions apro ON apro.applicant_id=ap.id '
                    . 'join cities as c ON c.id=aad.city_id '
                    . 'join funds as f ON af.fund_id=f.id '
                    . 'join sub_categories as sub_cat ON f.sub_category_id=sub_cat.id '
                    . 'left join qualifications as q ON q.applicant_id=ap.id '
                    . 'left join institutes as ins ON q.institute_id=ins.id '
                    . 'left join qualification_levels as ql ON ql.id=q.qualification_level_id '
                    . 'left join disciplines as d ON d.id=q.discipline_id '
                    . 'where af.id = ' . $id);
            $results = $povertybase->fetchAll('assoc');
//            debug($results);
//            exit();
            $this->set(compact('results'));
//            $this->request->session()->delete('token');
        } else {
            $this->Flash->error("you can not access this location");
            $this->redirect('/');
        }
//        debug($results);
//        exit;
    }

    public function validation($record = null) {
        $error_msg = '';

        if (empty($record['Applicants']['name']) || preg_match('~[0-9]~', $record['Applicants']['name']) || preg_match("/([%\$#\*]+)/", $record['Applicants']['name'])) {
            $error_msg .= "Invalid Name<br/>";
        }
        if (empty($record['Applicants']['father_name']) || preg_match('~[0-9]~', $record['Applicants']['father_name']) || preg_match("/([%\$#\*]+)/", $record['Applicants']['father_name'])) {
            $error_msg .= 'Invalid Father Name<br/>';
        }
        if (isset($record['Applicantprofessions']['profession'])) {
            if (empty($record['Applicantprofessions']['profession']) || preg_match('~[0-9]~', $record['Applicantprofessions']['profession']) || preg_match("/([%\$#\*]+)/", $record['Applicantprofessions']['profession'])) {
                $error_msg .= 'Invalid Profession<br/>';
            }
        }

        if (isset($record['Applicantincomes']['monthly_income']) && !preg_match('~[0-9]~', $record['Applicantincomes']['monthly_income'])) {
            $error_msg .= 'Invalid Income<br/>';
        }
        if (isset($record['ApplicantHouseholdDetails']['dependent_family_members']) && !preg_match('~[0-9]~', $record['ApplicantHouseholdDetails']['dependent_family_members'])) {
            $error_msg .= 'Invalid Households detail<br/>';
        }
//        if (!empty($record['ApplicantAttachments']['attachments'][0]['name'])) {
//            $valid_image = $this->image_validation($record['ApplicantAttachments']['attachments']);
//            if ($valid_image != 1) {
//                $error_msg .= $valid_image;
//            }
//        }
//        debug($error_msg);exit;
        return $error_msg;
    }

    public function add() {
//        exit;
        $this->viewBuilder()->layout('new_applicant');
        $this->loadModel('Funds');
        $funds = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['active' => '1'])
                ->order(['last_date DESC']);
        $last_date = $this->Funds->find('all')
                ->where(['active' => '1', 'last_date >=' => date('Y-m-d')])
                ->order(['last_date DESC']);
        $this->loadModel('Qualifications');

        $qualificationLevels = $this->Qualifications->QualificationLevels->find('list')->toArray();
        $degreeAwardings = $this->Qualifications->DegreeAwardings->find('list')->toArray();
        $institutes = $this->Qualifications->Institutes->find('list', ['conditions' => ['type' => 'university']])->toArray();
        $religions = $this->Applicants->Religions->find('list');
        $maritalstatus = $this->Applicants->Maritalstatus->find('list');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['order' => 'name']);
        $this->set(compact('applicant', 'religions', 'maritalstatus', 'cities', 'last_date'));
        $this->set(compact('funds', 'qualificationLevels', 'degreeAwardings', 'institutes'));

        $applicant = $this->Applicants->newEntity();
        if ($this->request->is('post')) {
//            debug($this->request->data);
//            exit();
            $this->loadModel('ApplicantFunddetails');
            if (isset($this->request->data['check_status'])) {
                $check = $this->ApplicantFunddetails->find('all')
                        ->contain(['Applicants'])
                        ->where(['ApplicantFunddetails.fund_id' => $this->request->data['fund_id'], 'Applicants.cnic LIKE' => $this->request->data['cnic']])
                        ->order(['ApplicantFunddetails.id DESC'])
                        ->first();
                if ($check['id']) {
                    $this->request->session()->write('token', $check['id']);
                    return $this->redirect(['controller' => 'Applicants', 'action' => 'printform']);
                } else {
                    $this->Flash->error("You haven't applied for the required grant");
                    return $this->redirect('/');
                }
            }
            if (isset($this->request->data['cnic']) && isset($this->request->data['fund_id'])) {
                //check if fund is expired
                $f = $this->request->data['fund_id'];
                $date_expired = $this->Funds->find('all')
                        ->where(['id' => $f, 'active' => '1', 'last_date >=' => date('Y-m-d'),])
                        ->first();
                if ($date_expired == null && !$this->Auth->user('role_id')) {
                    $this->Flash->error(__('The applicant form for this fund is Closed'));
                    return $this->redirect('/');
                }
//            if already applied for the current grant
                $check = $this->ApplicantFunddetails->find('all')
                        ->contain(['Applicants', 'Funds'])
                        ->where(['ApplicantFunddetails.fund_id' => $this->request->data['fund_id'], 'Applicants.cnic LIKE' => $this->request->data['cnic']]);
                if (empty($check->toArray()) || $check->toArray() == null) {
                    $this->request->session()->write('Applicantcnic', $this->request->data['cnic']);
                    $this->request->session()->write('Fund_id', $this->request->data['fund_id']);
                    $f_cat = $this->Funds->find('all')
                            ->contain('SubCategories')
                            ->where(['Funds.id' => $this->request->session()->read('Fund_id')])
                            ->first();
                    $this->set('subCategory', $f_cat->sub_category);
                } else {
                    $this->Flash->error("You Have already applied for the grant.");
                }
            }
            if (isset($this->request->data['Applicants'])) {
                $if_error = $this->validation($this->request->data);
                if ($if_error != '') {
                    $f_cat = $this->Funds->find('all')
                            ->contain('SubCategories')
                            ->where(['Funds.id' => $this->request->session()->read('Fund_id')])
                            ->first();
                    $this->set('subCategory', $f_cat->sub_category);
                    $this->set('error_msg', $if_error);
                } else {
                    foreach ($this->request->data as $key => $save_records):
                        if ($key == 'Applicants') {
                            $save_records['cnic'] = $this->request->session()->read('Applicantcnic');
                            $applicant = $this->$key->patchEntity($applicant, $save_records);
                            $this->$key->save($applicant);
                            $applicant_id = $applicant->id;
                        } else {
                            $this->loadModel($key); // applicantaddress, applicantcontacts etc
                            if ($key == 'Qualifications') {
                                $index = 'Qualifications';
                                $save = $this->request->data[$index];

                                if (!empty($this->request->data[$index]['total_marks']) && !empty($this->request->data[$index]['obtained_marks'])) {
                                    $this->request->data[$index]['percentage'] = round(($this->request->data[$index]['obtained_marks'] * 100) / $this->request->data[$index]['total_marks'], 2);
                                }

                                $this->loadModel('Institutes');

                                if (!empty($this->request->data['Institutes']['name'])) {
                                    $this->loadModel('QualificationLevels');
                                    $institute_type = $this->QualificationLevels->get($save['qualification_level_id'], ['fields' => ['institute_type_id']]);
                                    $this->request->data['Institutes']['institute_type_id'] = $institute_type->institute_type_id;
                                    $institute = $this->Institutes->newEntity();
                                    $institute = $this->Institutes->patchEntity($institute, $this->request->data['Institutes']);
                                    if ($this->Institutes->save($institute)) {
                                        $this->request->data[$index]['institute_id'] = $institute->id;
                                    }
                                }
                                $this->loadModel('Disciplines');
                                if (!empty($this->request->data['Disciplines']['discipline'])) {
                                    $this->request->data['Disciplines']['qualification_level_id'] = $this->request->data[$index]['qualification_level_id'];

                                    $discipline = $this->Disciplines->newEntity();
                                    $discipline = $this->Disciplines->patchEntity($discipline, $this->request->data['Disciplines']);
                                    if ($this->Disciplines->save($discipline)) {
                                        $this->request->data[$index]['discipline_id'] = $discipline->id;
                                    }
                                }
                                $this->request->data[$index]['applicant_id'] = $applicant->id;


                                $qualification = $this->Qualifications->newEntity();
                                $qualification = $this->$index->patchEntity($qualification, $this->request->data[$index]);

                                if ($this->$index->save($qualification)) {
                                    unset($this->request->data['Qualifications']);
                                    unset($this->request->data['Institutes']);
                                    unset($this->request->data['Disciplines']);
                                }
                            } else {
                                $child_table = $this->$key->newEntity();
                                if ($key == 'Applicantcontacts') {
                                    if (!empty($this->request->data['Applicantcontacts']['mob_number'][0])) {
                                        $this->loadModel('Applicantcontacts');
                                        $save_attachment = array();
                                        foreach ($this->request->data['Applicantcontacts']['mob_number'] as $subkey => $u_img):
                                            $save_attachment[$subkey]['applicant_id'] = $applicant_id;
                                            $save_attachment[$subkey]['mob_number'] = $u_img;
                                        endforeach;
                                        $attachments_details = $this->Applicantcontacts->newEntities($save_attachment);
                                        $result = $this->Applicantcontacts->saveMany($attachments_details);
                                    }
                                } else {
                                    $save_records['applicant_id'] = $applicant_id;
                                    $child_table = $this->$key->patchEntity($child_table, $save_records);
                                    $this->$key->save($child_table);
                                }
                            }
                        }
                    endforeach;
                    $this->loadModel('ApplicantFunddetails');
                    $ApplicantFunddetails = $this->ApplicantFunddetails->newEntity();
                    $this->request->data['ApplicantFunddetails']['fund_id'] = $this->request->session()->read('Fund_id');
                    $this->request->data['ApplicantFunddetails']['applicant_id'] = $applicant_id;
                    $this->request->data['ApplicantFunddetails']['appling_date'] = date('Y-m-d');
                    if ($this->Auth->user('id')) {
                        $this->request->data['ApplicantFunddetails']['user_id'] =$this->Auth->user('id');
                    }
                    $ApplicantFunddetails = $this->ApplicantFunddetails->patchEntity($ApplicantFunddetails, $this->request->data['ApplicantFunddetails']);

                    if ($this->ApplicantFunddetails->save($ApplicantFunddetails)) {
                        $this->request->session()->delete('Applicantcnic');
                        $this->request->session()->delete('Fund_id');
                        $this->Flash->success(__('Your Record has been saved successfully'));
                        $this->request->session()->write('token', $ApplicantFunddetails->id);
                        return $this->redirect(['controller' => 'Applicants', 'action' => 'printform']);
                    }
                }
            }
        } else {
            $this->request->session()->delete('Applicantcnic');
            $this->request->session()->delete('Fund_id');
        }
    }

    public function add_11_NOV() {
        $this->viewBuilder()->layout('new_applicant');
        $this->loadModel('Funds');
        $funds = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['active' => '1'])
                ->order(['last_date DESC']);
        $last_date = $this->Funds->find('all')
                ->where(['active' => '1', 'last_date >=' => date('Y-m-d')])
                ->order(['last_date DESC']);
        $this->loadModel('Qualifications');

        $qualificationLevels = $this->Qualifications->QualificationLevels->find('list')->toArray();
        $degreeAwardings = $this->Qualifications->DegreeAwardings->find('list')->toArray();
        $institutes = $this->Qualifications->Institutes->find('list', ['conditions' => ['type' => 'university']])->toArray();
        $religions = $this->Applicants->Religions->find('list');
        $maritalstatus = $this->Applicants->Maritalstatus->find('list');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['order' => 'name']);
        $this->set(compact('applicant', 'religions', 'maritalstatus', 'cities', 'last_date'));
        $this->set(compact('funds', 'qualificationLevels', 'degreeAwardings', 'institutes'));

        $applicant = $this->Applicants->newEntity();
        if ($this->request->is('post')) {
            $this->loadModel('ApplicantFunddetails');
            if (isset($this->request->data['check_status'])) {
                $check = $this->ApplicantFunddetails->find('all')
                        ->contain(['Applicants'])
                        ->where(['ApplicantFunddetails.fund_id' => $this->request->data['fund_id'], 'Applicants.cnic LIKE' => $this->request->data['cnic']])
                        ->order(['ApplicantFunddetails.id DESC'])
                        ->first();
                if ($check['id']) {
                    $this->request->session()->write('token', $check['id']);
                    return $this->redirect(['controller' => 'Applicants', 'action' => 'printform']);
                } else {
                    $this->Flash->error("You haven't applied for the required grant");
                    return $this->redirect('/');
                }
            }
            if (isset($this->request->data['cnic']) && isset($this->request->data['fund_id'])) {
                //check if fund is expired
                $f = $this->request->data['fund_id'];
                $date_expired = $this->Funds->find('all')
                        ->where(['id' => $f, 'active' => '1', 'last_date >=' => date('Y-m-d'),])
                        ->first();
                if ($date_expired == null && !$this->Auth->user('role_id')) {
                    $this->Flash->error(__('The applicant form for this fund is Closed'));
                    return $this->redirect('/');
                }
//            if already applied for the current grant
                $check = $this->ApplicantFunddetails->find('all')
                        ->contain(['Applicants', 'Funds'])
                        ->where(['ApplicantFunddetails.fund_id' => $this->request->data['fund_id'], 'Applicants.cnic LIKE' => $this->request->data['cnic']]);
                if (empty($check->toArray()) || $check->toArray() == null) {
                    $this->request->session()->write('Applicantcnic', $this->request->data['cnic']);
                    $this->request->session()->write('Fund_id', $this->request->data['fund_id']);
                    $f_cat = $this->Funds->find('all')
                            ->contain('SubCategories')
                            ->where(['Funds.id' => $this->request->session()->read('Fund_id')])
                            ->first();
                    $this->set('subCategory', $f_cat->sub_category);
                } else {
                    $this->Flash->error("You Have already applied for the grant.");
                }
            }

            if (isset($this->request->data['Applicants'])) {
                $if_error = $this->validation($this->request->data);
                if ($if_error != '') {
                    $f_cat = $this->Funds->find('all')
                            ->contain('SubCategories')
                            ->where(['Funds.id' => $this->request->session()->read('Fund_id')])
                            ->first();
                    $this->set('subCategory', $f_cat->sub_category);
                    $this->set('error_msg', $if_error);
                } else {
                    foreach ($this->request->data as $key => $save_records):
                        if ($key == 'Applicants') {
                            $save_records['cnic'] = $this->request->session()->read('Applicantcnic');
                            $applicant = $this->$key->patchEntity($applicant, $save_records);
                            $this->$key->save($applicant);
                            $applicant_id = $applicant->id;
                        } else {
                            $this->loadModel($key); // applicantaddress, applicantcontacts etc
                            if ($key == 'Qualifications') {
                                $index = 'Qualifications';
                                $save = $this->request->data[$index];

                                if (!empty($this->request->data[$index]['total_marks']) && !empty($this->request->data[$index]['obtained_marks'])) {
                                    $this->request->data[$index]['percentage'] = round(($this->request->data[$index]['obtained_marks'] * 100) / $this->request->data[$index]['total_marks'], 2);
                                }

                                $this->loadModel('Institutes');

                                if (!empty($this->request->data['Institutes']['name'])) {
                                    $this->loadModel('QualificationLevels');
                                    $institute_type = $this->QualificationLevels->get($save['qualification_level_id'], ['fields' => ['institute_type_id']]);
                                    $this->request->data['Institutes']['institute_type_id'] = $institute_type->institute_type_id;
                                    $institute = $this->Institutes->newEntity();
                                    $institute = $this->Institutes->patchEntity($institute, $this->request->data['Institutes']);
                                    if ($this->Institutes->save($institute)) {
                                        $this->request->data[$index]['institute_id'] = $institute->id;
                                    }
                                }
                                $this->loadModel('Disciplines');
                                if (!empty($this->request->data['Disciplines']['discipline'])) {
                                    $this->request->data['Disciplines']['qualification_level_id'] = $this->request->data[$index]['qualification_level_id'];

                                    $discipline = $this->Disciplines->newEntity();
                                    $discipline = $this->Disciplines->patchEntity($discipline, $this->request->data['Disciplines']);
                                    if ($this->Disciplines->save($discipline)) {
                                        $this->request->data[$index]['discipline_id'] = $discipline->id;
                                    }
                                }
                                $this->request->data[$index]['applicant_id'] = $applicant->id;


                                $qualification = $this->Qualifications->newEntity();
                                $qualification = $this->$index->patchEntity($qualification, $this->request->data[$index]);

                                if ($this->$index->save($qualification)) {
                                    unset($this->request->data['Qualifications']);
                                    unset($this->request->data['Institutes']);
                                    unset($this->request->data['Disciplines']);
                                }
                            } elseif ($key == 'ApplicantAttachments') {
                                if (!empty($this->request->data['ApplicantAttachments']['attachments'][0]['name'])) {

                                    $this->loadModel('ApplicantAttachments');
                                    $save_attachment = array();
                                    foreach ($this->request->data['ApplicantAttachments']['attachments'] as $subkey => $u_img):
                                        $get_ext = pathinfo($u_img['name'], PATHINFO_EXTENSION);
                                        $new_name = $subkey . '-' . date('ymdhis') . '.' . $get_ext;
                                        $path = WWW_ROOT . 'img' . DS . 'applicant_documents' . DS . $new_name;
                                        move_uploaded_file($u_img['tmp_name'], $path);
                                        $save_attachment[$subkey]['applicant_id'] = $applicant_id;
                                        $save_attachment[$subkey]['attachments'] = $new_name;
                                    endforeach;
                                    $attachments_details = $this->ApplicantAttachments->newEntities($save_attachment);
                                    $result = $this->ApplicantAttachments->saveMany($attachments_details);
                                }
                            } else {
                                $child_table = $this->$key->newEntity();
                                if ($key == 'Applicantcontacts') {
                                    if (!empty($this->request->data['Applicantcontacts']['mob_number'][0])) {
                                        $this->loadModel('Applicantcontacts');
                                        $save_attachment = array();
                                        foreach ($this->request->data['Applicantcontacts']['mob_number'] as $subkey => $u_img):
                                            $save_attachment[$subkey]['applicant_id'] = $applicant_id;
                                            $save_attachment[$subkey]['mob_number'] = $u_img;
//                                    $save_attachment[$subkey]['sub_category_id'] = $this->request->data['ApplicantFunddetails']['sub_category_id'];
                                        endforeach;

                                        $attachments_details = $this->Applicantcontacts->newEntities($save_attachment);
                                        $result = $this->Applicantcontacts->saveMany($attachments_details);
                                    }
                                } else {
                                    $save_records['applicant_id'] = $applicant_id;
                                    $child_table = $this->$key->patchEntity($child_table, $save_records);
                                    $this->$key->save($child_table);
                                }
                            }
                        }
                    endforeach;
                    $this->loadModel('ApplicantFunddetails');
                    $ApplicantFunddetails = $this->ApplicantFunddetails->newEntity();
//                        if ($this->request->data['ApplicantFunddetails']) {
                    $this->request->data['ApplicantFunddetails']['fund_id'] = $this->request->session()->read('Fund_id');
                    $this->request->data['ApplicantFunddetails']['applicant_id'] = $applicant_id;
                    $this->request->data['ApplicantFunddetails']['appling_date'] = date('Y-m-d');
                    $ApplicantFunddetails = $this->ApplicantFunddetails->patchEntity($ApplicantFunddetails, $this->request->data['ApplicantFunddetails']);

                    if ($this->ApplicantFunddetails->save($ApplicantFunddetails)) {
                        $this->request->session()->delete('Applicantcnic');
                        $this->request->session()->delete('Fund_id');
                        $this->Flash->success(__('Your Record has been saved successfully'));
                        $this->request->session()->write('token', $ApplicantFunddetails->id);
                        return $this->redirect(['controller' => 'Applicants', 'action' => 'printform']);
                    }
                }
            }
        } else {
            $this->request->session()->delete('Applicantcnic');
            $this->request->session()->delete('Fund_id');
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $instituteclass = null, $fund_id = null) {
        $applicant = $this->Applicants->get($id, [
            'contain' => ['Applicantaddresses', 'Applicantcontacts', 'Instituteclasses']
        ]);
        $this->loadModel('Institutes');
        $institute = $this->Institutes->find('all')
                ->where(['user_id' => $this->Auth->user('id')])
                ->first();
//debug($applicant->instituteclass->institute_id);
//debug($institute->id);
//exit();
        if ($institute->id != $applicant->instituteclass->institute_id) {
            $this->Flash->error(__('You are not authorize to access that location'));
            return $this->redirect(['controller' => 'Applicants', 'action' => 'addapplicant', $instituteclass, $fund_id]);
        }
//        debug();exit();
        $this->loadModel('Cities');
        $cities = $this->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
//        debug($cities->toArray());exit;


        if ($this->request->is(['patch', 'post', 'put'])) {

            extract($this->request->data);
//            $Applicants['instituteclass_id'] = $instituteclass;

            $applicant = $this->Applicants->patchEntity($applicant, $Applicants);
//                        debug($applicant);exit();
            $this->Applicants->save($applicant);
//            debug($applicant);


            if ($Applicantcontacts['mob_number'] <> '') {
                $this->loadModel('Applicantcontacts');
                $applicantcontacts = $this->Applicantcontacts->patchEntity($applicant->applicantcontacts[0], $Applicantcontacts);
                $this->Applicantcontacts->save($applicantcontacts);
//                debug($applicantcontacts);
            }
            if ($Applicantaddresses['current_address'] <> '') {
                $this->loadModel('Applicantaddresses');
                $applicantaddresses = $this->Applicantaddresses->patchEntity($applicant->applicantaddresses[0], $Applicantaddresses);
                $applicantaddresses = $this->Applicantaddresses->save($applicantaddresses);
                if ($applicantaddresses) {
                    $this->Flash->success(__('Your Record has been saved successfully'));
                    return $this->redirect(['controller' => 'Applicants', 'action' => 'addapplicant', $instituteclass, $fund_id]);
                }
            }
        }

        $religions = $this->Applicants->Religions->find('list');
        $this->set(compact('applicant', 'religions', 'cities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $redirect = null, $fund_id = null) {
//        debug($fund_id);exit();
        $this->request->allowMethod(['post', 'delete']);
        $applicant = $this->Applicants->get($id);
        if ($this->Applicants->delete($applicant)) {
            $this->Flash->success(__('The applicant has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'addapplicant', $redirect, $fund_id]);
    }

}

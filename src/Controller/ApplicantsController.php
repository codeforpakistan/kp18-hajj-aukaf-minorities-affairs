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
        $this->Auth->allow(['add']);
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

    public function add() {
        $applicant = $this->Applicants->newEntity();
        if ($this->request->is('post')) {

//            debug($this->request->data);exit();
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
                                if ($result) {
                                    $this->Flash->success(__('The applicant has been saved.'));
//                                    return $this->redirect(['action' => 'index']);
                                }
                            } else {
                                $this->loadModel($key);
                                $child_table = $this->$key->newEntity();
                                $save_records['applicant_id'] = $applicant_id;
                                $child_table = $this->$key->patchEntity($child_table, $save_records);
                                $this->$key->save($child_table);
                            }
                        }
                    endforeach;
                } else {
//                    echo $valid_image;
                    $this->Flash->error(__($valid_image));
                }
            }


//            exit();
//            if ($this->Applicants->save($applicant)) {
//                $this->Flash->success(__('The applicant has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
        }
        $religions = $this->Applicants->Religions->find('list');
//        debug($religions->toArray());
//        exit();
        $this->set(compact('applicant', 'religions'));
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

<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Institutes Controller
 *
 * @property \App\Model\Table\InstitutesTable $Institutes
 *
 * @method \App\Model\Entity\Institute[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InstitutesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function isAuthorized($user) {
        if (isset($user['role_id']) && $user['role_id'] === 3) {
            $allow_user = array('add');
            if (in_array($this->request->params['action'], $allow_user)) {
                return true;
            }
        }
// Default deny
        return false;
    }

    public function index() {
        $this->paginate = [
            'contain' => ['InstituteTypes', 'Cities', 'Applicantcontacts']
        ];
        $institutes = $this->paginate($this->Institutes);

        $this->set(compact('institutes'));
    }

    /**
     * View method
     *
     * @param string|null $id Institute id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $institute = $this->Institutes->get($id, [
            'contain' => ['InstituteTypes', 'Cities', 'Applicantcontacts', 'Qualifications']
        ]);

        $this->set('institute', $institute);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add_1() {
        $institute = $this->Institutes->find('all')
                ->contain(['instituteclasses' => function ($q) {
                        return $q
                                ->where(['instituteclasses.deleted' => 0]);
                    }])
                ->where(['user_id' => $this->Auth->user('id')])
                ->first();
//        debug($institute);
//            exit;
        if (empty($institute) || $institute == null) {
            $institutes = TableRegistry::get('Institutes');
            $institute = $institutes->newEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            if (!empty($this->request->data['photo_of_affiliation']['name'])) {
                $extentions = array('jpg', 'JPG', 'PNG', 'png', 'jpeg', 'JPEG', 'gif', 'GIF', 'svg', 'SVG');
                $img_ext = pathinfo($this->request->data['photo_of_affiliation']['name'], PATHINFO_EXTENSION);
                if (in_array($img_ext, $extentions)) {
                    $new_name = date('ymdhis') . '.' . $img_ext;
                    $path = WWW_ROOT . 'img' . DS . 'institute_affiliations' . DS . $new_name;
                    move_uploaded_file($this->request->data['photo_of_affiliation']['tmp_name'], $path);
                    $this->request->data['photo_of_affiliation'] = $new_name;
                } else {
                    $this->Flash->error(__("Invalid Image Type"));
                    return;
                }
            } else {
                unset($this->request->data['photo_of_affiliation']);
            }

            $this->request->data['institute_type_id'] = 3;
            $this->request->data['user_id'] = $this->Auth->user('id');
            $institute = $this->Institutes->patchEntity($institute, $this->request->getData());
//            debug($this->request->getData());
//            exit;

            if ($this->Institutes->save($institute)) {
                $institute_id = $institute->id;
                $instituteclasses = $this->Institutes->Instituteclasses->find('all')
                        ->where(['Instituteclasses.institute_id' => $institute_id]);
                if (!empty($instituteclasses)) {
                    foreach ($instituteclasses as $k => $a):
                        $a->deleted = 1;
                    endforeach;
                }
                $this->loadModel('Instituteclasses');
//               $instituteclasses= $this->Instituteclasses->patchEntities($instituteclasses);
                $this->Instituteclasses->saveMany($instituteclasses);
//                debug($instituteclasses);
//                exit;
                if (isset($this->request->data['instituteclasses'])) {

                    $institute_classes = array();
                    foreach ($this->request->data['instituteclasses']['class_no'] as $key => $i_c):
                        $institute_classes[$key]['institute_id'] = $institute_id;
                        $institute_classes[$key]['class_no'] = $i_c;
                        $institute_classes[$key]['total_students'] = $this->request->data['instituteclasses']['total_students'][$key];
                        $institute_classes[$key]['minority_students'] = $this->request->data['instituteclasses']['minority_students'][$key];
                        $institute_classes[$key]['needy_students'] = $this->request->data['instituteclasses']['needy_students'][$key];
                        $institute_classes[$key]['textbook_cost'] = $this->request->data['instituteclasses']['textbook_cost'][$key];
                        $institute_classes[$key]['boys_uniform'] = $this->request->data['instituteclasses']['boys_uniform'][$key];
                        $institute_classes[$key]['girls_uniform'] = $this->request->data['instituteclasses']['girls_uniform'][$key];
                        $institute_classes[$key]['date'] = date('Y-m-d');
                    endforeach;
                    $attachments_details = $this->Instituteclasses->newEntities($institute_classes);
                    $result = $this->Instituteclasses->saveMany($attachments_details);
                    if ($result) {

                        $this->Flash->success(__('The institute has been saved.'));
                        return $this->redirect(['action' => 'add']);
                    }
                }
            }
            $this->Flash->error(__('The institute could not be saved. Please, try again.'));
        }
        $instituteTypes = $this->Institutes->InstituteTypes->find('list', ['limit' => 200]);
        $cities = $this->Institutes->Cities->find('list', ['order' => 'name ASC']);
        $applicantcontacts = $this->Institutes->Applicantcontacts->find('list', ['limit' => 200]);
        $this->set(compact('institute', 'instituteTypes', 'cities', 'applicantcontacts'));
    }

    public function add() {
//        debug($this->request->params);exit;
        $institute = $this->Institutes->find('all')
                ->contain(['instituteclasses' => function ($q) {
                        return $q
                                ->where(['instituteclasses.deleted' => 0]);
                    }])
                ->where(['user_id' => $this->Auth->user('id')])
                ->first();
//        debug($institute);
//            exit;
        if (empty($institute) || $institute == null) {
            $institutes = TableRegistry::get('Institutes');
            $institute = $institutes->newEntity();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!empty($this->request->data['photo_of_affiliation']['name'])) {
                $extentions = array('jpg', 'JPG', 'PNG', 'png', 'jpeg', 'JPEG', 'gif', 'GIF', 'svg', 'SVG');
                $img_ext = pathinfo($this->request->data['photo_of_affiliation']['name'], PATHINFO_EXTENSION);
                if (in_array($img_ext, $extentions)) {
                    $new_name = date('ymdhis') . '.' . $img_ext;
                    $path = WWW_ROOT . 'img' . DS . 'institute_affiliations' . DS . $new_name;
                    move_uploaded_file($this->request->data['photo_of_affiliation']['tmp_name'], $path);
                    $this->request->data['photo_of_affiliation'] = $new_name;
                } else {
                    $this->Flash->error(__("Invalid Image Type"));
                    return;
                }
            } else {
                unset($this->request->data['photo_of_affiliation']);
            }

            $this->request->data['institute_type_id'] = 3;
            $this->request->data['user_id'] = $this->Auth->user('id');
            $institute = $this->Institutes->patchEntity($institute, $this->request->getData());
//            debug($this->request->getData());
//            exit;

            if ($this->Institutes->save($institute)) {
                $this->Flash->success(__('The institute has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The institute could not be saved. Please, try again.'));
        }
        $instituteTypes = $this->Institutes->InstituteTypes->find('list');
        $cities = $this->Institutes->Cities->find('list', ['order' => 'name ASC']);
        $applicantcontacts = $this->Institutes->Applicantcontacts->find('list');
        $this->set(compact('institute', 'instituteTypes', 'cities', 'applicantcontacts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Institute id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $institute = $this->Institutes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $institute = $this->Institutes->patchEntity($institute, $this->request->getData());
            if ($this->Institutes->save($institute)) {
                $this->Flash->success(__('The institute has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The institute could not be saved. Please, try again.'));
        }
        $instituteTypes = $this->Institutes->InstituteTypes->find('list', ['limit' => 200]);
        $cities = $this->Institutes->Cities->find('list', ['limit' => 200]);
        $applicantcontacts = $this->Institutes->Applicantcontacts->find('list', ['limit' => 200]);
        $this->set(compact('institute', 'instituteTypes', 'cities', 'applicantcontacts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Institute id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $institute = $this->Institutes->get($id);
        if ($this->Institutes->delete($institute)) {
            $this->Flash->success(__('The institute has been deleted.'));
        } else {
            $this->Flash->error(__('The institute could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

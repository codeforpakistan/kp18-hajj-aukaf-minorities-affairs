<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Instituteclasses Controller
 *
 * @property \App\Model\Table\InstituteclassesTable $Instituteclasses
 *
 * @method \App\Model\Entity\Instituteclass[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InstituteclassesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function isAuthorized($user) {
        if (isset($user['role_id']) && $user['role_id'] === 3) {
            $allow_user = array('addclass', 'index', 'edit', 'services');
            if (in_array($this->request->params['action'], $allow_user)) {
                return true;
            }
        }
// Default deny
        return false;
    }

    public function index($fund_id = null) {
        $fund_id = base64_decode(base64_decode($fund_id));

//        debug($fund_id);
//        exit;
        $this->loadModel('Institutes');
        $ins = $this->Institutes->find('all')
                ->where(['user_id' => $this->Auth->user('id')])
                ->first();
        $instituteclasses = $this->Instituteclasses->find('all')
                ->contain(['SchoolClasses', 'Funds'])
                ->where(['Instituteclasses.institute_id' => $ins->id, 'Instituteclasses.fund_id' => $fund_id, 'Funds.active' => 1, 'Funds.last_date >=' => date('Y-m-d')]);
//        debug($instituteclasses->toArray());
//        exit;
        $this->set(compact('instituteclasses'));
    }

    /**
     * View method
     *
     * @param string|null $id Instituteclass id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $instituteclass = $this->Instituteclasses->get($id, [
            'contain' => ['Institutes']
        ]);

        $this->set('instituteclass', $instituteclass);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $instituteclass = $this->Instituteclasses->newEntity();
        if ($this->request->is('post')) {
            $instituteclass = $this->Instituteclasses->patchEntity($instituteclass, $this->request->getData());
            if ($this->Instituteclasses->save($instituteclass)) {
                $this->Flash->success(__('The instituteclass has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The instituteclass could not be saved. Please, try again.'));
        }
        $institutes = $this->Instituteclasses->Institutes->find('list', ['limit' => 200]);
        $this->set(compact('instituteclass', 'institutes'));
    }

    public function services() {
        if (isset($_GET['fund_id'])) {
            $this->loadModel('Funds');
            $fund_id = base64_decode(base64_decode($_GET['fund_id']));
            $fund = $this->Funds->get($fund_id);
            echo $fund->institute_students;
            exit;
        }
    }

    public function addclass($fund_id = null) {
        $fund_id = base64_decode(base64_decode($fund_id));
//        debug($fund_id);
        $this->loadModel('SchoolClasses');
        $schoolclasses = $this->SchoolClasses->find('list', ['keyField' => 'id', 'valueField' => 'class_number']);

        $instituteclass = $this->Instituteclasses->newEntity();
        if ($this->request->is('post')) {
            $this->loadModel('Institutes');
            $ins = $this->Institutes->find('all')
                    ->where(['user_id' => $this->Auth->user('id')])
                    ->first();
            $this->request->data['institute_id'] = $ins->id;
            $this->request->data['date'] = date('Y-m-d');

            $instituteclass = $this->Instituteclasses->patchEntity($instituteclass, $this->request->getData());
            if ($this->Instituteclasses->save($instituteclass)) {
                $this->Flash->success(__('The instituteclass has been saved.'));
                return $this->redirect(['action' => 'addclass']);
            }
            $this->Flash->error(__('The instituteclass could not be saved. Please, try again.'));
        }
        $institutes = $this->Instituteclasses->Institutes->find('list', ['limit' => 200]);
        $this->set(compact('instituteclass', 'institutes', 'schoolclasses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Instituteclass id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $instituteclass = $this->Instituteclasses->get($id, [
            'contain' => []
        ]);
        $this->loadModel('SchoolClasses');
        $schoolclasses = $this->SchoolClasses->find('list', ['keyField' => 'id', 'valueField' => 'class_number']);

        if ($this->request->is(['patch', 'post', 'put'])) {
//                        debug($this->request->data);exit;

            $instituteclass = $this->Instituteclasses->patchEntity($instituteclass, $this->request->getData());
            if ($this->Instituteclasses->save($instituteclass)) {
                $this->Flash->success(__('The instituteclass has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The instituteclass could not be saved. Please, try again.'));
        }
//        $institutes = $this->Instituteclasses->Institutes->find('list', ['limit' => 200]);
        $this->set(compact('instituteclass', 'schoolclasses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Instituteclass id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $instituteclass = $this->Instituteclasses->get($id);
        if ($this->Instituteclasses->delete($instituteclass)) {
            $this->Flash->success(__('The instituteclass has been deleted.'));
        } else {
            $this->Flash->error(__('The instituteclass could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

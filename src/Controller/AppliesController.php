<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Applies Controller
 *
 * @property \App\Model\Table\AppliesTable $Applies
 *
 * @method \App\Model\Entity\Apply[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppliesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Applicants', 'FundCategories', 'SubCategories']
        ];
        $applies = $this->paginate($this->Applies);

        $this->set(compact('applies'));
    }

    /**
     * View method
     *
     * @param string|null $id Apply id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $apply = $this->Applies->get($id, [
            'contain' => ['Applicants', 'FundCategories', 'SubCategories']
        ]);

        $this->set('apply', $apply);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($applicant_id = null) {
        $apply = $this->Applies->newEntity();
        if ($this->request->is('post')) {

            if ($applicant_id) {
                $this->request->data['applicant_id'] = $applicant_id;
            }
            $this->request->data['date'] = date('Y-m-d');
//            debug($this->request->data);
//            exit();
            $apply = $this->Applies->patchEntity($apply, $this->request->getData());
            if ($this->Applies->save($apply)) {
                $this->Flash->success(__('The apply has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The apply could not be saved. Please, try again.'));
        }
        $fundCategories = $this->Applies->FundCategories->find('list', ['keyField' => 'id', 'valueField' => 'type_of_fund']);
        $subCategories = $this->Applies->SubCategories->find('list', ['keyField' => 'id', 'valueField' => 'type_of_fund']);
        $this->set(compact('apply', 'fundCategories', 'subCategories'));
    }

    public function subcategories() {
        $this->loadModel('SubCategories');
        $sub = $this->SubCategories->find('list', ['conditions' => ['fund_category_id' => $_GET['category_id']], 'keyField' => 'id', 'valueField' => 'type_of_fund'])->toArray();
        if (!empty($sub)) {
            $data = json_encode($sub);
        } else {
            $data = '';
        }
        echo $data;
        exit();
    }

    /**
     * Edit method
     *
     * @param string|null $id Apply id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $apply = $this->Applies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $apply = $this->Applies->patchEntity($apply, $this->request->getData());
            if ($this->Applies->save($apply)) {
                $this->Flash->success(__('The apply has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The apply could not be saved. Please, try again.'));
        }
        $applicants = $this->Applies->Applicants->find('list', ['limit' => 200]);
        $fundCategories = $this->Applies->FundCategories->find('list', ['limit' => 200]);
        $subCategories = $this->Applies->SubCategories->find('list', ['limit' => 200]);
        $this->set(compact('apply', 'applicants', 'fundCategories', 'subCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Apply id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $apply = $this->Applies->get($id);
        if ($this->Applies->delete($apply)) {
            $this->Flash->success(__('The apply has been deleted.'));
        } else {
            $this->Flash->error(__('The apply could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

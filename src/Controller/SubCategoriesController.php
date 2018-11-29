<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * SubCategories Controller
 *
 * @property \App\Model\Table\SubCategoriesTable $SubCategories
 *
 * @method \App\Model\Entity\SubCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubCategoriesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['FundCategories']
        ];
        $subCategories = $this->paginate($this->SubCategories);

        $this->set(compact('subCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Sub Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $subCategory = $this->SubCategories->get($id, [
            'contain' => ['FundCategories', 'Applies', 'Funds', 'ProvidedFunds']
        ]);

        $this->set('subCategory', $subCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $subCategory = $this->SubCategories->newEntity();
        if ($this->request->is('post')) {
            $subCategory = $this->SubCategories->patchEntity($subCategory, $this->request->getData());
            if ($this->SubCategories->save($subCategory)) {
                $this->Flash->success(__('The sub category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sub category could not be saved. Please, try again.'));
        }
        $fundCategories = $this->SubCategories->FundCategories->find('list', ['keyField' => 'id', 'valueField' => 'type_of_fund']);
//        debug($fundCategories->toArray());
//        exit();
        $this->set(compact('subCategory', 'fundCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sub Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $subCategory = $this->SubCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subCategory = $this->SubCategories->patchEntity($subCategory, $this->request->getData());
            if ($this->SubCategories->save($subCategory)) {
                $this->Flash->success(__('The sub category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sub category could not be saved. Please, try again.'));
        }
        $fundCategories = $this->SubCategories->FundCategories->find('list', ['limit' => 200]);
        $this->set(compact('subCategory', 'fundCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sub Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $subCategory = $this->SubCategories->get($id);
        if ($this->SubCategories->delete($subCategory)) {
            $this->Flash->success(__('The sub category has been deleted.'));
        } else {
            $this->Flash->error(__('The sub category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

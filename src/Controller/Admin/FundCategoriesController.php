<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * FundCategories Controller
 *
 * @property \App\Model\Table\FundCategoriesTable $FundCategories
 *
 * @method \App\Model\Entity\FundCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FundCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   $this->viewBuilder()->layout('admin');
         $fundCategories = $this->FundCategories->find('all')->toArray();
       
        $this->set(compact('fundCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Fund Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {    $this->viewBuilder()->layout('admin');
        $fundCategory = $this->FundCategories->get($id, [
            'contain' => ['Applies', 'Funds', 'SubCategories']
        ]);

        $this->set('fundCategory', $fundCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   $this->viewBuilder()->layout('admin');
        $fundCategory = $this->FundCategories->newEntity();
        if ($this->request->is('post')) {
            $fundCategory = $this->FundCategories->patchEntity($fundCategory, $this->request->getData());
            ///
            if ($this->FundCategories->save($fundCategory)) {
                $this->Flash->success(__('The fund category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fund category could not be saved. Please, try again.'));
        }
        $this->set(compact('fundCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fund Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {   $this->viewBuilder()->layout('admin');
        $fundCategory = $this->FundCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fundCategory = $this->FundCategories->patchEntity($fundCategory, $this->request->getData());
            if ($this->FundCategories->save($fundCategory)) {
                $this->Flash->success(__('The fund category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fund category could not be saved. Please, try again.'));
        }
        $this->set(compact('fundCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fund Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fundCategory = $this->FundCategories->get($id);
        if ($this->FundCategories->delete($fundCategory)) {
            $this->Flash->success(__('The fund category has been deleted.'));
        } else {
            $this->Flash->error(__('The fund category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

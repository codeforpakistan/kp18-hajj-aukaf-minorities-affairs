<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * IsApplicable Controller
 *
 * @property \App\Model\Table\IsApplicableTable $IsApplicable
 *
 * @method \App\Model\Entity\IsApplicable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IsApplicableController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SubCategories', 'Maritalstatuses']
        ];
        $isApplicable = $this->paginate($this->IsApplicable);

        $this->set(compact('isApplicable'));
    }

    /**
     * View method
     *
     * @param string|null $id Is Applicable id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $isApplicable = $this->IsApplicable->get($id, [
            'contain' => ['SubCategories', 'Maritalstatuses']
        ]);

        $this->set('isApplicable', $isApplicable);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $isApplicable = $this->IsApplicable->newEntity();
        if ($this->request->is('post')) {
            $isApplicable = $this->IsApplicable->patchEntity($isApplicable, $this->request->getData());
            if ($this->IsApplicable->save($isApplicable)) {
                $this->Flash->success(__('The is applicable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The is applicable could not be saved. Please, try again.'));
        }
        $subCategories = $this->IsApplicable->SubCategories->find('list', ['limit' => 200]);
        $maritalstatuses = $this->IsApplicable->Maritalstatuses->find('list', ['limit' => 200]);
        $this->set(compact('isApplicable', 'subCategories', 'maritalstatuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Is Applicable id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $isApplicable = $this->IsApplicable->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $isApplicable = $this->IsApplicable->patchEntity($isApplicable, $this->request->getData());
            if ($this->IsApplicable->save($isApplicable)) {
                $this->Flash->success(__('The is applicable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The is applicable could not be saved. Please, try again.'));
        }
        $subCategories = $this->IsApplicable->SubCategories->find('list', ['limit' => 200]);
        $maritalstatuses = $this->IsApplicable->Maritalstatuses->find('list', ['limit' => 200]);
        $this->set(compact('isApplicable', 'subCategories', 'maritalstatuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Is Applicable id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $isApplicable = $this->IsApplicable->get($id);
        if ($this->IsApplicable->delete($isApplicable)) {
            $this->Flash->success(__('The is applicable has been deleted.'));
        } else {
            $this->Flash->error(__('The is applicable could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

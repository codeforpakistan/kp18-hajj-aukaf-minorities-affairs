<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Maritalstatus Controller
 *
 * @property \App\Model\Table\MaritalstatusTable $Maritalstatus
 *
 * @method \App\Model\Entity\Maritalstatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MaritalstatusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   $this->viewBuilder()->layout('admin');
        $maritalstatus = $this->Maritalstatus->find('all')->toArray();
       
        $this->set(compact('maritalstatus'));
    }

    /**
     * View method
     *
     * @param string|null $id Maritalstatus id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   $this->viewBuilder()->layout('admin');
        $maritalstatus = $this->Maritalstatus->get($id, [
            'contain' => ['Applicants']
        ]);

        $this->set('maritalstatus', $maritalstatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   $this->viewBuilder()->layout('admin');
        $maritalstatus = $this->Maritalstatus->newEntity();
        if ($this->request->is('post')) {
            $maritalstatus = $this->Maritalstatus->patchEntity($maritalstatus, $this->request->getData());
            if ($this->Maritalstatus->save($maritalstatus)) {
                $this->Flash->success(__('The maritalstatus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maritalstatus could not be saved. Please, try again.'));
        }
        $this->set(compact('maritalstatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Maritalstatus id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {   $this->viewBuilder()->layout('admin');
        $maritalstatus = $this->Maritalstatus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $maritalstatus = $this->Maritalstatus->patchEntity($maritalstatus, $this->request->getData());
            if ($this->Maritalstatus->save($maritalstatus)) {
                $this->Flash->success(__('The maritalstatus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maritalstatus could not be saved. Please, try again.'));
        }
        $this->set(compact('maritalstatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Maritalstatus id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $maritalstatus = $this->Maritalstatus->get($id);
        if ($this->Maritalstatus->delete($maritalstatus)) {
            $this->Flash->success(__('The maritalstatus has been deleted.'));
        } else {
            $this->Flash->error(__('The maritalstatus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

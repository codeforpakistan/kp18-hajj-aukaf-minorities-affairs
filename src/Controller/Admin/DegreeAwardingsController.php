<?php
namespace App\Controller\admin;

use App\Controller\AppController;

/**
 * DegreeAwardings Controller
 *
 * @property \App\Model\Table\DegreeAwardingsTable $DegreeAwardings
 *
 * @method \App\Model\Entity\DegreeAwarding[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DegreeAwardingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   $this->viewBuilder()->layout('admin');
        $degreeAwardings = $this->DegreeAwardings->find('all')->toArray();
       
        $this->set(compact('degreeAwardings'));
    }

    /**
     * View method
     *
     * @param string|null $id Degree Awarding id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   $this->viewBuilder()->layout('admin');
        $degreeAwarding = $this->DegreeAwardings->get($id, [
            'contain' => ['Qualifications']
        ]);

        $this->set('degreeAwarding', $degreeAwarding);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   $this->viewBuilder()->layout('admin');
        $degreeAwarding = $this->DegreeAwardings->newEntity();
        if ($this->request->is('post')) {
            $degreeAwarding = $this->DegreeAwardings->patchEntity($degreeAwarding, $this->request->getData());
            if ($this->DegreeAwardings->save($degreeAwarding)) {
                $this->Flash->success(__('The degree awarding has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The degree awarding could not be saved. Please, try again.'));
        }
        $this->set(compact('degreeAwarding'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Degree Awarding id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {   $this->viewBuilder()->layout('admin');
        $degreeAwarding = $this->DegreeAwardings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $degreeAwarding = $this->DegreeAwardings->patchEntity($degreeAwarding, $this->request->getData());
            if ($this->DegreeAwardings->save($degreeAwarding)) {
                $this->Flash->success(__('The degree awarding has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The degree awarding could not be saved. Please, try again.'));
        }
        $this->set(compact('degreeAwarding'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Degree Awarding id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $degreeAwarding = $this->DegreeAwardings->get($id);
        if ($this->DegreeAwardings->delete($degreeAwarding)) {
            $this->Flash->success(__('The degree awarding has been deleted.'));
        } else {
            $this->Flash->error(__('The degree awarding could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

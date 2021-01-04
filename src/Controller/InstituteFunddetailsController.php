<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InstituteFunddetails Controller
 *
 * @property \App\Model\Table\InstituteFunddetailsTable $InstituteFunddetails
 *
 * @method \App\Model\Entity\InstituteFunddetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InstituteFunddetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Applicants', 'Funds']
        ];
        $instituteFunddetails = $this->paginate($this->InstituteFunddetails);

        $this->set(compact('instituteFunddetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Institute Funddetail id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $instituteFunddetail = $this->InstituteFunddetails->get($id, [
            'contain' => ['Applicants', 'Funds']
        ]);

        $this->set('instituteFunddetail', $instituteFunddetail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $instituteFunddetail = $this->InstituteFunddetails->newEntity();
        if ($this->request->is('post')) {
            $instituteFunddetail = $this->InstituteFunddetails->patchEntity($instituteFunddetail, $this->request->getData());
            if ($this->InstituteFunddetails->save($instituteFunddetail)) {
                $this->Flash->success(__('The institute funddetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The institute funddetail could not be saved. Please, try again.'));
        }
        $applicants = $this->InstituteFunddetails->Applicants->find('list', ['limit' => 200]);
        $funds = $this->InstituteFunddetails->Funds->find('list', ['limit' => 200]);
        $this->set(compact('instituteFunddetail', 'applicants', 'funds'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Institute Funddetail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $instituteFunddetail = $this->InstituteFunddetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $instituteFunddetail = $this->InstituteFunddetails->patchEntity($instituteFunddetail, $this->request->getData());
            if ($this->InstituteFunddetails->save($instituteFunddetail)) {
                $this->Flash->success(__('The institute funddetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The institute funddetail could not be saved. Please, try again.'));
        }
        $applicants = $this->InstituteFunddetails->Applicants->find('list', ['limit' => 200]);
        $funds = $this->InstituteFunddetails->Funds->find('list', ['limit' => 200]);
        $this->set(compact('instituteFunddetail', 'applicants', 'funds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Institute Funddetail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $instituteFunddetail = $this->InstituteFunddetails->get($id);
        if ($this->InstituteFunddetails->delete($instituteFunddetail)) {
            $this->Flash->success(__('The institute funddetail has been deleted.'));
        } else {
            $this->Flash->error(__('The institute funddetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

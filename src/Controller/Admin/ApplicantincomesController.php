<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Applicantincomes Controller
 *
 * @property \App\Model\Table\ApplicantincomesTable $Applicantincomes
 *
 * @method \App\Model\Entity\Applicantincome[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantincomesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Applicants']
        ];
        $applicantincomes = $this->paginate($this->Applicantincomes);

        $this->set(compact('applicantincomes'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicantincome id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantincome = $this->Applicantincomes->get($id, [
            'contain' => ['Applicants']
        ]);

        $this->set('applicantincome', $applicantincome);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantincome = $this->Applicantincomes->newEntity();
        if ($this->request->is('post')) {
            $applicantincome = $this->Applicantincomes->patchEntity($applicantincome, $this->request->getData());
            if ($this->Applicantincomes->save($applicantincome)) {
                $this->Flash->success(__('The applicantincome has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicantincome could not be saved. Please, try again.'));
        }
        $applicants = $this->Applicantincomes->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantincome', 'applicants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicantincome id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantincome = $this->Applicantincomes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantincome = $this->Applicantincomes->patchEntity($applicantincome, $this->request->getData());
            if ($this->Applicantincomes->save($applicantincome)) {
                $this->Flash->success(__('The applicantincome has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicantincome could not be saved. Please, try again.'));
        }
        $applicants = $this->Applicantincomes->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantincome', 'applicants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicantincome id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantincome = $this->Applicantincomes->get($id);
        if ($this->Applicantincomes->delete($applicantincome)) {
            $this->Flash->success(__('The applicantincome has been deleted.'));
        } else {
            $this->Flash->error(__('The applicantincome could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

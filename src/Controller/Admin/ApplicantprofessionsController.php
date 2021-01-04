<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Applicantprofessions Controller
 *
 * @property \App\Model\Table\ApplicantprofessionsTable $Applicantprofessions
 *
 * @method \App\Model\Entity\Applicantprofession[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantprofessionsController extends AppController
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
        $applicantprofessions = $this->paginate($this->Applicantprofessions);

        $this->set(compact('applicantprofessions'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicantprofession id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantprofession = $this->Applicantprofessions->get($id, [
            'contain' => ['Applicants']
        ]);

        $this->set('applicantprofession', $applicantprofession);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantprofession = $this->Applicantprofessions->newEntity();
        if ($this->request->is('post')) {
            $applicantprofession = $this->Applicantprofessions->patchEntity($applicantprofession, $this->request->getData());
            if ($this->Applicantprofessions->save($applicantprofession)) {
                $this->Flash->success(__('The applicantprofession has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicantprofession could not be saved. Please, try again.'));
        }
        $applicants = $this->Applicantprofessions->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantprofession', 'applicants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicantprofession id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantprofession = $this->Applicantprofessions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantprofession = $this->Applicantprofessions->patchEntity($applicantprofession, $this->request->getData());
            if ($this->Applicantprofessions->save($applicantprofession)) {
                $this->Flash->success(__('The applicantprofession has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicantprofession could not be saved. Please, try again.'));
        }
        $applicants = $this->Applicantprofessions->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantprofession', 'applicants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicantprofession id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantprofession = $this->Applicantprofessions->get($id);
        if ($this->Applicantprofessions->delete($applicantprofession)) {
            $this->Flash->success(__('The applicantprofession has been deleted.'));
        } else {
            $this->Flash->error(__('The applicantprofession could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

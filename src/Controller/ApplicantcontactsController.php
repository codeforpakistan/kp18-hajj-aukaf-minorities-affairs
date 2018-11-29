<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Applicantcontacts Controller
 *
 * @property \App\Model\Table\ApplicantcontactsTable $Applicantcontacts
 *
 * @method \App\Model\Entity\Applicantcontact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantcontactsController extends AppController
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
        $applicantcontacts = $this->paginate($this->Applicantcontacts);

        $this->set(compact('applicantcontacts'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicantcontact id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantcontact = $this->Applicantcontacts->get($id, [
            'contain' => ['Applicants']
        ]);

        $this->set('applicantcontact', $applicantcontact);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantcontact = $this->Applicantcontacts->newEntity();
        if ($this->request->is('post')) {
            $applicantcontact = $this->Applicantcontacts->patchEntity($applicantcontact, $this->request->getData());
            if ($this->Applicantcontacts->save($applicantcontact)) {
                $this->Flash->success(__('The applicantcontact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicantcontact could not be saved. Please, try again.'));
        }
        $applicants = $this->Applicantcontacts->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantcontact', 'applicants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicantcontact id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantcontact = $this->Applicantcontacts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantcontact = $this->Applicantcontacts->patchEntity($applicantcontact, $this->request->getData());
            if ($this->Applicantcontacts->save($applicantcontact)) {
                $this->Flash->success(__('The applicantcontact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicantcontact could not be saved. Please, try again.'));
        }
        $applicants = $this->Applicantcontacts->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantcontact', 'applicants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicantcontact id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantcontact = $this->Applicantcontacts->get($id);
        if ($this->Applicantcontacts->delete($applicantcontact)) {
            $this->Flash->success(__('The applicantcontact has been deleted.'));
        } else {
            $this->Flash->error(__('The applicantcontact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

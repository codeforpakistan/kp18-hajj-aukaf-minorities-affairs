<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicantAttachments Controller
 *
 * @property \App\Model\Table\ApplicantAttachmentsTable $ApplicantAttachments
 *
 * @method \App\Model\Entity\ApplicantAttachment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantAttachmentsController extends AppController
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
        $applicantAttachments = $this->paginate($this->ApplicantAttachments);

        $this->set(compact('applicantAttachments'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicant Attachment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantAttachment = $this->ApplicantAttachments->get($id, [
            'contain' => ['Applicants']
        ]);

        $this->set('applicantAttachment', $applicantAttachment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantAttachment = $this->ApplicantAttachments->newEntity();
        if ($this->request->is('post')) {
            $applicantAttachment = $this->ApplicantAttachments->patchEntity($applicantAttachment, $this->request->getData());
            if ($this->ApplicantAttachments->save($applicantAttachment)) {
                $this->Flash->success(__('The applicant attachment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant attachment could not be saved. Please, try again.'));
        }
        $applicants = $this->ApplicantAttachments->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantAttachment', 'applicants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Attachment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantAttachment = $this->ApplicantAttachments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantAttachment = $this->ApplicantAttachments->patchEntity($applicantAttachment, $this->request->getData());
            if ($this->ApplicantAttachments->save($applicantAttachment)) {
                $this->Flash->success(__('The applicant attachment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant attachment could not be saved. Please, try again.'));
        }
        $applicants = $this->ApplicantAttachments->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantAttachment', 'applicants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Attachment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantAttachment = $this->ApplicantAttachments->get($id);
        if ($this->ApplicantAttachments->delete($applicantAttachment)) {
            $this->Flash->success(__('The applicant attachment has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant attachment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

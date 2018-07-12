<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicantHouseholdDetails Controller
 *
 * @property \App\Model\Table\ApplicantHouseholdDetailsTable $ApplicantHouseholdDetails
 *
 * @method \App\Model\Entity\ApplicantHouseholdDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantHouseholdDetailsController extends AppController
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
        $applicantHouseholdDetails = $this->paginate($this->ApplicantHouseholdDetails);

        $this->set(compact('applicantHouseholdDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicant Household Detail id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantHouseholdDetail = $this->ApplicantHouseholdDetails->get($id, [
            'contain' => ['Applicants']
        ]);

        $this->set('applicantHouseholdDetail', $applicantHouseholdDetail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantHouseholdDetail = $this->ApplicantHouseholdDetails->newEntity();
        if ($this->request->is('post')) {
            $applicantHouseholdDetail = $this->ApplicantHouseholdDetails->patchEntity($applicantHouseholdDetail, $this->request->getData());
            if ($this->ApplicantHouseholdDetails->save($applicantHouseholdDetail)) {
                $this->Flash->success(__('The applicant household detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant household detail could not be saved. Please, try again.'));
        }
        $applicants = $this->ApplicantHouseholdDetails->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantHouseholdDetail', 'applicants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Household Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantHouseholdDetail = $this->ApplicantHouseholdDetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantHouseholdDetail = $this->ApplicantHouseholdDetails->patchEntity($applicantHouseholdDetail, $this->request->getData());
            if ($this->ApplicantHouseholdDetails->save($applicantHouseholdDetail)) {
                $this->Flash->success(__('The applicant household detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant household detail could not be saved. Please, try again.'));
        }
        $applicants = $this->ApplicantHouseholdDetails->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantHouseholdDetail', 'applicants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Household Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantHouseholdDetail = $this->ApplicantHouseholdDetails->get($id);
        if ($this->ApplicantHouseholdDetails->delete($applicantHouseholdDetail)) {
            $this->Flash->success(__('The applicant household detail has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant household detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

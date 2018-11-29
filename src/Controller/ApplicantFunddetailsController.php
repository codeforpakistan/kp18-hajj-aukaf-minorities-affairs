<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicantFunddetails Controller
 *
 * @property \App\Model\Table\ApplicantFunddetailsTable $ApplicantFunddetails
 *
 * @method \App\Model\Entity\ApplicantFunddetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantFunddetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Applicants', 'FundCategories', 'SubCategories']
        ];
        $applicantFunddetails = $this->paginate($this->ApplicantFunddetails);

        $this->set(compact('applicantFunddetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicant Funddetail id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantFunddetail = $this->ApplicantFunddetails->get($id, [
            'contain' => ['Applicants', 'FundCategories', 'SubCategories']
        ]);

        $this->set('applicantFunddetail', $applicantFunddetail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantFunddetail = $this->ApplicantFunddetails->newEntity();
        if ($this->request->is('post')) {
            $applicantFunddetail = $this->ApplicantFunddetails->patchEntity($applicantFunddetail, $this->request->getData());
            if ($this->ApplicantFunddetails->save($applicantFunddetail)) {
                $this->Flash->success(__('The applicant funddetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant funddetail could not be saved. Please, try again.'));
        }
        $applicants = $this->ApplicantFunddetails->Applicants->find('list', ['limit' => 200]);
        $fundCategories = $this->ApplicantFunddetails->FundCategories->find('list', ['limit' => 200]);
        $subCategories = $this->ApplicantFunddetails->SubCategories->find('list', ['limit' => 200]);
        $this->set(compact('applicantFunddetail', 'applicants', 'fundCategories', 'subCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Funddetail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantFunddetail = $this->ApplicantFunddetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantFunddetail = $this->ApplicantFunddetails->patchEntity($applicantFunddetail, $this->request->getData());
            if ($this->ApplicantFunddetails->save($applicantFunddetail)) {
                $this->Flash->success(__('The applicant funddetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant funddetail could not be saved. Please, try again.'));
        }
        $applicants = $this->ApplicantFunddetails->Applicants->find('list', ['limit' => 200]);
        $fundCategories = $this->ApplicantFunddetails->FundCategories->find('list', ['limit' => 200]);
        $subCategories = $this->ApplicantFunddetails->SubCategories->find('list', ['limit' => 200]);
        $this->set(compact('applicantFunddetail', 'applicants', 'fundCategories', 'subCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Funddetail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantFunddetail = $this->ApplicantFunddetails->get($id);
        if ($this->ApplicantFunddetails->delete($applicantFunddetail)) {
            $this->Flash->success(__('The applicant funddetail has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant funddetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

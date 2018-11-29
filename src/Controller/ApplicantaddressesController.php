<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Applicantaddresses Controller
 *
 * @property \App\Model\Table\ApplicantaddressesTable $Applicantaddresses
 *
 * @method \App\Model\Entity\Applicantaddress[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantaddressesController extends AppController
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
        $applicantaddresses = $this->paginate($this->Applicantaddresses);

        $this->set(compact('applicantaddresses'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicantaddress id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantaddress = $this->Applicantaddresses->get($id, [
            'contain' => ['Applicants']
        ]);

        $this->set('applicantaddress', $applicantaddress);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantaddress = $this->Applicantaddresses->newEntity();
        if ($this->request->is('post')) {
            $applicantaddress = $this->Applicantaddresses->patchEntity($applicantaddress, $this->request->getData());
            if ($this->Applicantaddresses->save($applicantaddress)) {
                $this->Flash->success(__('The applicantaddress has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicantaddress could not be saved. Please, try again.'));
        }
        $applicants = $this->Applicantaddresses->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantaddress', 'applicants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicantaddress id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantaddress = $this->Applicantaddresses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantaddress = $this->Applicantaddresses->patchEntity($applicantaddress, $this->request->getData());
            if ($this->Applicantaddresses->save($applicantaddress)) {
                $this->Flash->success(__('The applicantaddress has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicantaddress could not be saved. Please, try again.'));
        }
        $applicants = $this->Applicantaddresses->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantaddress', 'applicants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicantaddress id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantaddress = $this->Applicantaddresses->get($id);
        if ($this->Applicantaddresses->delete($applicantaddress)) {
            $this->Flash->success(__('The applicantaddress has been deleted.'));
        } else {
            $this->Flash->error(__('The applicantaddress could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

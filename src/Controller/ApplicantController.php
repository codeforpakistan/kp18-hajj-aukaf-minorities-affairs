<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Applicant Controller
 *
 * @property \App\Model\Table\ApplicantTable $Applicant
 *
 * @method \App\Model\Entity\Applicant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Religons']
        ];
        $applicant = $this->paginate($this->Applicant);

        $this->set(compact('applicant'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicant = $this->Applicant->get($id, [
            'contain' => ['Religons']
        ]);

        $this->set('applicant', $applicant);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicant = $this->Applicant->newEntity();
        if ($this->request->is('post')) {
            $applicant = $this->Applicant->patchEntity($applicant, $this->request->getData());
            if ($this->Applicant->save($applicant)) {
                $this->Flash->success(__('The applicant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
        }
        $religons = $this->Applicant->Religons->find('list', ['limit' => 200]);
        $this->set(compact('applicant', 'religons'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicant = $this->Applicant->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicant = $this->Applicant->patchEntity($applicant, $this->request->getData());
            if ($this->Applicant->save($applicant)) {
                $this->Flash->success(__('The applicant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
        }
        $religons = $this->Applicant->Religons->find('list', ['limit' => 200]);
        $this->set(compact('applicant', 'religons'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicant = $this->Applicant->get($id);
        if ($this->Applicant->delete($applicant)) {
            $this->Flash->success(__('The applicant has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

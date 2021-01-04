<?php
namespace App\Controller\admin;

use App\Controller\AppController;

/**
 * Qualifications Controller
 *
 * @property \App\Model\Table\QualificationsTable $Qualifications
 *
 * @method \App\Model\Entity\Qualification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QualificationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Applicants', 'QualificationLevels', 'Disciplines', 'Institutes', 'DegreeAwardings']
        ];
        $qualifications = $this->paginate($this->Qualifications);

        $this->set(compact('qualifications'));
    }

    /**
     * View method
     *
     * @param string|null $id Qualification id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $qualification = $this->Qualifications->get($id, [
            'contain' => ['Applicants', 'QualificationLevels', 'Disciplines', 'Institutes', 'DegreeAwardings']
        ]);

        $this->set('qualification', $qualification);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $qualification = $this->Qualifications->newEntity();
        if ($this->request->is('post')) {
            $qualification = $this->Qualifications->patchEntity($qualification, $this->request->getData());
            if ($this->Qualifications->save($qualification)) {
                $this->Flash->success(__('The qualification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The qualification could not be saved. Please, try again.'));
        }
        $applicants = $this->Qualifications->Applicants->find('list', ['limit' => 200]);
        $qualificationLevels = $this->Qualifications->QualificationLevels->find('list', ['limit' => 200]);
        $disciplines = $this->Qualifications->Disciplines->find('list', ['limit' => 200]);
        $institutes = $this->Qualifications->Institutes->find('list', ['limit' => 200]);
        $degreeAwardings = $this->Qualifications->DegreeAwardings->find('list', ['limit' => 200]);
        $this->set(compact('qualification', 'applicants', 'qualificationLevels', 'disciplines', 'institutes', 'degreeAwardings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Qualification id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $qualification = $this->Qualifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $qualification = $this->Qualifications->patchEntity($qualification, $this->request->getData());
            if ($this->Qualifications->save($qualification)) {
                $this->Flash->success(__('The qualification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The qualification could not be saved. Please, try again.'));
        }
        $applicants = $this->Qualifications->Applicants->find('list', ['limit' => 200]);
        $qualificationLevels = $this->Qualifications->QualificationLevels->find('list', ['limit' => 200]);
        $disciplines = $this->Qualifications->Disciplines->find('list', ['limit' => 200]);
        $institutes = $this->Qualifications->Institutes->find('list', ['limit' => 200]);
        $degreeAwardings = $this->Qualifications->DegreeAwardings->find('list', ['limit' => 200]);
        $this->set(compact('qualification', 'applicants', 'qualificationLevels', 'disciplines', 'institutes', 'degreeAwardings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Qualification id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $qualification = $this->Qualifications->get($id);
        if ($this->Qualifications->delete($qualification)) {
            $this->Flash->success(__('The qualification has been deleted.'));
        } else {
            $this->Flash->error(__('The qualification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

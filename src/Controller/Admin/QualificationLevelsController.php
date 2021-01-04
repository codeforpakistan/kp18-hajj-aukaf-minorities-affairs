<?php
namespace App\Controller\admin;

use App\Controller\AppController;

/**
 * QualificationLevels Controller
 *
 * @property \App\Model\Table\QualificationLevelsTable $QualificationLevels
 *
 * @method \App\Model\Entity\QualificationLevel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QualificationLevelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {  $this->viewBuilder()->layout('admin');
          $qualificationLevels = $this->QualificationLevels->find('all',[
            'contain' => ['InstituteTypes']
        ])->toArray();
        $this->set(compact('qualificationLevels'));
    }

    /**
     * View method
     *
     * @param string|null $id Qualification Level id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {  $this->viewBuilder()->layout('admin');
        $qualificationLevel = $this->QualificationLevels->get($id, [
            'contain' => ['InstituteTypes', 'Disciplines', 'Qualifications']
        ]);

        $this->set('qualificationLevel', $qualificationLevel);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   $this->viewBuilder()->layout('admin');
        $qualificationLevel = $this->QualificationLevels->newEntity();
        if ($this->request->is('post')) {
            $qualificationLevel = $this->QualificationLevels->patchEntity($qualificationLevel, $this->request->getData());
            if ($this->QualificationLevels->save($qualificationLevel)) {
                $this->Flash->success(__('The qualification level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The qualification level could not be saved. Please, try again.'));
        }
        $instituteTypes = $this->QualificationLevels->InstituteTypes->find('list', ['limit' => 200,'keyField'=>'id','valueField'=>'type']);
        $this->set(compact('qualificationLevel', 'instituteTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Qualification Level id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {   $this->viewBuilder()->layout('admin');
        $qualificationLevel = $this->QualificationLevels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $qualificationLevel = $this->QualificationLevels->patchEntity($qualificationLevel, $this->request->getData());
            if ($this->QualificationLevels->save($qualificationLevel)) {
                $this->Flash->success(__('The qualification level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The qualification level could not be saved. Please, try again.'));
        }
        $instituteTypes = $this->QualificationLevels->InstituteTypes->find('list', ['limit' => 200,'keyField'=>'id','valueField'=>'type']);
        $this->set(compact('qualificationLevel', 'instituteTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Qualification Level id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $qualificationLevel = $this->QualificationLevels->get($id);
        if ($this->QualificationLevels->delete($qualificationLevel)) {
            $this->Flash->success(__('The qualification level has been deleted.'));
        } else {
            $this->Flash->error(__('The qualification level could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

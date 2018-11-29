<?php
namespace App\Controller\admin;

use App\Controller\AppController;

/**
 * Disciplines Controller
 *
 * @property \App\Model\Table\DisciplinesTable $Disciplines
 *
 * @method \App\Model\Entity\Discipline[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DisciplinesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   $this->viewBuilder()->layout('admin');
        $disciplines = $this->Disciplines->find('all',[
            'contain' => ['QualificationLevels']
        ])->toArray();
        

        $this->set(compact('disciplines'));
    }

    /**
     * View method
     *
     * @param string|null $id Discipline id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   $this->viewBuilder()->layout('admin');
        $discipline = $this->Disciplines->get($id, [
            'contain' => ['QualificationLevels', 'Qualifications']
        ]);

        $this->set('discipline', $discipline);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   $this->viewBuilder()->layout('admin');
        $discipline = $this->Disciplines->newEntity();
        if ($this->request->is('post')) {
            $discipline = $this->Disciplines->patchEntity($discipline, $this->request->getData());
            if ($this->Disciplines->save($discipline)) {
                $this->Flash->success(__('The discipline has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The discipline could not be saved. Please, try again.'));
        }
        $qualificationLevels = $this->Disciplines->QualificationLevels->find('list', ['limit' => 200]);
        $this->set(compact('discipline', 'qualificationLevels'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Discipline id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {   $this->viewBuilder()->layout('admin');
        $discipline = $this->Disciplines->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $discipline = $this->Disciplines->patchEntity($discipline, $this->request->getData());
            if ($this->Disciplines->save($discipline)) {
                $this->Flash->success(__('The discipline has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The discipline could not be saved. Please, try again.'));
        }
        $qualificationLevels = $this->Disciplines->QualificationLevels->find('list', ['limit' => 200]);
        $this->set(compact('discipline', 'qualificationLevels'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Discipline id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $discipline = $this->Disciplines->get($id);
        if ($this->Disciplines->delete($discipline)) {
            $this->Flash->success(__('The discipline has been deleted.'));
        } else {
            $this->Flash->error(__('The discipline could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

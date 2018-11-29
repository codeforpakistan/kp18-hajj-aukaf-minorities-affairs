<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Religon Controller
 *
 * @property \App\Model\Table\ReligonTable $Religon
 *
 * @method \App\Model\Entity\Religon[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReligonController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $religon = $this->paginate($this->Religon);

        $this->set(compact('religon'));
    }

    /**
     * View method
     *
     * @param string|null $id Religon id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $religon = $this->Religon->get($id, [
            'contain' => ['Applicant']
        ]);

        $this->set('religon', $religon);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $religon = $this->Religon->newEntity();
        if ($this->request->is('post')) {
            $religon = $this->Religon->patchEntity($religon, $this->request->getData());
            if ($this->Religon->save($religon)) {
                $this->Flash->success(__('The religon has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The religon could not be saved. Please, try again.'));
        }
        $this->set(compact('religon'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Religon id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $religon = $this->Religon->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $religon = $this->Religon->patchEntity($religon, $this->request->getData());
            if ($this->Religon->save($religon)) {
                $this->Flash->success(__('The religon has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The religon could not be saved. Please, try again.'));
        }
        $this->set(compact('religon'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Religon id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $religon = $this->Religon->get($id);
        if ($this->Religon->delete($religon)) {
            $this->Flash->success(__('The religon has been deleted.'));
        } else {
            $this->Flash->error(__('The religon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

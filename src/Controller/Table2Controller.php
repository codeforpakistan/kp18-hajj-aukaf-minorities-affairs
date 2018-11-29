<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Table2 Controller
 *
 * @property \App\Model\Table\Table2Table $Table2
 *
 * @method \App\Model\Entity\Table2[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Table2Controller extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $table2 = $this->paginate($this->Table2);
       // debug($table2->toArray());

        $this->set(compact('table2'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Table2 id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $table2 = $this->Table2->get($id, [
            'contain' => []
        ]);

        $this->set('table2', $table2);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $table2 = $this->Table2->newEntity();
        if ($this->request->is('post')) {
            $table2 = $this->Table2->patchEntity($table2, $this->request->getData());
            if ($this->Table2->save($table2)) {
                $this->Flash->success(__('The table2 has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The table2 could not be saved. Please, try again.'));
        }
        $this->set(compact('table2'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Table2 id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $table2 = $this->Table2->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $table2 = $this->Table2->patchEntity($table2, $this->request->getData());
            if ($this->Table2->save($table2)) {
                $this->Flash->success(__('The table2 has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The table2 could not be saved. Please, try again.'));
        }
        $this->set(compact('table2'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Table2 id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $table2 = $this->Table2->get($id);
        if ($this->Table2->delete($table2)) {
            $this->Flash->success(__('The table2 has been deleted.'));
        } else {
            $this->Flash->error(__('The table2 could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Table1s Controller
 *
 * @property \App\Model\Table\Table1sTable $Table1s
 *
 * @method \App\Model\Entity\Table1[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Table1sController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $table1s = $this->paginate($this->Table1s);

        $this->set(compact('table1s'));
    }

    /**
     * View method
     *
     * @param string|null $id Table1 id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $table1 = $this->Table1s->get($id, [
            'contain' => []
        ]);

        $this->set('table1', $table1);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $table1 = $this->Table1s->newEntity();
        if ($this->request->is('post')) {
            $table1 = $this->Table1s->patchEntity($table1, $this->request->getData());
            if ($this->Table1s->save($table1)) {
                $this->Flash->success(__('The table1 has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The table1 could not be saved. Please, try again.'));
        }
        $this->set(compact('table1'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Table1 id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $table1 = $this->Table1s->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $table1 = $this->Table1s->patchEntity($table1, $this->request->getData());
            if ($this->Table1s->save($table1)) {
                $this->Flash->success(__('The table1 has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The table1 could not be saved. Please, try again.'));
        }
        $this->set(compact('table1'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Table1 id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $table1 = $this->Table1s->get($id);
        if ($this->Table1s->delete($table1)) {
            $this->Flash->success(__('The table1 has been deleted.'));
        } else {
            $this->Flash->error(__('The table1 could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

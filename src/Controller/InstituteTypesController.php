<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InstituteTypes Controller
 *
 * @property \App\Model\Table\InstituteTypesTable $InstituteTypes
 *
 * @method \App\Model\Entity\InstituteType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InstituteTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $instituteTypes = $this->paginate($this->InstituteTypes);

        $this->set(compact('instituteTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Institute Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $instituteType = $this->InstituteTypes->get($id, [
            'contain' => ['Institutes']
        ]);

        $this->set('instituteType', $instituteType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $instituteType = $this->InstituteTypes->newEntity();
        if ($this->request->is('post')) {
            $instituteType = $this->InstituteTypes->patchEntity($instituteType, $this->request->getData());
            if ($this->InstituteTypes->save($instituteType)) {
                $this->Flash->success(__('The institute type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The institute type could not be saved. Please, try again.'));
        }
        $this->set(compact('instituteType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Institute Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $instituteType = $this->InstituteTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $instituteType = $this->InstituteTypes->patchEntity($instituteType, $this->request->getData());
            if ($this->InstituteTypes->save($instituteType)) {
                $this->Flash->success(__('The institute type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The institute type could not be saved. Please, try again.'));
        }
        $this->set(compact('instituteType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Institute Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $instituteType = $this->InstituteTypes->get($id);
        if ($this->InstituteTypes->delete($instituteType)) {
            $this->Flash->success(__('The institute type has been deleted.'));
        } else {
            $this->Flash->error(__('The institute type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

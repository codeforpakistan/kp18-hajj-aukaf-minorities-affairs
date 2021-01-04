<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Funds Controller
 *
 * @property \App\Model\Table\FundsTable $Funds
 *
 * @method \App\Model\Entity\Fund[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FundsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FundCategories', 'SubCategories']
        ];
        $funds = $this->paginate($this->Funds);

        $this->set(compact('funds'));
    }

    /**
     * View method
     *
     * @param string|null $id Fund id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fund = $this->Funds->get($id, [
            'contain' => ['FundCategories', 'SubCategories']
        ]);

        $this->set('fund', $fund);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fund = $this->Funds->newEntity();
        if ($this->request->is('post')) {
            $fund = $this->Funds->patchEntity($fund, $this->request->getData());
            if ($this->Funds->save($fund)) {
                $this->Flash->success(__('The fund has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fund could not be saved. Please, try again.'));
        }
        $fundCategories = $this->Funds->FundCategories->find('list', ['limit' => 200]);
        $subCategories = $this->Funds->SubCategories->find('list', ['limit' => 200]);
        $this->set(compact('fund', 'fundCategories', 'subCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fund id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fund = $this->Funds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fund = $this->Funds->patchEntity($fund, $this->request->getData());
            if ($this->Funds->save($fund)) {
                $this->Flash->success(__('The fund has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fund could not be saved. Please, try again.'));
        }
        $fundCategories = $this->Funds->FundCategories->find('list', ['limit' => 200]);
        $subCategories = $this->Funds->SubCategories->find('list', ['limit' => 200]);
        $this->set(compact('fund', 'fundCategories', 'subCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fund id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fund = $this->Funds->get($id);
        if ($this->Funds->delete($fund)) {
            $this->Flash->success(__('The fund has been deleted.'));
        } else {
            $this->Flash->error(__('The fund could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

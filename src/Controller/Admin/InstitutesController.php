<?php

namespace App\Controller\admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Institutes Controller
 *
 * @property \App\Model\Table\InstitutesTable $Institutes
 *
 * @method \App\Model\Entity\Institute[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InstitutesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->viewBuilder()->layout('admin');

        $institutes = $this->Institutes->find('all', [
                    'contain' => ['InstituteTypes', 'Cities']
                ])->toArray();

        $this->set(compact('institutes'));
    }

    public function institutes($fund_id = null) {
        $this->viewBuilder()->layout('admin');

        $conn = ConnectionManager::get('default');

        $povertybase = $conn->execute(
                'SELECT DISTINCT i.id,i.name as institute_name,i.reg_num,i.photo_of_affiliation,i.contact_number,i.address,u.email,c.name as city_name'
                . ' FROM institutes as i '
                . 'inner join users as u ON i.user_id=u.id '
                . 'join cities as c ON c.id=i.city_id '
                . 'inner join instituteclasses ON instituteclasses.institute_id=i.id '
                . 'inner join applicants as a ON a.instituteclass_id=instituteclasses.id '
                . 'inner join institute_funddetails as ifd ON ifd.applicant_id=a.id '
                . 'where ifd.fund_id  = ' . $fund_id);
        $institutes = $povertybase->fetchAll('assoc');
//        debug($institutes);

//        $institutes = $this->Institutes->find('all')
//                ->where(['user_id IS NOT' => null, 'institute_type_id' => 3])
//                ->contain(['Cities', 'Users']);
//        debug($institutes);
//        exit;
        $this->set(compact('institutes'));
    }

    /**
     * View method
     *
     * @param string|null $id Institute id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->layout('admin');
        $institute = $this->Institutes->get($id, [
            'contain' => ['InstituteTypes', 'Cities', 'Qualifications']
        ]);

        $this->set('institute', $institute);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        $institute = $this->Institutes->newEntity();
        if ($this->request->is('post')) {
            $institute = $this->Institutes->patchEntity($institute, $this->request->getData());
            if ($this->Institutes->save($institute)) {
                $this->Flash->success(__('The institute has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The institute could not be saved. Please, try again.'));
        }
        $instituteTypes = $this->Institutes->InstituteTypes->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'type']);
        $cities = $this->Institutes->Cities->find('list', ['limit' => 200]);
        $this->set(compact('institute', 'instituteTypes', 'cities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Institute id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->viewBuilder()->layout('admin');
        $institute = $this->Institutes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $institute = $this->Institutes->patchEntity($institute, $this->request->getData());
            if ($this->Institutes->save($institute)) {
                $this->Flash->success(__('The institute has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The institute could not be saved. Please, try again.'));
        }
        $instituteTypes = $this->Institutes->InstituteTypes->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'type']);
        $cities = $this->Institutes->Cities->find('list', ['limit' => 200]);
        $this->set(compact('institute', 'instituteTypes', 'cities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Institute id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $institute = $this->Institutes->get($id);
        if ($this->Institutes->delete($institute)) {
            $this->Flash->success(__('The institute has been deleted.'));
        } else {
            $this->Flash->error(__('The institute could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

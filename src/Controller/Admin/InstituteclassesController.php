<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Instituteclasses Controller
 *
 * @property \App\Model\Table\InstituteclassesTable $Instituteclasses
 *
 * @method \App\Model\Entity\Instituteclass[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InstituteclassesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('admin');
    }

    public function index($id = null, $fund_id = null) {
//debug($fund_id);exit;
        $this->loadModel('Institutes');
        $ins = $this->Institutes->get($id);

        $conn = ConnectionManager::get('default');

        $povertybase = $conn->execute(
                'SELECT DISTINCT sc.class_number,ic.id ,ic.total_students,ic.minority_students,ic.needy_students,ic.textbook_cost,ic.boys_uniform,ic.girls_uniform'
                . ' FROM instituteclasses as ic '
                . 'inner join school_classes as sc ON sc.id=ic.school_class_id '
                . 'inner join applicants as a ON a.instituteclass_id=ic.id '
                . 'inner join institute_funddetails as ifd ON ifd.applicant_id=a.id '
                . 'where ic.institute_id  = ' . $ins->id . ' AND ifd.fund_id=' . $fund_id);
        $instituteclasses = $povertybase->fetchAll('assoc');
//        debug($instituteclasses);
//        exit;
//        $instituteclasses = $this->Instituteclasses->find('all')
//                ->contain(['SchoolClasses'])
//                ->where(['institute_id' => $ins->id]);

        $this->set(compact('instituteclasses', 'ins'));
    }

    /**
     * View method
     *
     * @param string|null $id Instituteclass id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $instituteclass = $this->Instituteclasses->get($id, [
            'contain' => ['SchoolClasses', 'Institutes', 'Applicants']
        ]);

        $this->set('instituteclass', $instituteclass);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $instituteclass = $this->Instituteclasses->newEntity();
        if ($this->request->is('post')) {
            $instituteclass = $this->Instituteclasses->patchEntity($instituteclass, $this->request->getData());
            if ($this->Instituteclasses->save($instituteclass)) {
                $this->Flash->success(__('The instituteclass has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The instituteclass could not be saved. Please, try again.'));
        }
        $schoolClasses = $this->Instituteclasses->SchoolClasses->find('list', ['limit' => 200]);
        $institutes = $this->Instituteclasses->Institutes->find('list', ['limit' => 200]);
        $this->set(compact('instituteclass', 'schoolClasses', 'institutes'));
    }

    public function viewapplicants($id = null, $fund_id = null) {
        $this->loadModel('InstituteFunddetails');
        $this->loadModel('ApplicantFunddetails');

        // institute name, class name, male payment, female payment 
        $conn = ConnectionManager::get('default');
        $class_name = $conn->execute('SELECT sc.class_number,ic.textbook_cost,ic.boys_uniform,ic.girls_uniform,i.name FROM `instituteclasses` as ic JOIN institutes as i ON i.id=ic.institute_id JOIN school_classes as sc ON ic.school_class_id= sc.id WHERE ic.id=' . $id);
        $results = $class_name->fetchAll('assoc');

        // import cities for Domicile
        $this->loadModel('Cities');
        $cities = $this->Cities->find('list', ['order' => 'name'])->toArray();

        // check amount distributed for applicants
        $applicants_amount = $this->ApplicantFunddetails->find();
        $res = $applicants_amount->select(['sum' => $applicants_amount->func()->sum('ApplicantFunddetails.amount_recived')])->where(['fund_id' => $fund_id])->first();

        // check amount distributed in institute applicants
        $institute_amount = $this->InstituteFunddetails->find();
        $res1 = $institute_amount->select(['sum' => $institute_amount->func()->sum('InstituteFunddetails.amount_recived')])->where(['fund_id' => $fund_id])->first();
        $distributed_amount = $res->sum + $res1->sum;
        if ($res->sum == null) {
            $distributed_amount = 0;
        }
        $this->set(compact('distributed_amount'));

        $selected_applicants = $this->ApplicantFunddetails->find('all')->where(['fund_id' => $fund_id, 'selected' => 1, 'amount_recived IS NOT' => null])->count();
        $fund_amount = $this->Funds->get($fund_id);

        if ($this->request->is('post')) {
//            debug($this->request->data);exit;
            $payment = 0;
            foreach ($this->request->data['InstituteFunddetails']['selected'] as $keycount => $count_payment):
                if ($count_payment != 0) {
                    $payment += $this->request->data['InstituteFunddetails']['amount_recived'][$keycount];
                }
            endforeach;
//            debug($payment);
//            exit();
            if ($payment > $fund_amount->total_amount) {
                $this->Flash->error('You have insufficient balance for the request');
                return $this->redirect(['action' => 'viewapplicants', $id, $fund_id]);
            } else {
                foreach ($this->request->data['InstituteFunddetails']['selected'] as $key => $value):
                    if ($value != 0) {
                        $save_array = array();
                        $save_array['amount_recived'] = $this->request->data['InstituteFunddetails']['amount_recived'][$key];
                        $save_array['selected'] = 1;
                        $save_array['payment_date'] = date('Y-m-d');
                        $institutefunddetail = $this->InstituteFunddetails->get($value);
                        $institutefunddetail = $this->InstituteFunddetails->patchEntity($institutefunddetail, $save_array);
                        $this->InstituteFunddetails->save($institutefunddetail);
                    }
                endforeach;
                $this->Flash->success('The data is saved successfully.');
                return $this->redirect(['action' => 'viewapplicants', $id, $fund_id]);
            }
        } else {
            $povertybase = $conn->execute(
                    'SELECT ifd.id,ifd.amount_recived,ifd.selected,ifd.payment_date, a.name ,a.father_name,a.cnic,a.gender,a.domicile,ac.mob_number,r.religion_name,ad.current_address,c.name as city_name'
                    . ' FROM institute_funddetails as ifd '
                    . 'inner join applicants as a ON a.id=ifd.applicant_id '
                    . 'inner join religions as r ON r.id=a.religion_id '
                    . 'inner join applicantaddresses as ad ON a.id=ad.applicant_id '
                    . 'inner join cities as c ON c.id=ad.city_id '
                    . 'inner join applicantcontacts as ac ON a.id=ac.applicant_id '
                    . 'inner join instituteclasses as ic ON a.instituteclass_id=ic.id '
                    . 'where a.instituteclass_id  = ' . $id . ' AND ifd.fund_id=' . $fund_id);
            $class_applicants = $povertybase->fetchAll('assoc');
//            debug($class_applicants);exit;
        }
        $this->set(compact('selected_applicants', 'fund_amount', 'applicant', 'cities', 'class_applicants', 'results'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Instituteclass id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $instituteclass = $this->Instituteclasses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $instituteclass = $this->Instituteclasses->patchEntity($instituteclass, $this->request->getData());
            if ($this->Instituteclasses->save($instituteclass)) {
                $this->Flash->success(__('The instituteclass has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The instituteclass could not be saved. Please, try again.'));
        }
        $schoolClasses = $this->Instituteclasses->SchoolClasses->find('list', ['limit' => 200]);
        $institutes = $this->Instituteclasses->Institutes->find('list', ['limit' => 200]);
        $this->set(compact('instituteclass', 'schoolClasses', 'institutes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Instituteclass id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $instituteclass = $this->Instituteclasses->get($id);
        if ($this->Instituteclasses->delete($instituteclass)) {
            $this->Flash->success(__('The instituteclass has been deleted.'));
        } else {
            $this->Flash->error(__('The instituteclass could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Applicants Controller
 *
 * @property \App\Model\Table\ApplicantsTable $Applicants
 *
 * @method \App\Model\Entity\Applicant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
//    public function beforeFilter(\Cake\Event\Event $event) {
//        parent::beforeFilter($event);
//        $this->Auth->allow(['dashboard']);
//    }
    public function isAuthorized($user) {
        if ($this->Auth->user('role_id') == 1) {
            return true;
        }
        if (isset($user['role_id']) && $user['role_id'] === 2) {
            $allow_user = array('index', 'view');
            if (in_array($this->request->params['action'], $allow_user)) {
                return true;
            }
        }

// Default deny
        return false;
    }

    public function index() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Funds');
        $this->loadModel('Cities');
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);

        $fundslist = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['active' => 1])
                ->toArray();
        $cities = $this->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);

        $this->set(compact('fundslist', 'cities', 'religions'));
        $fields = $joins = '';

        $fund_id = 'order by last_date desc limit 1';
        if ($this->request->is('post')) {
            $fund_id = 'where funds.id=' . $this->request->data['funds'];
        }
        $conn = ConnectionManager::get('default');
        $fund_details = $conn->execute('Select id,sub_category_id as sub_cat FROM funds ' . $fund_id);
        $fund_details_results = $fund_details->fetchAll('assoc');

//        debug($fund_details_results[0]['id']);
//        exit();
        $condition = 'funds.active=1 AND funds.id=' . $fund_details_results[0]['id'];
        if ($fund_details_results[0]['sub_cat'] == 3) {
            $fields .= ',q.percentage,q.passing_date,q.recent_class,q.current_class,d.discipline,ql.name as qualification_name';
            $joins .= 'join qualifications as q ON q.applicant_id=ap.id join qualification_levels as ql ON ql.id=q.qualification_level_id join disciplines as d ON d.id=q.discipline_id ';
        }

        if ($this->request->is('post')) {
            if (!empty($this->request->data['city_id'])) {
                $condition .= ' AND aad.city_id=' . $this->request->data['city_id'];
            }
            if (!empty($this->request->data['religion'])) {
                $condition .= ' AND ap.religion_id =' . $this->request->data['religion'];
            }
            if (!empty($this->request->data['token'])) {
                $condition = 'af.id=' . $this->request->data['token'];
            }
//            debug($condition);exit;
        }
        $povertybase = $conn->execute(
                'SELECT funds.id as f_id, sc.id as sub_cat_id, af.id as af_id,af.amount_recived,af.check_number,af.payment_date,af.appling_date,ap.id as applicant_id,ap.name as app_name,ap.father_name,ap.cnic,ap.gender,ahd.dependent_family_members,ai.monthly_income,c.name as city_name,r.religion_name' . $fields
                . ' FROM applicant_funddetails as af '
                . 'inner join funds ON af.fund_id=funds.id '
                . 'inner join sub_categories as sc ON sc.id=funds.sub_category_id '
                . 'inner join applicants as ap ON ap.id=af.applicant_id '
                . 'left join applicant_household_details as ahd ON ahd.applicant_id=ap.id '
                . 'join religions as r ON r.id=ap.religion_id '
                . 'left join applicantincomes as ai ON ai.applicant_id=ap.id '
                . 'left join applicantaddresses aad ON aad.applicant_id=ap.id '
                . 'left join cities as c ON c.id=aad.city_id '
                . $joins
                . 'where ' . $condition . ' group by af.id order by af.id DESC');
        $results = $povertybase->fetchAll('assoc');
//        debug($results);
//        exit;

        $this->set(compact('results'));
    }

    public function dashboard_map($id = null) {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Cities');
        $this->loadModel('Funds');
        $conn = ConnectionManager::get('default');

        $query2 = $conn->execute('SELECT latitude,longitude'
                . ' FROM applicants  as app '
                . 'inner join applicant_funddetails as det  ON app.id=det.applicant_id '
                . 'inner join funds as ap ON ap.id=det.fund_id '
                . 'inner join religions as re ON re.id=app.religion_id '
                . 'inner join applicantaddresses as address ON address.applicant_id=app.id '
                . 'inner join cities  ON cities.id=address.city_id '
                . 'where fund_name="' . $_GET['value'] . '" and active=' . 1);
        // debug($query2);exit;
        $ceety = $query2->fetchAll('assoc');

        echo json_encode($ceety);
        exit;
        //debug($funds);exit;

        $city = $this->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
    }

    public function fundsanalysis($id = null) {

        $conn = ConnectionManager::get('default');

        $query2 = $conn->execute('SELECT *'
                . ' FROM applicants  as app '
                . 'inner join applicant_funddetails as det  ON app.id=det.applicant_id '
                . 'inner join funds as ap ON ap.id=det.fund_id '
                . 'inner join religions as re ON re.id=app.religion_id '
                . 'inner join applicantaddresses as address ON address.applicant_id=app.id '
                . 'inner join cities  ON cities.id=address.city_id ');

        // debug($query2);exit;
        $ceety = $query2->fetchAll('assoc');

        echo json_encode($ceety);
        exit;
        //debug($funds);exit;

        $city = $this->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
    }

    public function district($id = null, $id1 = null) {
        // $id=$_GET['value'];
        //$id1=$_GET['value1'];
        // $this->viewBuilder()->layout('admin');
        //require 'Cake\Datasource\ConnectionManager';
        // require_once(ROOT .'Cake');
        $dist = $_GET['value'];
        $dist1 = $_GET['value1'];
        $this->set(compact('dist'));
        $conn = ConnectionManager::get('default');

        $query = $conn->execute('SELECT COUNT(religion_id),COUNT(det.applicant_id) As ap,fund_name,religion_id,religion_name'
                . ' FROM applicants  as app '
                . 'inner join applicant_funddetails as det  ON app.id=det.applicant_id '
                . 'inner join funds as ap ON ap.id=det.fund_id '
                . 'inner join religions as re ON re.id=app.religion_id '
                . 'inner join applicantaddresses  ON applicantaddresses.applicant_id=app.id '
                . 'inner join cities as city ON city.id=applicantaddresses.city_id '
                . 'where fund_name="' . $dist1 . '" and city_id=' . $dist . ' && active=' . 1 . ' GROUP BY fund_name');
        $ceety = $query->fetchAll('assoc');
        //debug($ceety);
        echo json_encode($ceety);
        exit;
        //debug($funds);exit;
    }

    public function religion_graph($id = null, $id1 = null) {
        // $id=$_GET['value'];
        //$id1=$_GET['value1'];
        // $this->viewBuilder()->layout('admin');
        //require 'Cake\Datasource\ConnectionManager';
        // require_once(ROOT .'Cake');
        $dist = $_GET['value'];
        $dist1 = $_GET['value1'];
        $this->set(compact('dist'));
        $conn = ConnectionManager::get('default');


        $query = $conn->execute('SELECT religion_name,count(religion_id) As re,color as co '
                . ' FROM applicants  as app '
                . 'inner join applicant_funddetails as det  ON app.id=det.applicant_id '
                . 'inner join funds as ap ON ap.id=det.fund_id '
                . 'inner join religions as re ON re.id=app.religion_id '
                . 'inner join applicantaddresses  ON applicantaddresses.applicant_id=app.id '
                . 'inner join cities as city ON city.id=applicantaddresses.city_id '
                . 'where active=' . 1 . ' AND  city_id= ' . $dist . ' and fund_name= "' . $dist1 . '" GROUP BY religion_id');

        $ceety = $query->fetchAll('assoc');
        //debug($ceety);
        echo json_encode($ceety);
        exit;
        //debug($funds);exit;
    }

    public function deselect() {
        $this->loadModel('Funds');
        $this->loadModel('ApplicantFunddetails');
        $this->viewBuilder()->layout('admin');
        $funds = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['active' => '1']);
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);
        $this->set(compact('funds', 'religions', 'cities'));
        if ($this->request->is('post')) {
//            debug($this->request->data);
//            exit();
            extract($this->request->data);
            $fund_cat = $this->Funds->get($fund_id);

            $condition = $fields = $joins = '';
            if ($fund_cat->sub_category_id == 3) {
                $fields .= ',q.percentage,q.passing_date,q.recent_class,q.current_class,d.discipline,ql.name as qualification_name';
                $joins .= 'join qualifications as q ON q.applicant_id=ap.id join qualification_levels as ql ON ql.id=q.qualification_level_id join disciplines as d ON d.id=q.discipline_id ';
            }
            if (!empty($religion)) {
                $condition .= ' AND ap.religion_id =' . $religion;
            }
            if (!empty($city)) {
                $condition .= ' AND aad.city_id =' . $city;
            }
            if (!empty($cnic)) {
                $condition = ' AND af.id =' . $cnic;
            }

            $user_balance = $this->ApplicantFunddetails->find();
            $res = $user_balance->select(['sum' => $user_balance->func()->sum('ApplicantFunddetails.amount_recived')])
                    ->where(['fund_id' => $fund_id])
                    ->first();
            $distributed_amount = $res->sum;
            if ($res->sum == null) {
                $distributed_amount = 0;
            }
            $this->set(compact('distributed_amount'));

            $selected_applicants = $this->ApplicantFunddetails->find('all')
                    ->where(['fund_id' => $fund_id, 'selected' => 1, 'amount_recived IS NOT' => null])
                    ->count();
            $fund_amount = $this->Funds->get($fund_id);
//debug($fund_amount);exit();

            $conn = ConnectionManager::get('default');

            $povertybase = $conn->execute(
                    'SELECT af.id as af_id,af.selected,af.amount_recived,af.check_number,af.payment_date,af.appling_date,af.distributed,ap.name as app_name,ap.father_name,ap.cnic,ap.gender,ahd.dependent_family_members,ai.monthly_income,c.name as city_name,r.religion_name' . $fields
                    . ' FROM applicant_funddetails as af '
                    . 'inner join applicants as ap ON ap.id=af.applicant_id '
                    . $joins
                    . 'left join applicant_household_details as ahd ON ahd.applicant_id=ap.id '
                    . 'join religions as r ON r.id=ap.religion_id '
                    . 'left join applicantincomes as ai ON ai.applicant_id=ap.id '
                    . 'left join applicantaddresses aad ON aad.applicant_id=ap.id '
                    . 'left join cities as c ON c.id=aad.city_id '
                    . 'join funds as f ON af.fund_id=f.id '
                    . 'where af.selected =1 AND af.distributed=0 AND af.amount_recived IS NOT NULL AND af.fund_id=' . $fund_id . $condition);
            $results = $povertybase->fetchAll('assoc');
//                debug(count($results));
//                exit;
            $this->set(compact('selected_applicants', 'results', 'fund_amount'));
        }
    }

    public function distributegrants() {
        $this->loadModel('Funds');
        $this->loadModel('ApplicantFunddetails');
        $this->viewBuilder()->layout('admin');
        $funds = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['active' => '1']);
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);

        $this->set(compact('funds', 'religions', 'cities'));


        if ($this->request->is('post')) {
//            debug($this->request->data);
//            exit();

            extract($this->request->data);
            $fund_cat = $this->Funds->get($fund_id);

            $condition = $fields = $joins = '';
            if ($fund_cat->sub_category_id == 3) {
                $fields .= ',q.percentage,q.passing_date,q.recent_class,q.current_class,d.discipline,ql.name as qualification_name';
                $joins .= 'join qualifications as q ON q.applicant_id=ap.id join qualification_levels as ql ON ql.id=q.qualification_level_id join disciplines as d ON d.id=q.discipline_id ';
            }
            if (!empty($religion)) {
                $condition .= ' AND ap.religion_id =' . $religion;
            }
            if (!empty($city)) {
                $condition .= ' AND aad.city_id =' . $city;
            }
            if (!empty($cnic)) {
                $condition .= ' AND ap.cnic LIKE "%' . $cnic . '%" OR ap.name LIKE "%' . $cnic . '%"';
            }

            $user_balance = $this->ApplicantFunddetails->find();
            $res = $user_balance->select(['sum' => $user_balance->func()->sum('ApplicantFunddetails.amount_recived')])
                    ->where(['fund_id' => $fund_id])
                    ->first();
            $distributed_amount = $res->sum;
            if ($res->sum == null) {
                $distributed_amount = 0;
            }
            $this->set(compact('distributed_amount'));

            $selected_applicants = $this->ApplicantFunddetails->find('all')
                    ->where(['fund_id' => $fund_id, 'selected' => 1, 'amount_recived IS NOT' => null])
                    ->count();
            $fund_amount = $this->Funds->get($fund_id);
//debug($fund_amount);exit();

            $conn = ConnectionManager::get('default');

            $povertybase = $conn->execute(
                    'SELECT af.id as af_id,af.amount_recived,af.check_number,af.payment_date,af.appling_date,af.distributed,ap.name as app_name,ap.father_name,ap.cnic,ap.gender,ahd.dependent_family_members,ai.monthly_income,c.name as city_name,r.religion_name' . $fields
                    . ' FROM applicant_funddetails as af '
                    . 'inner join applicants as ap ON ap.id=af.applicant_id '
                    . $joins
                    . 'left join applicant_household_details as ahd ON ahd.applicant_id=ap.id '
                    . 'join religions as r ON r.id=ap.religion_id '
                    . 'left join applicantincomes as ai ON ai.applicant_id=ap.id '
                    . 'left join applicantaddresses aad ON aad.applicant_id=ap.id '
                    . 'left join cities as c ON c.id=aad.city_id '
                    . 'join funds as f ON af.fund_id=f.id '
                    . 'where af.selected =1 AND af.amount_recived IS NOT NULL AND af.fund_id=' . $fund_id . $condition);
            $results = $povertybase->fetchAll('assoc');
//                debug($results);
//                exit;
            $this->set(compact('selected_applicants', 'results', 'fund_amount'));
        }
    }

    public function datereporting() {
        $this->loadModel('Funds');
        $this->loadModel('ApplicantFunddetails');
        $this->viewBuilder()->layout('admin');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);
        $fundslist = $this->Funds->find('list', ['keyField' => 'fund_for_year', 'valueField' => 'fund_for_year', 'order' => 'fund_for_year DESC'])->distinct(['fund_for_year'])->toArray();
        $conn = ConnectionManager::get('default');
        $this->set(compact('religions', 'cities', 'fundslist'));
        if ($_GET) {
//            debug($_GET);exit();
            extract($_GET);
            $fund_cat = $this->Funds->get($fundslist);
            $condition = '';
            if (!empty($fundslist)) {
                $condition .= 'af.fund_id=' . $fundslist;
            }
            if (!empty($sdate) && !empty($edate)) {
                $condition .= " AND af.appling_date BETWEEN '" . $sdate . "' AND '" . $edate . "'";
            }



            if (!empty($status)) {
//                 debug($status);
                if ($status == 'selected') {
                    $condition .= ' AND af.selected=1 AND af.amount_recived IS NOT null';
                }
                if ($status == 'notselected') {
                    $condition .= ' AND af.selected=0 AND af.amount_recived IS null';
                }
                if ($status == 'distributed') {
                    $condition .= ' AND af.payment_date IS NOT NULL AND af.check_number IS NOT null';
                }
            }

//                $selected_applicants = $this->ApplicantFunddetails->find('all')
//                        ->where(['fund_id' => $fund_id, 'selected' => 1, 'amount_recived IS NOT' => null])
//                        ->count();
//                $fund_amount = $this->Funds->get($fund_id);
//debug($condition);
            $district_query = $conn->execute(
                    'SELECT c.id as city_id,c.name as city_name,count(fund_id) as total FROM applicant_funddetails as af'
                    . ' INNER JOIN applicants as ap ON ap.id=af.applicant_id '
                    . ' INNER JOIN religions as r ON r.id=ap.religion_id'
                    . ' INNER JOIN applicantaddresses as aad ON ap.id=aad.applicant_id'
                    . ' INNER JOIN cities as c ON c.id=aad.city_id'
                    . ' where ' . $condition . ' GROUP BY aad.city_id order by total desc');
            $district_wise = $district_query->fetchAll('assoc');
//            debug($district_wise);exit();

            $gender = $conn->execute(
                    'SELECT ap.gender, count(fund_id) as total FROM applicant_funddetails as af'
                    . ' INNER JOIN applicants as ap ON ap.id=af.applicant_id '
                    . ' INNER JOIN religions as r ON r.id=ap.religion_id'
                    . ' INNER JOIN applicantaddresses as aad ON ap.id=aad.applicant_id'
                    . ' INNER JOIN cities as c ON c.id=aad.city_id'
                    . ' where ' . $condition . ' GROUP BY ap.gender  order by total desc');
            $gender_wise = $gender->fetchAll('assoc');
//            debug($gender_wise);exit();
            $religion_query = $conn->execute(
                    'SELECT r.religion_name, count(fund_id) as total FROM applicant_funddetails as af'
                    . ' INNER JOIN applicants as ap ON ap.id=af.applicant_id '
                    . ' INNER JOIN religions as r ON r.id=ap.religion_id'
                    . ' INNER JOIN applicantaddresses as aad ON ap.id=aad.applicant_id'
                    . ' INNER JOIN cities as c ON c.id=aad.city_id'
                    . ' where ' . $condition . ' GROUP BY ap.religion_id  order by total desc');
            $religion_wise = $religion_query->fetchAll('assoc');
//            debug($religion_wise);
//            exit;
            $this->set(compact('selected_applicants', 'district_wise', 'religion_wise', 'fund_amount', 'gender_wise', 'conn'));
        }

        if (isset($_GET['pdf'])) {
            $g_t = $r_t = $d_t = 0;
//            debug($district_wise);exit();
            require_once(ROOT . DS . 'vendor' . DS . 'tcpdf' . DS . 'examples' . DS . 'example_001.php');

            // set document information
//            $pdf->SetCreator(PDF_CREATOR);
//            $pdf->SetAuthor('Nicola Asuni');
//            $pdf->SetTitle('TCPDF Example 001');
//            $pdf->SetSubject('TCPDF Tutorial');
//            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(17, 125, 44), array(17, 125, 44));
//            $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
//            if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//                require_once(dirname(__FILE__) . '/lang/eng.php');
//                $pdf->setLanguageArray($l);
//            }
            // ---------------------------------------------------------
            // set default font subsetting mode
            $pdf->setFontSubsetting(true);

            // Set font
            // dejavusans is a UTF-8 Unicode font, if you only need to
            // print standard ASCII chars, you can use core fonts like
            // helvetica or times to reduce file size.
            $pdf->SetFont('dejavusans', '', 14, '', true);

            // Add a page
            // This method has several options, check the source code documentation for more information.
            $pdf->AddPage();

            // set text shadow effect
            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

            // Set some content to print

            $html = <<<EOD
                    <p style="font-size:18px;color:green;">Summary of $fund_cat->fund_name</p>
                    <p style="font-size:16px;color:green;">Gender Report</p>
                    <table style="border: 1px solid #black;text-align: center; border-collapse: collapse;width: 100%;">
                   <tr>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Gender</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">No's of Applicants</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Remarks</th>
                   </tr>
EOD;

            foreach ($gender_wise as $gender_data) {
                $g_t += $gender_data['total'];
                $html .= '<tr>
                    <td style="border: 1px solid #black;font-size:13px;">' . ucfirst($gender_data['gender']) . '</td>
                    <td style="border: 1px solid #black;font-size:13px;">' . $gender_data['total'] . '</td>
                    <td style="border: 1px solid #black;"></td>
                   </tr>';
            }
            $html .= '<tr><td style="border: 1px solid #black;font-size:13px;"></td><td style="border: 1px solid #black;font-size:13px;">Total= &nbsp;' . $g_t . '</td></tr></table>';

            $html .= <<<EOD
                    <p style="font-size:16px;color:green;">Religion Report</p>
                    <table style="border: 1px solid #black;text-align: center; border-collapse: collapse;width: 100%;">
                   <tr>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Religion</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">No's of Applicants</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Remarks</th>
                   </tr>
EOD;

            foreach ($religion_wise as $religion_data) {
                $r_t += $religion_data['total'];
                $html .= '<tr>
                    <td style="border: 1px solid #black;font-size:13px;">' . $religion_data['religion_name'] . '</td>
                    <td style="border: 1px solid #black;font-size:13px;">' . $religion_data['total'] . '</td>
                    <td style="border: 1px solid #black;"></td>
                   </tr>';
            }
            $html .= '<tr><td style="border: 1px solid #black;font-size:13px;"></td><td style="border: 1px solid #black;font-size:13px;">Total= &nbsp;' . $r_t . '</td></tr></table>';

            $html .= <<<EOD
                    <p style="font-size:16px;color:green;">District Report</p>
                    <table style="border: 1px solid #black;text-align: center; border-collapse: collapse;width: 100%;">
                   <tr>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">District</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Religion wise</th>                 
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Total Applicants</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Remarks</th>
                   </tr>
EOD;

            foreach ($district_wise as $district_data) {
                $d_t += $district_data['total'];
                $each_religion = $conn->execute(
                        'SELECT r.religion_name as religion_name,count(ap.religion_id) as total FROM applicant_funddetails as af'
                        . ' INNER JOIN applicants as ap ON ap.id=af.applicant_id '
                        . ' INNER JOIN religions as r ON r.id=ap.religion_id '
                        . ' INNER JOIN applicantaddresses as aad ON ap.id=aad.applicant_id'
                        . ' INNER JOIN cities as c ON c.id=aad.city_id'
                        . ' where aad.city_id=' . $district_data['city_id'] . ' AND af.fund_id=' . $_GET['fundslist'] . '  GROUP BY ap.religion_id');

                $r_wise = $each_religion->fetchAll('assoc');

                $html .= '<tr>
                    <td style="border: 1px solid #black;font-size:13px;"><br/><br/>' . $district_data['city_name'] . '<br/></td>';
                $html .= '<td><table style="border-top:1px solid gray;text-align:left;">';
                foreach ($r_wise as $value):
                    $html .= '<tr><th style="font-size:13px;">' . $value['religion_name'] . ':</th><td style="font-size:13px;">' . $value['total'] . '</td></tr>';
                endforeach;
                $html .= '</table><br/></td><td style="border: 1px solid #black;padding: 15px;font-size:13px;"><br/><br/>' . $district_data['total'] . '</td>
                    <td style="border: 1px solid #black;"></td>
                   </tr>';
            }
            $html .= '<tr><td style="border: 1px solid #black;font-size:13px;"></td><td style="border: 1px solid #black;font-size:13px;"></td><td style="border: 1px solid #black;font-size:13px;">Total= &nbsp;' . $d_t . '</td></tr></table>';

            // Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            // ---------------------------------------------------------
            // Close and output PDF document
            // This method has several options, check the source code documentation for more information.
            $pdf->Output($fund_cat->fund_name . '.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
        }
    }

    public function region() {
        $this->loadModel('Funds');
        $this->loadModel('ApplicantFunddetails');
        $this->viewBuilder()->layout('admin');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);
        $fundslist = $this->Funds->find('list', ['keyField' => 'fund_for_year', 'valueField' => 'fund_for_year', 'order' => 'fund_for_year DESC'])->distinct(['fund_for_year'])->toArray();
//        debug($fundslist);
//        exit;
        $conn = ConnectionManager::get('default');
        $this->set(compact('religions', 'cities', 'fundslist'));
        if ($_GET) {
            extract($_GET);
            $fund_cat = $this->Funds->get($fundslist);
            $condition = '';

            if (!empty($fundslist)) {
                $condition .= 'af.fund_id=' . $fundslist;
            }

            if (!empty($status)) {
//                 debug($status);
                if ($status == 'selected') {
                    $condition .= ' AND af.selected=1 AND af.amount_recived IS NOT null';
                }
                if ($status == 'notselected') {
                    $condition .= ' AND af.selected=0 AND af.amount_recived IS null';
                }
                if ($status == 'distributed') {
                    $condition .= ' AND af.payment_date IS NOT NULL AND af.check_number IS NOT null';
                }
            }
            $count_total_amount = $conn->execute(
                    'SELECT count(distinct(af.id)) as total_applicants'
                    . ' FROM applicant_funddetails as af '
                    . ' INNER JOIN applicants as ap ON ap.id=af.applicant_id '
                    . ' INNER JOIN religions as r ON r.id=ap.religion_id'
                    . ' INNER JOIN applicantaddresses as aad ON ap.id=aad.applicant_id'
                    . ' INNER JOIN cities as c ON c.id=aad.city_id'
                    . ' where ' . $condition);
            $results = $count_total_amount->fetchAll('assoc');
            $total_applicants = $results[0]['total_applicants'];
            $district_query = $conn->execute(
                    'SELECT c.id as city_id,c.name as city_name,count(fund_id) as total FROM applicant_funddetails as af'
                    . ' INNER JOIN applicants as ap ON ap.id=af.applicant_id '
                    . ' INNER JOIN religions as r ON r.id=ap.religion_id'
                    . ' INNER JOIN applicantaddresses as aad ON ap.id=aad.applicant_id'
                    . ' INNER JOIN cities as c ON c.id=aad.city_id'
                    . ' where ' . $condition . ' GROUP BY aad.city_id order by total desc');
            $district_wise = $district_query->fetchAll('assoc');

            $gender = $conn->execute(
                    'SELECT ap.gender, count(fund_id) as total FROM applicant_funddetails as af'
                    . ' INNER JOIN applicants as ap ON ap.id=af.applicant_id '
                    . ' INNER JOIN religions as r ON r.id=ap.religion_id'
                    . ' INNER JOIN applicantaddresses as aad ON ap.id=aad.applicant_id'
                    . ' INNER JOIN cities as c ON c.id=aad.city_id'
                    . ' where ' . $condition . ' GROUP BY ap.gender  order by total desc');
            $gender_wise = $gender->fetchAll('assoc');
            $religion_query = $conn->execute(
                    'SELECT r.religion_name, count(fund_id) as total FROM applicant_funddetails as af'
                    . ' INNER JOIN applicants as ap ON ap.id=af.applicant_id '
                    . ' INNER JOIN religions as r ON r.id=ap.religion_id'
                    . ' INNER JOIN applicantaddresses as aad ON ap.id=aad.applicant_id'
                    . ' INNER JOIN cities as c ON c.id=aad.city_id'
                    . ' where ' . $condition . ' GROUP BY ap.religion_id  order by total desc');
            $religion_wise = $religion_query->fetchAll('assoc');

            $this->set(compact('selected_applicants', 'district_wise', 'religion_wise', 'fund_amount', 'gender_wise', 'conn', 'total_applicants'));
        }

        if (isset($_GET['pdf'])) {
            $g_t = $r_t = $d_t = 0;
            require_once(ROOT . DS . 'vendor' . DS . 'tcpdf' . DS . 'examples' . DS . 'example_001.php');

            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(17, 125, 44), array(17, 125, 44));
//            $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
//            if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//                require_once(dirname(__FILE__) . '/lang/eng.php');
//                $pdf->setLanguageArray($l);
//            }
            // ---------------------------------------------------------
            // set default font subsetting mode
            $pdf->setFontSubsetting(true);

            // Set font
            // dejavusans is a UTF-8 Unicode font, if you only need to
            // print standard ASCII chars, you can use core fonts like
            // helvetica or times to reduce file size.
            $pdf->SetFont('dejavusans', '', 14, '', true);

            // Add a page
            // This method has several options, check the source code documentation for more information.
            $pdf->AddPage();

            // set text shadow effect
            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

            // Set some content to print

            $html = <<<EOD
                    <p style="font-size:18px;color:green;">Summary of $fund_cat->fund_name</p>
                    <p style="font-size:16px;color:green;">Gender Report</p>
                    <table style="border: 1px solid #black;text-align: center; border-collapse: collapse;width: 100%;">
                   <tr>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Gender</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">No's of Applicants</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Percentage</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Remarks</th>
                   </tr>
EOD;

            foreach ($gender_wise as $gender_data) {
                $g_t += $gender_data['total'];
                $html .= '<tr>
                    <td style="border: 1px solid #black;font-size:13px;">' . ucfirst($gender_data['gender']) . '</td>
                    <td style="border: 1px solid #black;font-size:13px;">' . $gender_data['total'] . '</td>
                    <td style="border: 1px solid #black;font-size:13px;">' . round(($gender_data['total'] / $total_applicants) * 100, 2) . '%</td>
                    <td style="border: 1px solid #black;"></td>
                   </tr>';
            }
            $html .= '<tr><td style="border: 1px solid #black;font-size:13px;"></td><td style="border: 1px solid #black;font-size:13px;">Total= &nbsp;' . $g_t . '</td></tr></table>';

            $html .= <<<EOD
                    <p style="font-size:16px;color:green;">Religion Report</p>
                    <table style="border: 1px solid #black;text-align: center; border-collapse: collapse;width: 100%;">
                   <tr>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Religion</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">No's of Applicants</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Percentage</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Remarks</th>
                   </tr>
EOD;

            foreach ($religion_wise as $religion_data) {
                $r_t += $religion_data['total'];
                $html .= '<tr>
                    <td style="border: 1px solid #black;font-size:13px;">' . $religion_data['religion_name'] . '</td>
                    <td style="border: 1px solid #black;font-size:13px;">' . $religion_data['total'] . '</td>
                    <td style="border: 1px solid #black;font-size:13px;">' . round(($religion_data['total'] / $total_applicants) * 100, 2) . '%</td>
                    <td style="border: 1px solid #black;"></td>
                   </tr>';
            }
            $html .= '<tr><td style="border: 1px solid #black;font-size:13px;"></td><td style="border: 1px solid #black;font-size:13px;">Total= &nbsp;' . $r_t . '</td></tr></table>';

            $html .= <<<EOD
                    <p style="font-size:16px;color:green;">District Report</p>
                    <table style="border: 1px solid #black;text-align: center; border-collapse: collapse;width: 100%;">
                   <tr>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">District</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Religion wise</th>                 
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Total Applicants</th>
                    <th style="border: 1px solid #black;text-align: center;font-size:14px;">Remarks</th>
                   </tr>
EOD;

            foreach ($district_wise as $district_data) {
                $d_t += $district_data['total'];
                $each_religion = $conn->execute(
                        'SELECT r.religion_name as religion_name,count(ap.religion_id) as total FROM applicant_funddetails as af'
                        . ' INNER JOIN applicants as ap ON ap.id=af.applicant_id '
                        . ' INNER JOIN religions as r ON r.id=ap.religion_id '
                        . ' INNER JOIN applicantaddresses as aad ON ap.id=aad.applicant_id'
                        . ' INNER JOIN cities as c ON c.id=aad.city_id'
                        . ' where aad.city_id=' . $district_data['city_id'] . ' AND af.fund_id=' . $_GET['fundslist'] . '  GROUP BY ap.religion_id');

                $r_wise = $each_religion->fetchAll('assoc');

                $html .= '<tr>
                    <td style="border: 1px solid #black;font-size:13px;"><br/><br/>' . $district_data['city_name'] . '<br/></td>';
                $html .= '<td><table style="border-top:1px solid gray;text-align:left;">';
                foreach ($r_wise as $value):
                    $html .= '<tr><th style="font-size:13px;">' . $value['religion_name'] . ':</th><td style="font-size:13px;">' . $value['total'] . '</td></tr>';
                endforeach;
                $html .= '</table><br/></td><td style="border: 1px solid #black;font-size:13px;"><br/><br/>' . $district_data['total'] . '</td>
                    <td style="border: 1px solid #black;"></td>
                   </tr>';
            }
            $html .= '<tr><td style="border: 1px solid #black;font-size:13px;"></td><td style="border: 1px solid #black;font-size:13px;"></td><td style="border: 1px solid #black;font-size:13px;">Total= &nbsp;' . $d_t . '</td></tr></table>';

            // Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            // ---------------------------------------------------------
            // Close and output PDF document
            // This method has several options, check the source code documentation for more information.
            $pdf->Output($fund_cat->fund_name . '.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
        }
    }

    public function institute_reporting() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Funds');
        $this->loadModel('ApplicantFunddetails');
        $this->viewBuilder()->layout('admin');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);
        $fundslist = $this->Funds->find('list', ['keyField' => 'fund_for_year', 'valueField' => 'fund_for_year', 'order' => 'fund_for_year DESC'])
                ->where(['Funds.sub_category_id' => 3]);
//        debug($fundslist->toArray());
//        exit;
        $conn = ConnectionManager::get('default');
        $this->set(compact('religions', 'cities', 'fundslist'));
        $funds = $ins_array = $ins_cls = '';

        if ($_GET) {
            extract($_GET);
            $condition = 'ic.institute_id  = ' . $institutes . ' AND';

            if ($fundsyear) {
                $funds = $this->Funds->find('list', ['contain' => ['SubCategories']
                        ])->where(['Funds.fund_for_year' => $fundsyear, 'SubCategories.id' => 3])->toArray();
            }
            if ($fundslist) {
                $find_inst = $conn->execute(
                        'SELECT DISTINCT i.id,i.name as institute_name'
                        . ' FROM institutes as i '
                        . 'inner join instituteclasses ON instituteclasses.institute_id=i.id '
                        . 'inner join applicants as a ON a.instituteclass_id=instituteclasses.id '
                        . 'inner join institute_funddetails as ifd ON ifd.applicant_id=a.id '
                        . 'where ifd.fund_id  = ' . $fundslist);
                $ins_list = $find_inst->fetchAll('assoc');
                $ins_array = array();
                foreach ($ins_list as $ins):
                    $ins_array[$ins['id']] = $ins['institute_name'];
                endforeach;
//                exit();
            }
            if ($institutes) {
                $find_inst_cls = $conn->execute(
                        'SELECT DISTINCT sc.class_number,ic.id'
                        . ' FROM instituteclasses as ic '
                        . 'inner join school_classes as sc ON sc.id=ic.school_class_id '
                        . 'inner join applicants as a ON a.instituteclass_id=ic.id '
                        . 'inner join institute_funddetails as ifd ON ifd.applicant_id=a.id '
                        . 'where ic.institute_id  = ' . $institutes . ' AND ifd.fund_id=' . $fundslist);
                $ins_cls = $find_inst_cls->fetchAll('assoc');
            }
            if (isset($cls)) {
                if ($cls != 'all') {
                    $condition = 'ic.id  = ' . $cls . ' AND';
                }
            }

            $conn = ConnectionManager::get('default');
            $povertybase = $conn->execute(
                    'SELECT ifd.id,ifd.amount_recived,ifd.selected,ifd.payment_date, a.name ,a.father_name,a.cnic,a.gender,a.domicile,ac.mob_number,r.religion_name,ad.current_address,c.name as city_name,sc.class_number'
                    . ' FROM institute_funddetails as ifd '
                    . 'inner join applicants as a ON a.id=ifd.applicant_id '
                    . 'inner join religions as r ON r.id=a.religion_id '
                    . 'inner join applicantaddresses as ad ON a.id=ad.applicant_id '
                    . 'inner join cities as c ON c.id=ad.city_id '
                    . 'inner join applicantcontacts as ac ON a.id=ac.applicant_id '
                    . 'inner join instituteclasses as ic ON a.instituteclass_id=ic.id '
                    . 'inner join school_classes as sc ON sc.id=ic.school_class_id '
                    . 'where ' . $condition . ' ifd.fund_id=' . $fundslist);
            $institutes = $povertybase->fetchAll('assoc');
//            debug($institutes);exit;

            $this->set(compact('institutes'));
        }
        $this->set(compact('funds', 'ins_array', 'ins_cls'));
    }

    public function institute_classes() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Funds');
        $this->loadModel('ApplicantFunddetails');
        $this->viewBuilder()->layout('admin');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);
//        $fundslist = $this->Funds->find('list', ['keyField' => 'fund_for_year', 'valueField' => 'fund_for_year', 'order' => 'fund_for_year DESC'])->distinct(['fund_for_year'])->toArray();
        $fundslist = $this->Funds->find('list', ['keyField' => 'fund_for_year', 'valueField' => 'fund_for_year', 'order' => 'fund_for_year DESC'])
                ->where(['Funds.sub_category_id' => 3]);
//        debug($fundslist->toArray());
//        exit;
        $conn = ConnectionManager::get('default');
        $this->set(compact('religions', 'cities', 'fundslist'));
        $funds = $ins_array = $ins_cls = '';

        if ($_GET) {

            extract($_GET);
            if ($fundsyear) {
                $funds = $this->Funds->find('list', ['contain' => ['SubCategories']
                        ])->where(['Funds.fund_for_year' => $fundsyear, 'SubCategories.id' => 3])->toArray();
            }
            if ($fundslist) {
                $find_inst = $conn->execute(
                        'SELECT DISTINCT i.id,i.name as institute_name'
                        . ' FROM institutes as i '
                        . 'inner join instituteclasses ON instituteclasses.institute_id=i.id '
                        . 'inner join applicants as a ON a.instituteclass_id=instituteclasses.id '
                        . 'inner join institute_funddetails as ifd ON ifd.applicant_id=a.id '
                        . 'where ifd.fund_id  = ' . $fundslist);
                $ins_list = $find_inst->fetchAll('assoc');
                $ins_array = array();
                foreach ($ins_list as $ins):
                    $ins_array[$ins['id']] = $ins['institute_name'];
                endforeach;
//                exit();
            }
            $find_inst_cls = $conn->execute(
                    'SELECT DISTINCT sc.class_number,ic.id ,ic.total_students,ic.minority_students,ic.needy_students,ic.textbook_cost,ic.boys_uniform,ic.girls_uniform'
                    . ' FROM instituteclasses as ic '
                    . 'inner join school_classes as sc ON sc.id=ic.school_class_id '
                    . 'inner join applicants as a ON a.instituteclass_id=ic.id '
                    . 'inner join institute_funddetails as ifd ON ifd.applicant_id=a.id '
                    . 'where ic.institute_id  = ' . $institutes . ' AND ifd.fund_id=' . $fundslist);
            $institutes = $find_inst_cls->fetchAll('assoc');
//            debug($institutes);exit;

            $this->set(compact('institutes'));
        }
        $this->set(compact('funds', 'ins_array', 'ins_cls'));
    }

    public function institutes() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Funds');
        $this->loadModel('ApplicantFunddetails');
        $this->viewBuilder()->layout('admin');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);
        $fundslist = $this->Funds->find('list', ['keyField' => 'fund_for_year', 'valueField' => 'fund_for_year', 'order' => 'fund_for_year DESC'])
                ->where(['Funds.sub_category_id' => 3]);
//        debug($fundslist->toArray());
//        exit;
        $conn = ConnectionManager::get('default');
        $this->set(compact('religions', 'cities', 'fundslist'));
        $funds = $ins_array = $ins_cls = '';

        if ($_GET) {

            extract($_GET);
            if ($fundsyear) {
                $funds = $this->Funds->find('list', ['contain' => ['SubCategories']
                        ])->where(['Funds.fund_for_year' => $fundsyear, 'SubCategories.id' => 3])->toArray();
            }
            $find_inst_cls = $conn->execute('SELECT DISTINCT i.id,i.name as institute_name,i.reg_num,i.contact_number,i.address,u.email,c.name as city_name'
                    . ' FROM institutes as i '
                    . 'inner join users as u ON i.user_id=u.id '
                    . 'join cities as c ON c.id=i.city_id '
                    . 'inner join instituteclasses ON instituteclasses.institute_id=i.id '
                    . 'inner join applicants as a ON a.instituteclass_id=instituteclasses.id '
                    . 'inner join institute_funddetails as ifd ON ifd.applicant_id=a.id '
                    . 'where ifd.fund_id  = ' . $fundslist);
            $institutes = $find_inst_cls->fetchAll('assoc');
//            debug($institutes);
//            exit;

            $this->set(compact('institutes'));
        }
        $this->set(compact('funds', 'ins_array', 'ins_cls'));
    }

    public function count_amount($conn = null, $joins = null, $condition) {
        $count_total_amount = $conn->execute(
                'SELECT count(distinct(af.id)) as total_applicants,sum(af.amount_recived) as total_amount'
                . ' FROM applicant_funddetails as af '
                . 'inner join applicants as ap ON ap.id=af.applicant_id '
                . 'inner join funds ON af.fund_id=funds.id '
                . 'left join applicant_household_details as ahd ON ahd.applicant_id=ap.id '
                . 'join religions as r ON r.id=ap.religion_id '
                . 'left join applicantincomes as ai ON ai.applicant_id=ap.id '
                . 'left join applicantaddresses aad ON aad.applicant_id=ap.id '
                . 'left join cities as c ON c.id=aad.city_id '
                . $joins
                . 'join funds as f ON af.fund_id=f.id '
                . 'where ' . $condition);
        $results = $count_total_amount->fetchAll('assoc');
//        debug($results);exit();
        return $results;
    }

    public function reporting() {
        $this->loadModel('Funds');
        $this->loadModel('ApplicantFunddetails');
        $this->loadModel('Users');
        $this->viewBuilder()->layout('admin');
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);
        $fundslist = $this->Funds->find('list', ['keyField' => 'fund_for_year', 'valueField' => 'fund_for_year', 'order' => 'fund_for_year DESC'])->distinct(['fund_for_year'])->toArray();
        $users_have_access = $this->Users->find('list', ['keyField' => 'id', 'valueField' => 'name'])
                ->where(['role_id !=' => 3])->toArray();
        $conn = ConnectionManager::get('default');
        $this->set(compact('religions', 'cities', 'fundslist', 'users_have_access'));

        if ($this->request->is('post')) {
            extract($this->request->data);
            $fund_cat = $this->Funds->get($fundslist);
            $condition = $fields = $joins = '';

            if ($fund_cat->sub_category_id == 3) {
                $fields .= ',q.percentage,q.passing_date,q.recent_class,q.current_class,d.discipline,ql.name as qualification_name';
                $joins .= 'join qualifications as q ON q.applicant_id=ap.id join qualification_levels as ql ON ql.id=q.qualification_level_id join disciplines as d ON d.id=q.discipline_id ';
            }
            if (!empty($token)) {
                $condition .= 'af.id=' . $token;
                $povertybase = $conn->execute(
                        'SELECT count(*) as get_qualification '
                        . ' FROM applicant_funddetails as af '
                        . 'inner join applicants as ap ON ap.id=af.applicant_id '
                        . 'inner join qualifications as q ON q.applicant_id=ap.id '
                        . 'where af.id=' . $token);
                $results = $povertybase->fetchAll('assoc');
//                debug($results[0]['get_qualification']);
                if ($results[0]['get_qualification'] != 0) {
                    $fields .= ',q.percentage,q.passing_date,q.recent_class,q.current_class,d.discipline,ql.name as qualification_name';
                    $joins .= 'join qualifications as q ON q.applicant_id=ap.id join qualification_levels as ql ON ql.id=q.qualification_level_id join disciplines as d ON d.id=q.discipline_id ';
                }
//                exit;
            } else {
                if (!empty($fundslist)) {
                    $condition .= 'af.fund_id=' . $fundslist;
                }
                if (!empty($religion)) {
                    $condition .= ' AND ap.religion_id =' . $religion;
                }
                if (!empty($city)) {
                    $condition .= ' AND aad.city_id =' . $city;
                }
                if (!empty($cnic)) {
                    $condition .= ' AND ap.cnic LIKE "%' . $cnic . '%" OR ap.name LIKE "%' . $cnic . '%"';
                }
                if (!empty($gender)) {
                    $condition .= ' AND ap.gender ="' . $gender . '"';
                }
                if (!empty($sdate) && !empty($edate)) {
                    $condition .= " AND af.appling_date BETWEEN '" . $sdate . "' AND '" . $edate . "'";
                }
                if (!empty($status)) {
                    if ($status == 'selected') {
                        $condition .= ' AND af.selected=1 AND af.amount_recived IS NOT null';
                    }
                    if ($status == 'notselected') {
                        $condition .= ' AND af.selected=0 AND af.amount_recived IS null';
                    }
                    if ($status == 'distributed') {
                        $condition .= ' AND af.distributed !=0';
                    }
                }
                if (!empty(($user_id))) {
                    $condition .= ' AND (af.created_by ='.$user_id.' OR af.modified_by ='.$user_id.')';
                }
//                debug($condition);exit();
            }

            $this->set('count_amount', $this->count_amount($conn, $joins, $condition));
            $povertybase = $conn->execute(
                    'SELECT funds.sub_category_id as sub_cat, af.id as af_id,af.created_by,af.modified_by,af.amount_recived,af.check_number,af.payment_date,af.appling_date,ap.name as app_name,ap.father_name,ap.cnic,ap.gender,ap.disease,ap.dname,ap.dcontact,ap.clinic_address,ap.gname,ap.gfather_name,ap.gcnic,ap.gcontact,aad.permenent_address,aad.current_address,aad.postal_address,ahd.dependent_family_members,ai.monthly_income,c.name as city_name,r.religion_name' . $fields
                    . ' FROM applicant_funddetails as af '
                    . 'inner join applicants as ap ON ap.id=af.applicant_id '
                    . 'inner join funds ON af.fund_id=funds.id '
                    . 'left join applicant_household_details as ahd ON ahd.applicant_id=ap.id '
                    . 'join religions as r ON r.id=ap.religion_id '
                    . 'left join applicantincomes as ai ON ai.applicant_id=ap.id '
                    . 'left join applicantaddresses aad ON aad.applicant_id=ap.id '
                    . 'left join cities as c ON c.id=aad.city_id '
                    . $joins
                    . 'join funds as f ON af.fund_id=f.id '
                    . 'where ' . $condition . ' group by af.id');
            $results = $povertybase->fetchAll('assoc');
//            debug($this->request->data);
//            debug($results);
//            exit;
            $this->set(compact('selected_applicants', 'results', 'fund_amount'));
        }
    }

    public function balloting() {
        $this->loadModel('Funds');
        $this->loadModel('ApplicantFunddetails');
        $this->viewBuilder()->layout('admin');
        $funds = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['active' => '1']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);

        $this->set(compact('funds', 'religions', 'cities'));


        if ($this->request->is('post')) {
            if (isset($this->request->data['select_app'])) {
//                debug($this->request->data);
//                exit();
                $amount = $this->request->data['fund_amount'] / count($this->request->data['ApplicantFunddetails']['selected']);
//                 debug(floor($amount));
//                exit();
                $result = $this->ApplicantFunddetails->updateAll(['selected' => 1, 'amount_recived' => floor($amount)], ['id IN' => $this->request->data['ApplicantFunddetails']['selected']]);

                if ($result) {
                    $this->Flash->success('Applicants are selected successfully');
                }
            } else {


                extract($this->request->data);

                $condition = '';
                if (!empty($religion)) {
                    $condition .= ' AND ap.religion_id =' . $religion;
                }
                if (!empty($city)) {
                    $condition .= ' AND aad.city_id =' . $city;
                }

                $user_balance = $this->ApplicantFunddetails->find();
                $res = $user_balance->select(['sum' => $user_balance->func()->sum('ApplicantFunddetails.amount_recived')])
                        ->where(['fund_id' => $fund_id])
                        ->first();

                $distributed_amount = $res->sum;
                if ($res->sum == null) {
                    $distributed_amount = 0;
                }
                $this->set(compact('distributed_amount'));

                $selected_applicants = $this->ApplicantFunddetails->find('all')
                        ->where(['fund_id' => $fund_id, 'selected' => 1, 'amount_recived IS NOT' => null])
                        ->count();
                $fund_amount = $this->Funds->get($fund_id);

                $conn = ConnectionManager::get('default');

                $povertybase = $conn->execute(
                        'SELECT af.id as af_id,af.appling_date,ap.name as app_name,ap.father_name,ap.cnic,ap.gender,ahd.dependent_family_members,ai.monthly_income,c.name as city_name,r.religion_name'
                        . ' FROM applicant_funddetails as af '
                        . 'inner join applicants as ap ON ap.id=af.applicant_id '
                        . 'left join applicant_household_details as ahd ON ahd.applicant_id=ap.id '
                        . 'join religions as r ON r.id=ap.religion_id '
                        . 'left join applicantincomes as ai ON ai.applicant_id=ap.id '
                        . 'left join applicantaddresses aad ON aad.applicant_id=ap.id '
                        . 'left join cities as c ON c.id=aad.city_id '
                        . 'join funds as f ON af.fund_id=f.id '
                        . 'where f.total_amount > ' . $distributed_amount . ' AND af.amount_recived IS NULL AND af.selected=0 AND af.fund_id=' . $fund_id . $condition . ' ORDER BY RAND() LIMIT ' . $limit);
                $results = $povertybase->fetchAll('assoc');
//                debug($results);
//                exit;
                $this->set(compact('selected_applicants', 'results', 'fund_amount'));
            }
        }
    }

    public function distribution() {
        $this->loadModel('Funds');
        $this->viewBuilder()->layout('admin');
//        $applicants = $this->Applicants->find('all', [
//                    'contain' => ['Religions', 'Applicantaddresses', 'Applicantcontacts']
//                ])->toArray();
        $funds = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['active' => '1']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
        $this->set(compact('funds', 'religions', 'cities'));

        if ($this->request->is('post')) {
            if (isset($this->request->data['select_app'])) {
                $this->loadModel('ApplicantFunddetails');
                $amount = $this->request->data['amount_recived'];
                $result = $this->ApplicantFunddetails->updateAll(['selected' => 1, 'amount_recived' => $amount], ['id IN' => $this->request->data['ApplicantFunddetails']['id']]);
                if ($result) {
                    $this->Flash->success('Applicants are selected successfully');
                }
            } else {
                $this->loadModel('ApplicantFunddetails');
                extract($this->request->data);
                $conn = ConnectionManager::get('default');
//                $family_condition = $salary_c = $religion_c = $city_c = $limit_c = $percentage_c = '';
                $condition = $joins = $fields = '';
                $limit_c = '';
                if (!empty($family_members)) {
                    $fields .= ',ahd.dependent_family_members';
                    $joins .= 'join applicant_household_details as ahd ON ahd.applicant_id=ap.id ';
                    $condition .= ' AND ahd.dependent_family_members ' . $member_operator . $family_members;
                    $limit_c .= ' ORDER BY ahd.dependent_family_members DESC';
                }
                if (!empty($salary)) {
                    $fields .= ',ai.monthly_income';
                    $joins .= 'join applicantincomes as ai ON ai.applicant_id=ap.id ';
                    $condition .= ' AND ai.monthly_income ' . $salary_operator . ' ' . $salary;

                    if (!empty($family_members)) {
                        $limit_c .= ', ai.monthly_income ASC';
                    } else {
                        $limit_c .= ' ORDER BY ai.monthly_income ASC';
                    }
                }
                if (!empty($religion)) {
                    $condition .= ' AND ap.religion_id =' . $religion;
                }
                if (!empty($city)) {
                    $condition .= ' AND aad.city_id =' . $city;
                }
                if (!empty($limit)) {
                    $limit_c .= ' limit ' . $limit;
                }
//                debug($limit_c);exit();
                if (!empty($percentage)) {
                    $fields .= ',q.percentage,q.passing_date,q.recent_class,q.current_class,d.discipline,ql.name as qualification_name';
                    $joins .= 'join qualifications as q ON q.applicant_id=ap.id join qualification_levels as ql ON ql.id=q.qualification_level_id join disciplines as d ON d.id=q.discipline_id ';
                    $limit_c = ' ORDER BY q.percentage DESC';
                    if (!empty($limit)) {
                        $limit_c .= ' limit ' . $limit;
                    }
                    $condition .= ' AND q.percentage >=' . $percentage;
                }
//                debug($fields);
//                debug($joins);
//                debug($limit_c);
//                debug($condition);
//                exit();
                $user_balance = $this->ApplicantFunddetails->find();
                $res = $user_balance->select(['sum' => $user_balance->func()->sum('ApplicantFunddetails.amount_recived')])
                        ->where(['fund_id' => $fund_id])
                        ->first();

                $distributed_amount = $res->sum;
                if ($res->sum == null) {
                    $distributed_amount = 0;
                }
                $this->set(compact('distributed_amount'));

                $selected_applicants = $this->ApplicantFunddetails->find('all')
                        ->where(['fund_id' => $fund_id, 'selected' => 1, 'amount_recived IS NOT' => null])
                        ->count();

                $fund_amount = $this->Funds->get($fund_id);
                $povertybase = $conn->execute('SELECT af.id as af_id,af.amount_recived,af.applicant_id,af.appling_date,ap.name as app_name,ap.father_name,ap.cnic,ap.gender' . $fields . ',c.name as city_name,r.religion_name,f.total_amount'
                        . ' FROM applicant_funddetails as af '
                        . 'inner join applicants as ap ON ap.id=af.applicant_id '
                        . $joins
                        . 'join religions as r ON r.id=ap.religion_id '
                        . 'left join applicantaddresses aad ON aad.applicant_id=ap.id '
                        . 'left join cities as c ON c.id=aad.city_id '
                        . 'join funds as f ON af.fund_id=f.id '
                        . 'where f.total_amount > ' . $distributed_amount . ' AND af.amount_recived IS NULL AND af.selected=0 AND af.fund_id=' . $fund_id . $condition . $limit_c);
                $results = $povertybase->fetchAll('assoc');

//                debug($results);
//                exit();
                $this->set(compact('selected_applicants', 'results', 'fund_amount'));
            }
        }
    }

    public function distribution11nov() {
        $this->loadModel('Funds');
        $this->viewBuilder()->layout('admin');
//        $applicants = $this->Applicants->find('all', [
//                    'contain' => ['Religions', 'Applicantaddresses', 'Applicantcontacts']
//                ])->toArray();
        $funds = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['active' => '1']);
        $religions = $this->Applicants->Religions->find('list', ['keyField' => 'id', 'valueField' => 'religion_name']);
        $cities = $this->Applicants->Applicantaddresses->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name', 'order' => 'name']);
        $this->set(compact('funds', 'religions', 'cities'));


        if ($this->request->is('post')) {

            if (isset($this->request->data['select_app'])) {
                $this->loadModel('ApplicantFunddetails');
                $amount = $this->request->data['fund_amount'] / count($this->request->data['ApplicantFunddetails']['id']);
                debug($amount);
                exit();
                $result = $this->ApplicantFunddetails->updateAll(['selected' => 1, 'amount_recived' => $amount], ['id IN' => $this->request->data['ApplicantFunddetails']['id']]);
                if ($result) {
                    $this->Flash->success('Applicants are selected successfully');
                }
            } else {
//                debug($this->request->data);
//                exit();
                $this->loadModel('ApplicantFunddetails');
                extract($this->request->data);
                $conn = ConnectionManager::get('default');
//                $family_condition = $salary_c = $religion_c = $city_c = $limit_c = $percentage_c = '';
                $condition = $joins = $fields = '';
                $limit_c = '';
                if (!empty($family_members)) {
                    $fields .= ',ahd.dependent_family_members';
                    $joins .= 'join applicant_household_details as ahd ON ahd.applicant_id=ap.id ';
                    $condition .= ' AND ahd.dependent_family_members ' . $member_operator . $family_members;
                    $limit_c .= ' ORDER BY ahd.dependent_family_members DESC';
                }
                if (!empty($salary)) {
                    $fields .= ',ai.monthly_income';
                    $joins .= 'join applicantincomes as ai ON ai.applicant_id=ap.id ';
                    $condition .= ' AND ai.monthly_income ' . $salary_operator . ' ' . $salary;

                    if (!empty($family_members)) {
                        $limit_c .= ', ai.monthly_income ASC';
                    } else {
                        $limit_c .= ' ORDER BY ai.monthly_income ASC';
                    }
                }
                if (!empty($religion)) {
                    $condition .= ' AND ap.religion_id =' . $religion;
                }
                if (!empty($city)) {
                    $condition .= ' AND aad.city_id =' . $city;
                }
                if (!empty($limit)) {
                    $limit_c .= ' limit ' . $limit;
                }
//                debug($limit_c);exit();
                if (!empty($percentage)) {
                    $fields .= ',q.percentage,q.passing_date,q.recent_class,q.current_class,d.discipline,ql.name as qualification_name';
                    $joins .= 'join qualifications as q ON q.applicant_id=ap.id join qualification_levels as ql ON ql.id=q.qualification_level_id join disciplines as d ON d.id=q.discipline_id ';
                    $limit_c = ' ORDER BY q.percentage DESC';
                    if (!empty($limit)) {
                        $limit_c .= ' limit ' . $limit;
                    }
                    $condition .= ' AND q.percentage >=' . $percentage;
                }
//                debug($fields);
//                debug($joins);
//                debug($limit_c);
//                debug($condition);
//                exit();
                $user_balance = $this->ApplicantFunddetails->find();
                $res = $user_balance->select(['sum' => $user_balance->func()->sum('ApplicantFunddetails.amount_recived')])
                        ->where(['fund_id' => $fund_id])
                        ->first();

                $distributed_amount = $res->sum;
                if ($res->sum == null) {
                    $distributed_amount = 0;
                }
                $this->set(compact('distributed_amount'));

                $selected_applicants = $this->ApplicantFunddetails->find('all')
                        ->where(['fund_id' => $fund_id, 'selected' => 1, 'amount_recived IS NOT' => null])
                        ->count();

                $fund_amount = $this->Funds->get($fund_id);
                $povertybase = $conn->execute('SELECT af.id as af_id,af.amount_recived,af.applicant_id,af.appling_date,ap.name as app_name,ap.father_name,ap.cnic,ap.gender' . $fields . ',c.name as city_name,r.religion_name,f.total_amount'
                        . ' FROM applicant_funddetails as af '
                        . 'inner join applicants as ap ON ap.id=af.applicant_id '
                        . $joins
                        . 'join religions as r ON r.id=ap.religion_id '
                        . 'join applicantaddresses aad ON aad.applicant_id=ap.id '
                        . 'join cities as c ON c.id=aad.city_id '
                        . 'join funds as f ON af.fund_id=f.id '
                        . 'where f.total_amount > ' . $distributed_amount . ' AND af.amount_recived IS NULL AND af.selected=0 AND af.fund_id=' . $fund_id . $condition . $limit_c);
                $results = $povertybase->fetchAll('assoc');

//                debug($results);
//                exit();
                $this->set(compact('selected_applicants', 'results', 'fund_amount'));
            }
        }
    }

    public function services() {
        if (isset($_GET['deselect'])) {

            $this->loadModel('ApplicantFunddetails');
            $applicantfunddetails = $this->ApplicantFunddetails->get($_GET['id']);
            $applicantfunddetails->selected = 0;
            $applicantfunddetails->amount_recived = null;
            if ($this->ApplicantFunddetails->save($applicantfunddetails)) {
                $success = $applicantfunddetails->id;
            } else {
                $success = 0;
            }
            echo json_encode($success);
            exit();
        }
        if (isset($_GET['cheque_no'])) {
//            echo $_GET['id'];
            $this->loadModel('ApplicantFunddetails');
            $applicantfunddetails = $this->ApplicantFunddetails->get($_GET['id']);
//            $applicantfunddetails->check_number = $_GET['cheque_no'];
            $applicantfunddetails->distributed = $_GET['cheque_no'];
            $applicantfunddetails->payment_date = date('Y-m-d');

            if ($this->ApplicantFunddetails->save($applicantfunddetails)) {
                $success = date('M-d-Y', strtotime($applicantfunddetails->payment_date));
            } else {
                $success = 0;
            }
            echo json_encode($success);
            exit();
        }


        if (isset($_GET['fund_subcategory'])) {
            $this->loadModel('Funds');
            $funds = $this->Funds->find('all')
                    ->contain('SubCategories')
                    ->where(['Funds.id' => $_GET['fund_subcategory']])
                    ->first();

            echo json_encode($funds->sub_category->id);
            exit;
        }
    }

    public function dashboard() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Cities');
        $this->loadModel('Funds');
        $conn = ConnectionManager::get('default');

        $query = $conn->execute('SELECT COUNT(religion_id),COUNT(det.applicant_id) As ap,fund_name,religion_id,religion_name'
                . ' FROM applicants  as app '
                . 'inner join applicant_funddetails as det  ON app.id=det.applicant_id '
                . 'inner join funds as ap ON ap.id=det.fund_id '
                . 'inner join religions as re ON re.id=app.religion_id '
                . 'where active=' . 1 . ' GROUP BY fund_name ORDER BY ap DESC');
        $funds = $query->fetchAll('assoc');

        $query2 = $conn->execute('SELECT latitude,longitude,cities.name as city'
                . ' FROM applicants  as app '
                . 'inner join applicant_funddetails as det  ON app.id=det.applicant_id '
                . 'inner join funds as ap ON ap.id=det.fund_id '
                . 'inner join religions as re ON re.id=app.religion_id '
                . 'inner join applicantaddresses as address ON address.applicant_id=app.id '
                . 'inner join cities  ON cities.id=address.city_id '
                . 'where active=' . 1 . ' group by city');
        $ceety = $query2->fetchAll('assoc');
        $query3 = $conn->execute('SELECT * from religions ');
        $religion = $query3->fetchAll('assoc');

        $query_fund = $conn->execute('SELECT ap.fund_name,count(app.id) as fundcount'
                . ' FROM applicants  as app '
                . 'inner join applicant_funddetails as det  ON app.id=det.applicant_id '
                . 'inner join funds as ap ON ap.id=det.fund_id '
                . 'inner join religions as re ON re.id=app.religion_id '
                . 'inner join applicantaddresses as address ON address.applicant_id=app.id '
                . 'inner join cities  ON cities.id=address.city_id group by fund_name');
        $query_funds = $query_fund->fetchAll('assoc');
        $query_fund1 = $conn->execute('SELECT ap.fund_for_year'
                . ' FROM applicants  as app '
                . 'inner join applicant_funddetails as det  ON app.id=det.applicant_id '
                . 'inner join funds as ap ON ap.id=det.fund_id '
                . 'inner join religions as re ON re.id=app.religion_id '
                . 'inner join applicantaddresses as address ON address.applicant_id=app.id '
                . 'inner join cities  ON cities.id=address.city_id group by fund_for_year');

        $query_fund1s = $query_fund1->fetchAll('assoc');
        $totalfund = $conn->execute('SELECT count(app.id) as count'
                . ' FROM applicants  as app '
                . 'inner join applicant_funddetails as det  ON app.id=det.applicant_id '
                . 'inner join funds as ap ON ap.id=det.fund_id '
                . 'inner join religions as re ON re.id=app.religion_id '
                . 'inner join applicantaddresses as address ON address.applicant_id=app.id '
                . 'inner join cities  ON cities.id=address.city_id group by fund_for_year');
        $total_funds = $totalfund->fetchAll('assoc');

        $city = $this->Cities->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();

        $fundslist = $this->Funds->find('list', ['keyField' => 'fund_for_year', 'valueField' => 'fund_for_year'])->distinct(['fund_for_year'])->toArray();

        //ebug($funds);exit;
        $this->set(compact('city', 'funds', 'fundslist', 'ceety', 'conn', 'religion', 'query_funds', 'query_fund1s', 'total_funds'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->layout('admin');

        $applicant = $this->Applicants->get($id, [
            'contain' => ['ApplicantHouseholdDetails', 'Applicantaddresses', 'Applicantcontacts', 'Applicantincomes', 'Applicantprofessions', 'Religions', 'ApplicantFunddetails']
        ]);
//        debug($applicant);exit();
        $fund = $applicant['applicant_funddetails'][0]['fund_id']; //debug($fund);exit;
        $cityid = $applicant['applicantaddresses'][0]['city_id'];
        $this->loadModel('Funds');
        $fund = $this->Funds->find()->where(['id' => $fund])->first()->toArray();
        //debug($funds);exit;
        $this->loadModel('Applicantaddresses');

        $city = $this->Applicantaddresses->Cities->find()->where(['id' => $cityid])->first()->toArray();
        $this->loadModel('Qualifications');
        $qualification = [
            'contain' => ['QualificationLevels', 'Disciplines', 'Institutes', 'DegreeAwardings']
        ];
        $qualifications = $this->Qualifications->find('all', $qualification)->where(['applicant_id' => $id])->toArray();
        $this->set(compact('qualifications', 'applicant', 'city', 'fund'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    private function image_validation($image_details = null) {
        $extentions = array('jpg', 'JPG', 'PNG', 'png', 'jpeg', 'JPEG', 'gif', 'GIF', 'svg', 'SVG');
        $continue = 1;
        $error = '';

        foreach ($image_details as $single_img):

            $img_ext = pathinfo($single_img['name'], PATHINFO_EXTENSION);
            if (!in_array($img_ext, $extentions)) {
                $error = 'only image can be uploaded';
                $continue = 0;
                return $error;
            }
            if ($single_img['size'] > 1000000) {
                $error = 'Image size is too big';
                $continue = 0;
                return $error;
            }
        endforeach;
        if ($continue == 1) {
            return $continue;
        }
//        exit();
    }

    public function subcategory($id = null) {
        $this->viewBuilder()->layout('');
        $id = $_GET['value'];
        $this->loadModel('Funds');
        $funds = $this->Funds->find('all', [
                    'contain' => ['FundCategories', 'SubCategories']
                ])->where(['funds.id' => $id])->toArray();

        echo json_encode($funds);
        exit;
        $this->set('sub', $funds);
    }

    public function fundlist($id = null) {
        $this->viewBuilder()->layout('');
        $this->loadModel('Funds');
        if (isset($_GET['fund_id'])) {
            $conn = ConnectionManager::get('default');
            $povertybase = $conn->execute(
                    'SELECT DISTINCT i.id,i.name as institute_name'
                    . ' FROM institutes as i '
                    . 'inner join instituteclasses ON instituteclasses.institute_id=i.id '
                    . 'inner join applicants as a ON a.instituteclass_id=instituteclasses.id '
                    . 'inner join institute_funddetails as ifd ON ifd.applicant_id=a.id '
                    . 'where ifd.fund_id  = ' . $_GET['fund_id']);
            $institutes = $povertybase->fetchAll('assoc');
            echo json_encode($institutes);
            exit;
        }
        if (isset($_GET['fundofinstitute'])) {
//            debug($_GET['fundofinstitute']);
//            exit();
            $funds = $this->Funds->find('all', [
                        'contain' => ['FundCategories', 'SubCategories']
                    ])->where(['Funds.fund_for_year' => $_GET['fundofinstitute'], 'SubCategories.id' => 3])->toArray();
            echo json_encode($funds);
            exit;
        }
        if (isset($_GET['value'])) {
            $id = $_GET['value'];
            $funds = $this->Funds->find('all', [
                        'contain' => ['FundCategories', 'SubCategories']
                    ])->where(['fund_for_year' => $id])->toArray();

            echo json_encode($funds);
            exit;
        }
    }

    public function add() {
        $this->viewBuilder()->layout('admin');
        $applicant = $this->Applicants->newEntity();

        if ($this->request->is('post')) {

            //debug($this->request->data['ApplicantAttachments']['attachments']);
            //exit;
            //debug($this->request->data);exit;

            if ($this->request->data['ApplicantAttachments']['attachments'][0]['name'] <> '') {
                $valid_image = $this->image_validation($this->request->data['ApplicantAttachments']['attachments']);
                if ($valid_image == 1) {
                    foreach ($this->request->data as $key => $save_records):
                        if ($key == 'Applicants') {
                            $applicant = $this->$key->patchEntity($applicant, $save_records);
                            $this->$key->save($applicant);
                            $applicant_id = $applicant->id;
                        } else {
                            if ($key == 'ApplicantAttachments') {
                                $this->loadModel($key);
                                $save_attachment = array();
                                foreach ($save_records['attachments'] as $subkey => $u_img):
//                                    debug($key);
                                    $get_ext = pathinfo($u_img['name'], PATHINFO_EXTENSION);

                                    $new_name = $subkey . '-' . date('ymdhis') . '.' . $get_ext;
                                    $path = WWW_ROOT . 'img' . DS . 'applicant_documents' . DS . $new_name;

                                    move_uploaded_file($u_img['tmp_name'], $path);

                                    $save_attachment[$subkey]['applicant_id'] = $applicant_id;
                                    $save_attachment[$subkey]['attachments'] = $new_name;
                                endforeach;
                                $attachments_details = $this->$key->newEntities($save_attachment);
                                $result = $this->$key->saveMany($attachments_details);
                                if ($result) {
                                    $this->Flash->success(__('The applicant has been saved.'));
                                    return $this->redirect(['action' => 'index']);
                                }
                            } else {
                                $this->loadModel($key);
                                $child_table = $this->$key->newEntity();

                                $save_records['applicant_id'] = $applicant_id;
                                $child_table = $this->$key->patchEntity($child_table, $save_records);
                                //debug($child_table);
                                // exit;
                                $this->$key->save($child_table);
                            }
                        }
                    endforeach;
                } else {
//                    echo $valid_image;
                    $this->Flash->error(__($valid_image));
                }
            }


//            exit();
//            if ($this->Applicants->save($applicant)) {
//                $this->Flash->success(__('The applicant has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The applicant could not be saved. Please, try again.'));

            $this->Flash->success(__('The applicant has been saved.'));

            //return $this->redirect(['action' => 'index']);
        }
        $religions = $this->Applicants->Religions->find('list');
        $religions = $this->Applicants->Religions->find('list');
        $maritalstatus = $this->Applicants->Maritalstatus->find('list');
        $this->loadModel('Applicantaddresses');
        $city = $this->Applicantaddresses->Cities->find('list');
        $this->loadModel('FundCategories');
        $fundcategory = $this->FundCategories->find('list', ['keyField' => 'id', 'valueField' => 'type_of_fund']);
        //debug( $fundcategory->toArray());
        $this->loadModel('SubCategories');
        $subfundcategory = $this->SubCategories->find('list', ['keyField' => 'id', 'valueField' => 'type_of_fund']);
        // $this->loadModel('SubCategories');
        //$Funds = $this->SubCategories->find('list',['keyField'=>'id','valueField'=>'type_of_fund']);
        //exit();
        $this->loadModel('ApplicantFunddetails');
        $funds = $this->ApplicantFunddetails->Funds->find('list')
                        ->where(['active' => 1])->toArray();
        //debug($funds);exit;
        $this->loadModel('QualificationLevels');
        $this->loadModel('Disciplines');
        $this->loadModel('Institutes');
        $this->loadModel('DegreeAwardings');
        $qualificationLevels = $this->QualificationLevels->find('list', ['limit' => 200]);
        $disciplines = $this->Disciplines->find('list', ['keyField' => 'id', 'valueField' => 'discipline']);
        //debug($disciplines);exit;
        $institutes = $this->Institutes->find('list', ['limit' => 200]);
        $degreeAwardings = $this->DegreeAwardings->find('list', ['limit' => 200]);

        $this->set(compact('applicant', 'religions', 'maritalstatus', 'city', 'fundcategory', 'subfundcategory', 'qualification', 'qualificationLevels', 'disciplines', 'institutes', 'degreeAwardings', 'funds'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Disciplines');
        $this->loadModel('Qualifications');
        $this->loadModel('Institutes');

        $applicant = $this->Applicants->get($id, [
            'contain' => ['ApplicantFunddetails', 'ApplicantHouseholdDetails', 'Applicantaddresses', 'Applicantcontacts', 'Applicantincomes', 'Applicantprofessions', 'Qualifications', 'Qualifications.Disciplines', 'Qualifications.Institutes']
        ]);
        $conn = ConnectionManager::get('default');
        $fund_details = $conn->execute('Select sub_category_id as sub_cat FROM funds WHERE funds.id=' . $applicant->applicant_funddetails[0]->fund_id);
        $fund_details_results = $fund_details->fetchAll('assoc');
        if ($this->request->is(['patch', 'post', 'put'])) {
//            debug($this->request->data);
//            exit();
            // qualification Edit

            if (isset($this->request->data['Qualifications'])) {
//                debug($applicant->qualifications[0]);
//                debug($this->request->data['Qualifications']);
//                exit();
                $index = 'Qualifications';
                $save = $this->request->data[$index];
                if (empty($save['institute_id']) && empty($this->request->data['Institutes']['name'])) {
                    $this->Flash->error('Invalid institute details');
                }
                if (!empty($this->request->data[$index]['total_marks']) && !empty($this->request->data[$index]['obtained_marks'])) {
                    if ($this->request->data[$index]['obtained_marks'] > $this->request->data[$index]['total_marks']) {
                        $this->Flash->error(__("Invalid Obatined Marks"));
                    }
                    $this->request->data[$index]['percentage'] = round(($this->request->data[$index]['obtained_marks'] * 100) / $this->request->data[$index]['total_marks'], 2);
                }
                if (!empty($this->request->data[$index]['total_cgpa']) && !empty($this->request->data[$index]['obtained_cgpa'])) {
                    if ($this->request->data[$index]['obtained_cgpa'] > $this->request->data[$index]['total_cgpa']) {
                        $this->Flash->error(__("Invalid Obatined CGPA"));
                    }
                }
                if (empty($save['discipline_id']) && empty($this->request->data['Disciplines']['discipline'])) {
                    $this->Flash->error('please provide Discipline Details');
                }

                if (empty($this->request->data[$index]['institute_id'])) {
                    if ($applicant->qualifications[0]->institute->institute_type_id == 2) {
                        $institute = $this->Institutes->newEntity();
                    } else {
                        $institute = $applicant->qualifications[0]->institute;
                    }
//                    debug($institute);
//                    exit;
                    $institute = $this->Institutes->patchEntity($institute, $this->request->data['Institutes']);
                    $this->Institutes->save($institute);
                    $this->request->data['Qualifications']['institute_id'] = $institute->id;
                } else {
                    if ($applicant->qualifications[0]->institute->institute_type_id != 2) {
                        $this->Institutes->delete($applicant->qualifications[0]->institute);
                    }
                }

                if (empty($this->request->data[$index]['discipline_id'])) {
                    if ($applicant->qualifications[0]->discipline->qualification_level_id < 3) {
                        $discipline = $this->Disciplines->newEntity();
                    } else {
                        $discipline = $applicant->qualifications[0]->discipline;
                    }
                    $discipline->qualification_level_id = $this->request->data[$index]['qualification_level_id'];
                    $discipline = $this->Disciplines->patchEntity($discipline, $this->request->data['Disciplines']);
                    $this->Disciplines->save($discipline);
                    $this->request->data['Qualifications']['discipline_id'] = $discipline->id;
                } else {
                    if ($applicant->qualifications[0]->discipline->qualification_level_id > 2) {
                        $this->Disciplines->delete($applicant->qualifications[0]->discipline);
                    }
                }
                $this->request->data[$index]['passing_date'] = date('Y-m-d', strtotime($this->request->data[$index]['passing_date']));
//                debug($this->request->data[$index]['passing_date']);
//                exit();
                $qualification = $this->$index->patchEntity($applicant->qualifications[0], $this->request->data[$index]);

                if ($this->$index->save($qualification)) {
                    unset($this->request->data['Qualifications']);
                    unset($this->request->data['Institutes']);
                    unset($this->request->data['Disciplines']);
                }
            }
            // end qualification edit

            foreach ($this->request->data as $key => $save_records):
                if ($key == 'Applicants') {
                    $applicant = $this->$key->patchEntity($applicant, $save_records);
                    $this->$key->save($applicant);
                    $applicant_id = $applicant->id;
                } else {
                    $key_lowerecase = strtolower($key);
                    if ($key == 'ApplicantHouseholdDetails') {
                        $key_lowerecase = 'applicant_household_details';
                    }
                    $this->loadModel($key);
                    $recordtoedit = $applicant->$key_lowerecase;
                    if (empty($recordtoedit[0])) {
                        $child_table = $this->$key->newEntity();
                    } else {
                        $child_table = $recordtoedit[0];
                    }
                    $save_records['applicant_id'] = $applicant_id;
                    $child_table = $this->$key->patchEntity($child_table, $save_records);
                    $this->$key->save($child_table);
                }
            endforeach;
            $this->loadModel('ApplicantFunddetails');
            $applicant->applicant_funddetails[0]['modified_by'] = $this->Auth->user('id');
            $this->ApplicantFunddetails->save($applicant->applicant_funddetails[0]);

            $this->Flash->success(__('The applicant has been Updated.'));
            return $this->redirect(['action' => 'edit', $id]);
        }
        $religions = $this->Applicants->Religions->find('list');
        $maritalstatus = $this->Applicants->Maritalstatus->find('list');
        $this->loadModel('Applicantaddresses');
        $city = $this->Applicantaddresses->Cities->find('list');
        $this->loadModel('Applicantaddresses');
        $cityid = $applicant['applicantaddresses'][0]['city_id'];
        $city1 = $this->Applicantaddresses->Cities->find()->where(['id' => $cityid])->first()->toArray();
        $this->loadModel('Funds');
        $qualification = [
            'contain' => ['QualificationLevels', 'Disciplines', 'Institutes', 'DegreeAwardings']
        ];
        if ($fund_details_results[0]['sub_cat'] == 3) {
            $this->loadModel('QualificationLevels');
            $this->loadModel('DegreeAwardings');
            $qualifications = $this->Qualifications->find('all', $qualification)->where(['applicant_id' => $id])->toArray();
            $qualificationLevels = $this->QualificationLevels->find('list', ['limit' => 200])->toArray();
            $disciplines = $this->Disciplines->find('list', ['conditions' => ['qualification_level_id' => $applicant->qualifications[0]->qualification_level_id], 'keyField' => 'id', 'valueField' => 'discipline']);
            $institutes = $this->Qualifications->Institutes->find('list', ['conditions' => ['type' => 'university']])->toArray();
            $degreeAwardings = $this->DegreeAwardings->find('list', ['limit' => 200]);
            $this->set(compact('qualifications', 'qualificationLevels', 'disciplines', 'institutes', 'degreeAwardings'));
        }
        $this->set(compact('city1', 'fund_details_results', 'applicant', 'religions', 'maritalstatus', 'city'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $applicant = $this->Applicants->get($id, [
            'contain' => ['ApplicantFunddetails', 'ApplicantAttachments', 'ApplicantHouseholdDetails', 'Applicantaddresses', 'Applicantcontacts', 'Applicantincomes', 'Applicantprofessions', 'Religions', 'Maritalstatus', 'Qualifications']
        ]);
        //debug($applicant);exit;
        //debug($this->Applicantprofessions->Applicants->delete($applicant));exit;
        if ($this->Applicants->delete($applicant)) {
            $this->Flash->success(__('The applicant has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Spreadsheet_Excel_Reader;


/**
 * Applicantincomes Controller
 *
 * @property \App\Model\Table\ApplicantincomesTable $Applicantincomes
 *
 * @method \App\Model\Entity\Applicantincome[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
 
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    //public $helpers = ['Cewi/Excel.Excel'];
    public function index()
    {
require_once(ROOT . DS .  'vendor' . DS  . 'Excel' . DS . 'src' . DS . 'reader.php');

 $data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');


$data->read( ROOT . DS .'webroot'.DS. 'img' . DS . 'ProfesionalCourses.xls');
echo '<table>';

for ($x = 3; $x <= count($data->sheets[0]["cells"]); $x++) {

    

echo '<tr><td>';
   
    //print_r(trim(end($break)));
    if (isset($data->sheets[0]["cells"][$x][3])){
    echo $data->sheets[0]["cells"][$x][3];}
    else{
        echo '';
    }
    
   
echo '</td>';
echo '<td>';
   
    //print_r(trim(end($break)));
    if (isset($data->sheets[0]["cells"][$x][4])){
    echo $data->sheets[0]["cells"][$x][4];}
    else{
        echo '';
    }
    
   
echo '<td>';
   
    //print_r(trim(end($break)));
    if (isset($data->sheets[0]["cells"][$x][5])){
    echo $data->sheets[0]["cells"][$x][5];}
    else{
        echo '';
    }
    
   
echo '</td>';
echo '<td>';
   
    //print_r(trim(end($break)));
    if (isset($data->sheets[0]["cells"][$x][6])){
    echo $data->sheets[0]["cells"][$x][6];}
    else{
        echo '';
    }
    
   
echo '</td>';
echo '<td>';
   
    //print_r(trim(end($break)));
    if (isset($data->sheets[0]["cells"][$x][7])){
    echo $data->sheets[0]["cells"][$x][7];}
    else{
        echo '';
    }
    
   
echo '</td>';
echo '<td>';
   
    //print_r(trim(end($break)));
    if (isset($data->sheets[0]["cells"][$x][8])){
    echo $data->sheets[0]["cells"][$x][8];}
    else{
        echo '';
    }
    
   
echo '</td>';
echo '<td>';
   
    //print_r(trim(end($break)));
    if (isset($data->sheets[0]["cells"][$x][9])){
    echo $data->sheets[0]["cells"][$x][9];}
    else{
        echo '';
    }
    
   
echo '</td>';
echo '<td>';
   
    //print_r(trim(end($break)));
    if (isset($data->sheets[0]["cells"][$x][10])){
    echo $data->sheets[0]["cells"][$x][10];}
    else{
        echo '';
    }
    
   
echo '</td>';

echo '<td>';
   
    //print_r(trim(end($break)));
    if (isset($data->sheets[0]["cells"][$x][11])){
    echo $data->sheets[0]["cells"][$x][11];}
    else{
        echo '';
    }
    
   
echo '</td>';

echo '<td>';
   
    //print_r(trim(end($break)));
    if (isset($data->sheets[0]["cells"][$x][12])){
    echo $data->sheets[0]["cells"][$x][12];}
    else{
        echo '';
    }
    
   
echo '</td>';
    echo '</tr>';
    }
    
    
    
    }
    
}

<?php

use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

$conn = ConnectionManager::get('default');
$tableRegObj = TableRegistry::get('Applicants');
?>

<section class="content">
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Institute: &nbsp;<?php echo ucwords($ins->name) ?>.
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href='<?= $this->request->webroot . 'admin/Institutes/add'; ?>'>Add Institutes</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                           <!--<th>S.No</th>-->
                                        <th>Class</th>
                                        <th>Total No. of Students</th>
                                        <th>Total No. of Minority Students</th>
                                        <th>No. of Needy & Deserving Minority Students(up to 30 % only)</th>
                                        <th>Cost of textbooks including notebooks <strong>(per set)</strong></th>
                                        <th>Cost of uniform for Boys (per set)</th>
                                        <th>Cost of uniform for Girls (per set)</th>
                                        <th>Amount for boys</th>
                                        <th>Amount for girl</th>
                                        <!--<th>Total amount for a class</th>-->
                                        <th></th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ($instituteclasses as $key => $instituteclass):
                                        ?>
                                        <tr id="class_row<?php echo$key ?>">
                                            <td>
                                                <?php echo $instituteclass['class_number']; ?>
                                            </td>
                                            <td>
                                                <?php echo $instituteclass['total_students']; ?>
                                            </td>
                                            <td>
                                                <?php echo $instituteclass['minority_students']; ?>
                                            </td>
                                            <td>
                                                <?php echo $instituteclass['needy_students']; ?>
                                            </td>
                                            <td>
                                                <?php echo $instituteclass['textbook_cost']; ?>
                                            </td>
                                            <td><?php
                                                echo $instituteclass['boys_uniform'];
                                                ?>
                                            </td>
                                            <td><?php
                                                echo $instituteclass['girls_uniform'];
                                                ?>
                                            </td>
                                            <td><?php
                                                echo $instituteclass['textbook_cost'] + $instituteclass['boys_uniform'];
                                                ?>
                                            </td>
                                            <td><?php
                                                echo $instituteclass['textbook_cost'] + $instituteclass['girls_uniform'];
                                                ?>
                                            </td>


                                            <td style='width: 160px;'>
                                                <!--< $this->Form->postLink(__('Delete'), ['action' => 'delete', $institute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $institute->id)]) ?>-->
                                                <a href="<?php echo $this->request->webroot . 'admin/instituteclasses/viewapplicants/' . $instituteclass['id'].'/'.$this->request->params['pass'][1]; ?>" class="btn btn-primary btn-sm"><?php
//                                                    $getAllResults = $tableRegObj->find('all')
//                                                            ->where(['instituteclass_id' => $instituteclass->id])
//                                                            ->count();
                                                
                                                    $count_inserted_students = $conn->execute('SELECT COUNT(*) as total FROM `institute_funddetails` as ifd JOIN applicants as a ON ifd.applicant_id = a.id JOIN instituteclasses as i ON a.instituteclass_id= i.id WHERE i.id=' . $instituteclass['id'] . ' AND ifd.fund_id=' . $this->request->params['pass'][1]);
                                                    $results = $count_inserted_students->fetchAll('assoc');
                                                    ?>
                                                    <span class="badge">
                                                        <?php
                                                        echo $results[0]['total'];
                                                        ?>
                                                    </span>
                                                    &nbsp;Students
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>




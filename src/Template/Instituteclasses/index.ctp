<?php

use Cake\ORM\TableRegistry;

$tableRegObj = TableRegistry::get('Applicants');
?>

<div id="content">
    <div class="container">

        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?= $this->request->webroot; ?>Institutes/add">Profile</a>
                </li>
                <li class="current">
                    <a href="#" title="">List of classes</a>
                </li>
            </ul>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="widget-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $this->Flash->render() ?>
                                    </div>
                                    <br/>
                                    <h4 style="font-weight: bold;">List Of Minority Students(Class Wise) Please give details of the students, class wise, up-to Class 10th</h4>
                                    <hr/>
                                    <a href="<?= $this->request->webroot . 'Instituteclasses/addclass/' . $this->request->params['pass'][0]; ?>" class="btn btn-success btn-sm pull-right" style="margin-right:15px;">Add Class</a>
                                    <br/><br/>

                                    <table id="student_table" class="table table-responsive table-striped table-bordered">
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
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($instituteclasses as $key => $instituteclass):
                                                ?>
                                                <tr id="class_row<?php echo$key ?>">
                                                    <td>
                                                        <?php echo $instituteclass->school_class->class_number; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass->total_students; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass->minority_students; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass->needy_students; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass->textbook_cost; ?>
                                                    </td>
                                                    <td><?php
                                                        echo $instituteclass->boys_uniform;
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        echo $instituteclass->girls_uniform;
                                                        ?>
                                                    </td>

                                                    <td style='width: 160px;'>
                                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $instituteclass->id, $this->request->params['pass'][0]], ['class' => 'btn btn-primary btn-sm']) ?>
                                                        <a href="<?= $this->request->webroot . 'Applicants/addapplicant/' . $instituteclass->id . '/' . $this->request->params['pass'][0]; ?>" class="btn btn-primary btn-sm">
                                                            <?php
                                                            $getAllResults = $tableRegObj->find('all')
                                                                    ->where(['instituteclass_id' => $instituteclass->id])
                                                                    ->count();
                                                            ?>
                                                            <span class="badge">
                                                                <?php
                                                                echo $getAllResults;
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
                                <!-- /.row -->
                            </div> <!-- /.widget-content -->
                        </div> <!-- /.widget -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.tab-content -->
                <!--</div>-->
                <!--END TABS-->
            </div>
        </div> <!-- /.row -->
        <!-- /Page Content -->
    </div>
    <!-- /.container -->

</div>
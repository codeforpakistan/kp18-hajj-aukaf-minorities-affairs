<style>
    .table-responsive{
        overflow-x: unset;
    }
</style>
<?php

use Cake\ORM\TableRegistry;

$tableRegObj = TableRegistry::get('Applicants');
?>
<section class="content">
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php
                    echo $this->Flash->render();
                    ?>
                    <div class="header">

                        <h2>
                            Applicants of " <?php echo ucwords($results[0]['name']) . ' ( Class: ' . $results[0]['class_number'] . ')' ?> "
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
                            <?= $this->Form->create('selected', ['id' => 'selected_form']) ?>
                            <?php
                            $this->Form->unlockField('InstituteFunddetails.selected');
                            ?>
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                    <!--<th>S.No</th>-->
                                        <th>Name</th>
                                        <th>Father Name</th>
                                        <th>Father CNIC</th>
                                        <th>Domicile</th>
                                        <th>Religion</th>
                                        <th>Gender</th>
                                        <th>Contact Number</th>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th>Distribute</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $remaining_amount_for_class = 0;
                                    $distributed = 0;

                                    foreach ($class_applicants as $key => $instituteclass):
                                        ?>
                                        <tr id="class_row<?php echo $key ?>">
                                            <td>
                                                <?php echo $instituteclass['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $instituteclass['father_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $instituteclass['cnic']; ?>
                                            </td>
                                            <td>
                                                <?php echo $cities[$instituteclass['domicile']]; ?>
                                            </td>
                                            <td>
                                                <?php echo $instituteclass['religion_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $instituteclass['gender']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $instituteclass['mob_number'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $instituteclass['current_address'] . ', ' . $instituteclass['city_name'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($instituteclass['amount_recived'] <> null) {
                                                    echo "<p style='font-weight:bold'>Rs " . $instituteclass['amount_recived'] . "</p>";
                                                    $distributed += $instituteclass['amount_recived'];
                                                } else {
                                                    if ($instituteclass['gender'] == 'male') {
                                                        $remaining_amount_for_class += $results[0]['textbook_cost'] + $results[0]['boys_uniform'];
                                                        $amount = $results[0]['textbook_cost'] + $results[0]['boys_uniform'];
                                                    }
                                                    if ($instituteclass['gender'] == 'female') {
                                                        $remaining_amount_for_class += $results[0]['textbook_cost'] + $results[0]['girls_uniform'];
                                                        $amount = $results[0]['textbook_cost'] + $results[0]['girls_uniform'];
                                                    }
                                                    echo $this->Form->text('InstituteFunddetails.amount_recived[]', ['id' => 'amount_recived' . $instituteclass['id'], 'class' => 'form-control', 'value' => $amount]);
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($instituteclass['selected'] == 1) {
                                                    ?>
                                                    <small style="color:green"><?= 'Distributed on:<br/>' . date('M d Y', strtotime($instituteclass['payment_date'])); ?></small>
                                                    <?php
                                                } else {
                                                    echo $this->Form->hidden('InstituteFunddetails.selected[]', ['secure' => false, 'class' => 'hidden_selected', 'value' => 0, 'valueifselected' => $instituteclass['id']]);
                                                    echo $this->Form->checkbox('selected', ['hiddenField' => false, 'name' => false, 'class' => 'filled-in', 'onchange' => 'count_checked(' . $instituteclass['id'] . ')', 'id' => 'selected' . $instituteclass['id'], 'value' => $instituteclass['id']]);
                                                }
                                                ?>
                                                <label for="selected<?php echo $instituteclass['id']; ?>"></label>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
<!--                                    <tr>
                        <td colspan="8" style="text-align:right;font-weight: bold;font-size: 15px;">To distribute</td>
                        <td colspan="2" id="amounttotal"> 
                                    <?php // echo $remaining_amount_for_class; ?>
                        </td>
                    </tr>-->
<!--                                    <tr>
                        <td colspan="8" style="text-align:right;font-weight: bold;font-size: 15px;">Distributed</td>
                        <td colspan="2"> 
                                    <?php // echo $distributed; ?>
                        </td>
                    </tr>-->
                                    <tr>
                                        <td colspan="9" style="text-align:right;font-weight: bold;font-size: 15px;">Check all</td>
                                        <td> 
                                            <?php echo $this->Form->checkbox('checkall', ['secure' => false, 'hiddenField' => false, 'class' => 'filled-in', 'onchange' => 'count_all()', 'id' => 'checkall']); ?>
                                            <label for="checkall"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" style="text-align:right;font-weight: bold;font-size: 15px;">Enter Amount For all</td>
                                        <td> 
                                            <?php echo $this->Form->text('amount_for_all', ['name'=>false,'secure' => false, 'hiddenField' => false, 'class' => 'form-control', 'id' => 'amount_for_all']); ?>
                                            <label for="checkall"></label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row" style="margin-left:0 !important">
                                <br/>
                                <div class="col-lg-4" style="background-color: #eee9;padding: 10px 5px;">
                                    <label class="form-label">Fund to distribute</label>
                                    <?php
                                    $remaining_amount = $fund_amount->total_amount - $distributed_amount;
                                    echo $this->Form->number('fund_amount', ['id' => 'total_amount', 'class' => 'form-control', 'value' => $remaining_amount, 'max' => $remaining_amount]);
                                    ?>
                                    <p style="color: green;margin: 10px 0;">Number of applicants:&nbsp; <span id="total_applicants">0</span></p>
                                    <p style="color: green;">Total Amount: <span id="distribute_amount">0</span></p>
                                </div> 
                                <div class="col-lg-4">
                                    <label class="form-label">Fund Summary</label>
                                    <!--<p>Number of selected Applicants: <span style="font-weight: bold;">< $selected_applicants; ?></span></p>-->  
                                    <p>Total Amount: <span style="font-weight: bold;"><?= $fund_amount->total_amount; ?></span></p>  
                                    <p>Amount Distributed: <span style="font-weight: bold;"><?= $distributed_amount; ?></span></p>  
                                    <p>Amount Remaining: <span style="font-weight: bold;" id="amount_remaining"><?= $remaining_amount; ?></span></p>  
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Class summary</label>
                                    <p>Total Amount For Class: <span style="font-weight: bold;"><?= $remaining_amount_for_class + $distributed; ?></span></p>  
                                    <p>Amount Distributed: <span style="font-weight: bold;"><?= $distributed; ?></span></p>  
                                    <p>Amount Remaining: <span style="font-weight: bold;" id="amounttotal"><?= $remaining_amount_for_class; ?></span></p>  
                                    <p>Total Applicants: <span style="font-weight: bold;"><?= count($class_applicants); ?></span></p>  
                                </div>
                            </div>
                            <br/>
                            <?=
                            $this->Form->button(__('Submit'), ['class' => 'btn btn-primary waves-effect', 'name' => 'select_app']);
                            echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>




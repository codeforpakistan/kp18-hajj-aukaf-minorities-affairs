<style>
    .table-responsive {
        overflow-x: unset !important;
    }
</style>
<section class="content">
    <div class="container-fluid">

        <!-- Exportable Table -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <h4 style="padding: 15px 15px;">Balloting System</h4>
                    <?= $this->Form->create('search') ?>
                    <div class="row">

                        <div class="form-line col-lg-4" style="padding-left: 25px;">
                            <br/>
                            <?php echo $this->Form->control('fund_id', ['empty' => 'Select Funds', 'class' => 'form-control show-tick show sub_categ', 'id' => 'fund_id', 'label' => false, 'options' => @$funds]); ?>
                        </div>
                        <div class="form-line col-lg-4" style="padding-left: 25px">
                            <br/>
                            <?php echo $this->Form->control('limit', ['placeholder' => "Enter number of people to select", 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                        </div>

                        <br/>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="padding-left: 25px;">
                            <br/>
                            <button class="btn btn-primary waves-effect" type="submit" id="submit">SUBMIT</button>
                        </div>
                        <br/>
                    </div>
                    <?php
                    echo $this->Form->end();
                    if (isset($results)) {
                        ?> 
                        <div class="header">
                            <h2>
                                <?= __('Showing result of the given input') ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/Applicants/add'; ?>'>Add Applicants</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <?= $this->Form->create('selected') ?>
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?= $this->Paginator->sort('app_name', 'Applicant Name') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('father_name') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('cnic') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('gender') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('dependent_family_members', 'Family Members') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('monthly_income', 'Income') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('city_name', 'City') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('rligion_name', 'Religion') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('appling_date', 'Applied on') ?></th>
                                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($results as $result):
//                                            debug($result);
                                            ?>
                                            <tr>
                                                <td><?= h($result['app_name']) ?></td>
                                                <td><?= h($result['father_name']) ?></td>
                                                <td><?= h($result['cnic']) ?></td>
                                                <td><?= h($result['gender']) ?></td>
                                                <td><?= h($result['dependent_family_members']) ?></td>
                                                <td><?= h($result['monthly_income']) ?></td>
                                                <td><?= h($result['city_name']) ?></td>
                                                <td><?= $result['religion_name'] ?></td>
                                                <td><?= $result['appling_date']; ?></td>
                                                <td>
                                                    <?php echo $this->Form->checkbox('ApplicantFunddetails.selected.', ['hiddenField' => false, 'class' => 'filled-in', 'onchange' => 'count_checked(' . $result['af_id'] . ')', 'id' => 'selected' . $result['af_id'], 'value' => $result['af_id']]); ?>
                                                    <label for="selected<?php echo $result['af_id']; ?>"></label>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                        <tr>
                                            <td colspan="9" style="text-align:right;font-weight: bold;font-size: 15px;">Check all</td>
                                            <td> 
                                                <?php echo $this->Form->checkbox('checkall', ['hiddenField' => false, 'class' => 'filled-in', 'onchange' => 'count_all()', 'id' => 'checkall']); ?>
                                                <label for="checkall"></label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <p style="padding: 0px 10px; color:red;"> Note! The selected applicants can not be appear here.</p>
                                    <br/>
                                    <div class="col-lg-6" style="background-color: #eee9;padding: 15px 15px !important;">
                                        <label class="form-label">Fund to distribute</label>
                                        <?php
                                        $remaining_amount = $fund_amount->total_amount - $distributed_amount;
                                        echo $this->Form->number('fund_amount', ['id' => 'total_amount', 'class' => 'form-control', 'value' => $remaining_amount, 'max' => $remaining_amount]);
                                        ?>
                                        <p style="color: green;margin: 10px 0;">Number of applicants:&nbsp; <span id="total_applicants">0</span></p>
                                        <p style="color: green;" id="perhead_amount"></p>
                                    </div> 
                                    <div class="col-lg-6">
                                        <label class="form-label">Fund Summary</label>
                                        <p>Number of selected Applicants: <span style="font-weight: bold;"><?= $selected_applicants; ?></span></p>  
                                        <p>Total Amount: <span style="font-weight: bold;"><?= $fund_amount->total_amount; ?></span></p>  
                                        <p>Amount Distributed: <span style="font-weight: bold;"><?= $distributed_amount; ?></span></p>  
                                        <p>Amount Remaining: <span style="font-weight: bold;"><?= $remaining_amount; ?></span></p>  
                                    </div>
                                </div>
                                <br/>
                                <?=
                                $this->Form->button(__('Submit'), ['class' => 'btn btn-primary waves-effect', 'name' => 'select_app']);
                                echo $this->Form->end();
                                ?>

                            </div>
                        </div>
                    <?php }
                    ?>
                    <br/>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
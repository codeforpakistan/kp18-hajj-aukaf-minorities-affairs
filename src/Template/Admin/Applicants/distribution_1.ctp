<section class="content">
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <h4 style="padding: 15px 15px;">Poverty based selection</h4>
                    <?= $this->Form->create('search') ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-line col-lg-4">
                                <br/>
                                <?php echo $this->Form->control('fund_id', ['empty' => 'Select Funds', 'class' => 'form-control show-tick show sub_categ', 'id' => 'fund_id', 'label' => false, 'options' => @$funds]); ?>
                            </div>

                            <div class="form-line col-lg-4">
                                <br/>
                                <?php echo $this->Form->control('religion', ['empty' => 'Select Religion', 'options' => $religions, 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                            </div>

                            <div class="form-line col-lg-4">
                                <br/>
                                <?php echo $this->Form->control('city', ['empty' => 'Select District', 'options' => $cities, 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                            </div>
                            <br/>
                        </div>
                    </div>
                    <br/>
                    <div class="row" id="filter_div">
                        <div class="col-lg-12">
                            <div class="form-line col-lg-4">
                                <br/>
                                <?php echo $this->Form->control('family_members', ['placeholder' => "Enter family members", 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                            </div>
                            <div class="form-line col-lg-2">
                                <br/>
                                <?php echo $this->Form->control('member_operator', ['empty' => "Select operator", 'class' => 'form-control show-tick show sub_categ', 'options' => ['<' => 'Less than', '>' => 'Greater', '=' => 'Equal'], 'label' => false]); ?>
                            </div>

                            <div class="form-line col-lg-4">
                                <br/>
                                <?php echo $this->Form->control('salary', ['placeholder' => "Enter salary", 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                            </div>

                            <div class="form-line col-lg-2">
                                <br/>
                                <?php echo $this->Form->control('salary_operator', ['empty' => "Select operator", 'class' => 'form-control show-tick show sub_categ', 'options' => ['<' => 'Less than', '>' => 'Greater', '=' => 'Equal'], 'label' => false]); ?>
                            </div>
                        </div>
                    </div>

                    <div id="merit_div" class="form-line col-lg-4" style="display: none;padding-left: 10px;">
                        <br/>
                        <?php echo $this->Form->control('percentage', ['class' => 'form-control show-tick show sub_categ', 'placeholder' => 'Enter minimum Percentage', 'label' => false]); ?>
                    </div>
                    <div class="form-line col-lg-4" id="limit_div" style="padding-left: 10px;">
                        <br/>
                        <?php echo $this->Form->control('limit', ['placeholder' => "Enter limit", 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                    </div>
                    <!--                        <div class="form-line col-lg-4" style="padding-left: 0;">
                                                <br/>
                    <?php // echo $this->Form->control('cgpa', ['class' => 'form-control show-tick show sub_categ', 'placeholder' => 'Enter minimum CGPA', 'label' => false]); ?>
                                            </div>-->



                    <!--                        <div class="form-line col-lg-4" style="padding-right: 25px;padding-left: 0;">
                                                <br/>
                    <?php // echo $this->Form->control('city', ['empty' => 'Select District', 'options' => $cities, 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                                            </div>-->
                    <br/>

                    <div class="row">
                        <div class="col-lg-12" style="padding-left: 25px;">
                            <br/>
                            <button class="btn btn-primary waves-effect" type="submit" id="submit">SUBMIT</button>
                        </div>
                        <br/>
                    </div>
                    <br/>

                    <?=
                    $this->Form->end();
                    if (isset($results)) {
                        if (!empty($results)) {
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
                                <!--<div class="">-->
                                <?= $this->Form->create('selected', ['id' => 'selected_form']) ?>

                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Applicant Name</th>
                                            <th scope="col">Father Name</th>
                                            <th scope="col">CNIC</th>
                                            <th scope="col">Gender</th>
                                            <?php if (isset($results[0]['dependent_family_members'])) { ?>

                                                <th scope="col">Family Members</th>
                                            <?php } ?>
                                            <?php if (isset($results[0]['monthly_income'])) { ?>
                                                <th scope="col">Income</th>
                                            <?php } ?>
                                            <th scope="col">District</th>
                                            <th scope="col">Religion</th>
                                            <?php if (isset($results[0]['percentage'])) { ?>
                                                <th scope="col">Qualification</th>
                                                <th scope="col">Discipline</th>
                                                <th scope="col">Percentage</th>
                                                <th scope="col">Recent Class</th>
                                                <th scope="col">Current Class</th>
                                            <?php } ?>
                                            <th scope="col">Applied on</th>
                                            <!--<th scope="col" class="actions">< __('Actions') ?></th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($results as $result):
                                            ?>
                                            <tr>
                                                <td><?= h($result['app_name']) ?></td>
                                                <td><?= h($result['father_name']) ?></td>
                                                <td><?= h($result['cnic']) ?></td>
                                                <td><?= h($result['gender']) ?></td>
                                                <?php if (isset($result['dependent_family_members'])) { ?>
                                                    <td><?= $result['dependent_family_members']; ?></td>
                                                <?php } ?>

                                                <?php if (isset($result['monthly_income'])) { ?>
                                                    <td><?= $result['monthly_income']; ?></td>
                                                <?php } ?>

                                                <td><?= h($result['city_name']) ?></td>
                                                <td><?= h($result['religion_name']) ?></td>
                                                <?php
                                                echo $this->Form->text('ApplicantFunddetails.id[]', ['class' => 'chk-col-green', 'type' => 'hidden', 'value' => $result['af_id']]);
//                                                    echo $this->Form->checkbox('ApplicantFunddetails.selected[]', ['class' => 'chk-col-green', 'id' => 'selected'.$result['applicant_id'],'value'=>1]);
                                                ?>
                                        <!--<label for="selected<?php // echo $result['applicant_id'];          ?>"></label>-->
                                                <!--</td>-->
                                                <?php if (isset($result['percentage'])) { ?>
                                                    <td><?= $result['qualification_name']; ?></td>
                                                    <td><?= $result['discipline']; ?></td>
                                                    <td><?= $result['percentage']; ?></td>
                                                    <td><?= $result['recent_class']; ?></td>
                                                    <td><?= $result['current_class']; ?></td>

                                                <?php } ?> 
                                                <td><?= date('M-d-Y', strtotime($result['appling_date'])); ?></td>

                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <p style="padding: 0px 10px; color:red;"> Note! The selected applicants can not be appear here.</p>
                                    <div class="col-lg-6" style="background-color: #eee9;padding: 15px 15px !important;">
                                        <label class="form-label">Fund to distribute</label>
                                        <?php
                                        $remaining_amount = $results[0]['total_amount'] - $distributed_amount;
                                        echo $this->Form->number('fund_amount', ['id' => 'total_amount', 'class' => 'form-control', 'value' => $remaining_amount, 'max' => $remaining_amount]);
                                        ?>
                                        <p style="color: green;margin: 10px 0;">Number of applicants:&nbsp; <span id="total_applicants"><?= count($results) ?></span></p>
                                        <p style="color: green;" id="perhead_amount"></p>
                                    </div> 
                                    <div class="col-lg-6">
                                        <label class="form-label">Fund Summary</label>
                                        <p>Number of selected Applicants: <span style="font-weight: bold;"><?= $selected_applicants; ?></span></p>  
                                        <p>Total Amount: <span style="font-weight: bold;"><?= $results[0]['total_amount']; ?></span></p>  
                                        <p>Amount Distributed: <span style="font-weight: bold;"><?= $distributed_amount; ?></span></p>  
                                        <p>Amount Remaining: <span style="font-weight: bold;"><?= $remaining_amount; ?></span></p>  
                                    </div>
                                </div>
                                <br/>
                                <!--<button value="select_app" class="btn btn-primary waves-effect" type="submit">SUBMIT</button>-->
                                <?=
                                $this->Form->button(__('Submit'), ['class' => 'btn btn-primary waves-effect', 'name' => 'select_app']);
                                echo $this->Form->end();
                                ?>
                                <!--</div>-->
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 style="padding: 10px;">No record found</h4>
                                    <p style="padding: 0px 10px; color:red;"><b>Note!</b>
                                        <br/>
                                        The selected applicants can not be appear here.
                                        <br/>
                                        <?php
                                        if ($fund_amount->total_amount <= $distributed_amount) {
                                            echo "This fund is distributed.";
                                        }
                                        ?>
                                    </p>

                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Fund Summary</label>
                                    <p>Number of selected Applicants: <span style="font-weight: bold;"><?= $selected_applicants; ?></span></p>  
                                    <p>Total Amount: <span style="font-weight: bold;"><?= $fund_amount->total_amount; ?></span></p>  
                                    <p>Amount Distributed: <span style="font-weight: bold;"><?= $distributed_amount; ?></span></p>  
                                    <p>Amount Remaining: <span style="font-weight: bold;"><?= $fund_amount->total_amount - $distributed_amount; ?></span></p>  
                                </div>
                            </div>

                            <?php
                        }
                    }
                    ?>
                    <br/>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
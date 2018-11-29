<style>
    .table-responsive {
        overflow-x: unset !important;
    }
    #DataTables_Table_0_wrapper{
        overflow: auto;
    }
    #DataTables_Table_0{
        background-color: white; 
    }
</style>
<section class="content">
    <div class="container-fluid">

        <!-- Exportable Table -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <h4 style="padding: 15px 15px;">Distribute Grant</h4>
                    <?= $this->Form->create('search') ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-line col-lg-3">
                                <br/>
                                <?php echo $this->Form->control('fund_id', ['empty' => 'Select Funds', 'class' => 'form-control show-tick show sub_categ', 'id' => 'fund_id', 'label' => false, 'options' => @$funds]); ?>
                            </div>
                            <div class="form-line col-lg-3">
                                <br/>
                                <?php echo $this->Form->control('city', ['empty' => 'Select District', 'class' => 'form-control show-tick show sub_categ', 'label' => false, 'options' => $cities]); ?>
                            </div>
                            <div class="form-line col-lg-3">
                                <br/>
                                <?php echo $this->Form->control('religion', ['empty' => 'Select Religion', 'class' => 'form-control show-tick show sub_categ', 'label' => false, 'options' => $religions]); ?>
                            </div>
                            <div class="form-line col-lg-3">
                                <br/>
                                <?php echo $this->Form->control('cnic', ['placeholder' => 'Search by cnic, name', 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <br/>
                                <button class="btn btn-primary waves-effect" type="submit" id="submit">SUBMIT</button>
                            </div>
                        </div>
                        <br/>
                    </div>
                    <?php
                    echo $this->Form->end();
                    if (isset($results)) {
                        ?> 
                        <div class="header">
                            <h2>
                                Result of all selected applicants
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
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Applicant Name</th>
                                            <th scope="col">Father Name</th>
                                            <th scope="col">Cnic</th>
                                            <th scope="col">Gender</th>
                                            <?php if (!empty($results[0]['dependent_family_members'])) { ?>

                                                <th scope="col">Family Members</th>
                                            <?php } ?>
                                            <?php if (!empty($results[0]['monthly_income'])) { ?>
                                                <th scope="col">Income</th>
                                            <?php } ?>
                                            <th scope="col">District</th>
                                            <th scope="col">Religion</th>
                                            <th scope="col">Applied on</th>
                                            <th scope="col">Amount</th>
                                            <?php if (isset($results[0]['percentage'])) { ?>
                                                <th scope="col">Qualification</th>
                                                <th scope="col">Discipline</th>
                                                <th scope="col">Percentage</th>
                                                <th scope="col">Recent Class</th>
                                                <th scope="col">Current Class</th>
                                            <?php } ?>
                                            <th scope="col">Cheque No</th>
                                            <th style="width:90px">Status</th>
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
                                                <?php if (!empty($result['dependent_family_members'])) { ?>
                                                    <td><?= $result['dependent_family_members']; ?></td>
                                                <?php } ?>

                                                <?php if (!empty($result['monthly_income'])) { ?>
                                                    <td><?= $result['monthly_income']; ?></td>
                                                <?php } ?>
                                                <td><?= h($result['city_name']) ?></td>
                                                <td><?= h($result['religion_name']) ?></td>
                                                <td><?= date('M-d-Y', strtotime($result['appling_date'])); ?></td>
                                                <td style="font-weight:bold"><?= 'Rs ' . $result['amount_recived']; ?></td>
                                                <?php if (isset($result['percentage'])) { ?>
                                                    <td><?= $result['qualification_name']; ?></td>
                                                    <td><?= $result['discipline']; ?></td>
                                                    <td><?= $result['percentage']; ?></td>
                                                    <td><?= $result['recent_class']; ?></td>
                                                    <td><?= $result['current_class']; ?></td>

                                                <?php } ?> 
                                                <td><?php
                                                    $cheque_no = ($result['check_number'] <> null) ? $result['check_number'] : '';
                                                    echo $this->Form->text('cheque_no', ['class' => 'form-control', 'id' => 'cheque_no' . $result['af_id'], 'onchange' => 'update_cheque_no(' . $result['af_id'] . ')', 'label' => false, 'style' => 'width:100px', 'value' => $cheque_no]);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo!empty($result['check_number']) ? 'distributed' : ''; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>

                                <br/>

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
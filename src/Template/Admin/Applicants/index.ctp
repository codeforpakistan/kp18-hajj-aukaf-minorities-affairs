<script type="text/javascript" src="<?php echo $this->request->webroot; ?>js/jquery.min.js"></script>
<script>
    var pageStyle = 'landscape';
    function dateField() {
        return {text: ' Date __________________\n', bold: true, fontSize: 14, alignment: 'right'};
    }
    function header() {
        var header_text = '';
        header_text += "Grant: " + $("#funds option:selected").text();
        if ($('#city_id').length != 0 && $('#city_id').val() != '') {
            header_text += ' District: ' + $("#city option:selected").text();
        }
        if ($('#religion').length != 0 && $('#religion').val() != '') {
            header_text += ' Religion: ' + $("#religion option:selected").text();
        }
        if ($('#cnic').length != 0 && $('#cnic').val() != '') {
            header_text += ' CNIC: ' + $("#cnic").val();
        }
        alert(header_text);
        return header_text;
    }
</script>

<section class="content">
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <h4 style="padding: 15px 15px;">Applicants</h4>
                    <?= $this->Form->create('search') ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-line col-lg-4">
                                <?php
//                                debug($results[0]['f_id']);
                                echo $this->Form->control('funds', ['empty' => 'Select Grants', 'options' => $fundslist, 'value' => $results[0]['f_id'], 'class' => 'form-control show-tick', 'label' => false, 'required']);
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('city_id', ['id' => 'city_id', 'label' => false, 'class' => 'form-control show-tick', 'empty' => 'All Districts', 'options' => $cities]);
                                ?>
                            </div>
                            <div class="form-line col-lg-4">
                                <?php echo $this->Form->control('religion', ['empty' => 'All Religions', 'class' => 'form-control show-tick show sub_categ', 'label' => false, 'options' => $religions]); ?>
                            </div>

                            <div class="form-line col-lg-4">
                                <br/>
                                <?php echo $this->Form->control('token', ['placeholder' => 'Search by Token number', 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                            </div>
                            <div class="col-lg-2">
                                <br/>
                                <button class="btn btn-primary waves-effect" type="submit" id="submit">SUBMIT</button>
                            </div>
                        </div>

                    </div>
                    <?php
                    echo $this->Form->end();
                    ?>
                    <br/>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th scope="col" style="width: 130px">Applicant Name</th>
                                        <th scope="col">Father Name</th>
                                        <th scope="col">Cnic</th>
                                        <!--<th style="width:70px;">Gender</th>-->
                                        <?php if (@$results[0]['sub_cat_id'] <> 3) { ?>
                                            <th scope="col">Family Members</th>
                                            <th scope="col">Income</th>
                                        <?php } else { ?>
                                            <th scope="col">Qualification</th>
                                            <th scope="col">Discipline</th>
                                            <th scope="col">Percentage</th>
                                            <th scope="col">Recent Class</th>
                                            <th scope="col">Current Class</th>
                                        <?php } ?>
                                        <th scope="col">City</th>
                                        <th scope="col">Religion</th>
                                        <th scope="col" style="width: 80px;">Applied on</th>
                                        <th scope="col" style="width: 75px;">Amount</th>
                                        <th>Actions</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($results)) {
                                        foreach ($results as $result):
//                                            debug($result);
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td><?= h($result['app_name']) ?></td>
                                                <td><?= h($result['father_name']) ?></td>
                                                <td><?= h($result['cnic']) ?></td>
                                                <!--<td>< h($result['gender']) ?></td>-->
                                                <?php if ($result['sub_cat_id'] <> 3) { ?>
                                                    <td><?= $result['dependent_family_members']; ?></td>
                                                    <td><?= $result['monthly_income']; ?></td>
                                                <?php } else { ?>
                                                    <td><?= $result['qualification_name']; ?></td>
                                                    <td><?= $result['discipline']; ?></td>
                                                    <td><?= $result['percentage']; ?></td>
                                                    <td><?= $result['recent_class']; ?></td>
                                                    <td><?= $result['current_class']; ?></td>
                                                <?php } ?> 
                                                <td><?= h($result['city_name']) ?></td>
                                                <td><?= h($result['religion_name']) ?></td>
                                                <td><?= date('M-d-Y', strtotime($result['appling_date'])); ?></td>
                                                <td><?= !empty($result['amount_recived']) ? 'Rs ' . $result['amount_recived'] : ''; ?></td>


                                                <td class="actions">
                                                    <?= $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), ['action' => 'view', $result['applicant_id']], array('escape' => false)) ?>
                                                    <?php
                                                    if ($auth->user('role_id') == 1) {
                                                        echo $this->Html->link(__('<i class="glyphicon glyphicon-edit"></i>'), ['action' => 'edit', $result['applicant_id']], array('escape' => false));
                                                        echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), ['action' => 'delete', $result['applicant_id']], array('escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $result['applicant_id'])));
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    }
                                    ?>

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
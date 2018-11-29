<style>
    .alert{
        margin-bottom: 0px;
        margin-top: 10px;        
    }

    .bold_labels{
        font-weight: none;
        margin-left: 10px;
        font-size: 12px;
    }
    td{
        padding:7px !important;
    }
</style>
<div id="content">
    <div class="container">
        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="">Dashboard</a>
                </li>
            </ul>

        </div>
        <!-- /Breadcrumbs line -->

        <!--=== Page Content ===-->
        <!--=== Inline Tabs ===-->
        <div class="row">
            <div class="col-md-12">
                <?= $this->Flash->render() ?>
            </div>
            <div class="col-md-12">
                <h3>You can apply for the following Grants</h3>
                <br/>
                <div class="widget-content">
                    <table id="qualification_details" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Last Date</th>
                                <th>Click to Apply</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (!empty($applicant)) {
                            foreach ($funds as $fund):
                            ?>
                            <tr>
                                <td><?= $fund->sub_category['type_of_fund'] ?></td>
                                <td><?= isset($fund->last_date) ? date('d-M-Y', strtotime($fund->last_date)) : '' ?></td>
                                <?php
                                if (empty($fund->applicant_funddetails)) {
                                ?>
                                <td><a class="btn btn-success btn-sm" onclick="open_modal(<?= $fund->sub_category['id'] . ',' . $fund->id; ?>)" href="#">Apply</a></td>
                                <?php }else{ ?>
                                <td style="color:green">Applied</td>
                                <?php } ?>
                            </tr>
                            <?php
                            endforeach;
                            } else {
                            ?>
                            <tr>
                                <td colspan="3" style="font-size:14px;">Please Provide <a href="<?= $this->request->webroot; ?>Applicants/profile">personal Information</a> first</td>
                            </tr>
                            <?php } ?> 

                        </tbody>
                    </table>
                    <br/><br/>
                </div>
            </div>
        </div> <!-- /.row -->
        <!-- /Page Content -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding: 10px 15px;background-color: #51A351;">
                        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                        <h4 class="modal-title" style="font-size: 13px; color: white;">Review your Information And Apply</h4>
                    </div>
                    <div class="modal-body" style="padding: 10px 20px;">
                        <table class="table" style="background-color:#dddddd1a;border: 1px solid #ccc;">
                            <tr>
                                <td colspan="2" style="padding:6px;background-color:#F3F3F3;">Profile Information</td>
                            </tr>

                            <tr>
                                <td><span class="bold_labels">Name:</span></td>
                                <td><?= ucwords($applicant->name) ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="bold_labels">Father Name:</span>&nbsp;
                                </td>
                                <td>
                                    <?= ucwords($applicant->father_name) ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold_labels">Religion:</span>
                                </td>
                                <td>
                                    <?= $applicant->religion->religion_name ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold_labels">CNIC:</span>
                                </td>
                                <td>
                                    <?= $applicant->cnic ?>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="bold_labels">Gender:</span></td>
                                <td><?= ucwords($applicant->gender); ?></td>
                            </tr>
                            <tr>
                                <td><span class="bold_labels">Marital status:</span></td>
                                <td><?= ucwords($applicant->maritalstatus->status) ?></td>
                            </tr>
                            <tr>
                                <td><span class="bold_labels">Current Address:</span></td>
                                <td><?= ucfirst($applicant->applicantaddresses[0]->current_address) ?></td>
                            </tr>
                            <tr>
                                <td><span class="bold_labels">Mobile Number:</span></td>
                                <td><?= $applicant->applicantcontacts[0]->mob_number ?></td>
                            </tr>
                            <tr>
                                <td><span class="bold_labels">Dependent Family Members:</span></td>
                                <td><?= $applicant->applicant_household_details[0]->dependent_family_members ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold_labels"> Monthly Income:</span>
                                </td> 
                                <td><?= $applicant->applicantincomes[0]->monthly_income ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:right;">
                                    <a class="btn btn-info btn-sm" href="<?= $this->request->webroot; ?>Applicants/profile"><i class="icon-edit"></i> Edit</a>
                                </td> 

                            </tr>
                        </table>
                        <!--                        <div style="text-align:right;">
                                                </div>-->
                        <!--<hr/>-->
                        <?= $this->Form->create($applicant, ['type' => 'file', 'style' => 'margin:unset']); ?>
                        <p style="border-bottom: 1px solid #ccc;padding: 8px;color: red;font-weight: 600;">Upload Documents</p>
                        <div style="margin-top:10px;background-color: #F3F3F3;padding:10px 0px 10px 15px;border:1px solid #ccc;">
                            <strong id="required_attachments"></strong>
                            <br/><br/>

                            <div class="row" id="show_bride_name_field">
                                <label class="col-md-4 control-label">Groom OR Bride Name<span class="required"> *</span></label>
                                <div class="col-md-8">
                                    <?php
                                    $this->Form->unlockField('ApplicantFunddetails.sub_category_id');
                                    echo $this->Form->hidden('ApplicantFunddetails.sub_category_id', ['id' => 'sub_category_id']);
                                    $this->Form->unlockField('ApplicantFunddetails.fund_id');
                                    echo $this->Form->hidden('ApplicantFunddetails.fund_id', ['id' => 'fund_id']);
                                    echo $this->Form->control('Applicants.groom_or_bride_name', ['id' => 'groom_or_bride_name', 'label' => false, 'class' => 'form-control', 'required']);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-4 control-label" style="font-weight:unset;">Attachments</label>
                                <div class="col-md-8">
                                    <?php
                                    echo $this->Form->control('ApplicantAttachments.attachments[]', ['id' => 'attachments', 'secure' => false, 'label' => false, 'type' => 'file', 'style' => 'margin:unset', 'multiple' => true, 'required']);
                                    ?>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer" style="padding:10px 20px 15px;">
                        <?= $this->Form->button(__('Click to Apply'), ['class' => 'btn btn-success btn-sm']); ?>
                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Close</button>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

</div>
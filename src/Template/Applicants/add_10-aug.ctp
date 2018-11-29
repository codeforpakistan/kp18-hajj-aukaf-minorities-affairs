<div id="content">
    <div class="container">
        <!--=== Inline Tabs ===-->
        <div class="row" style="margin-top: 60px;">
            <div class="col-md-12">
                <?= $this->Flash->render() ?>
            </div>
            <?= $this->Form->create($applicant, ['class' => 'form-horizontal', 'type' => 'file']) ?>

            <div class="col-md-12">
                <div class="widget">
                    <div class="widget-header">
                        <h4>General Information</h4>
                    </div>
                    <div class="widget-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">CNIC<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->control('Applicants.cnic', ['id' => 'cnic', 'label' => false, 'class' => 'form-control', 'data-mask' => '99999-9999999-9', 'required']); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Available grant<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->control('ApplicantFunddetails.fund_id', ['id' => 'fund_id', 'label' => false, 'class' => 'form-control', 'empty' => true, 'required']); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Full name<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->control('Applicants.name', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Father Name<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->control('Applicants.father_name', ['label' => false, 'class' => 'form-control', 'required']);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Religion<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->control('Applicants.religion_id', ['label' => false, 'class' => 'form-control', 'empty' => 'Select Religion', 'options' => $religions, 'required']);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Gender<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php
                                        echo $this->Form->control('Applicants.gender', ['type' => 'radio', 'class' => 'uniform', 'label' => false, 'options' => array('male' => 'Male', 'female' => 'Female', 'other' => 'Other'),
                                            'templates' => [
                                                'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                'inputContainer' => '{{content}}'
                                            ], 'required']);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Marital Status<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php
                                        echo $this->Form->control('Applicants.maritalstatus_id', ['type' => 'radio', 'class' => 'uniform', 'label' => false, 'options' => $maritalstatus,
                                            'templates' => [
                                                'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                'inputContainer' => '{{content}}'
                                            ], 'required']);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Profession</label>
                                    <div class="col-md-8">
                                        <?php
                                        //save data in applicantincomes
                                        echo $this->Form->control('Applicantprofessions.profession', ['label' => false, 'class' => 'form-control']);
                                        ?>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Monthly Income<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php
                                        //save data in applicantincomes
                                        echo $this->Form->control('Applicantincomes.monthly_income', ['label' => false, 'class' => 'form-control', 'required']);
                                        ?>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Dependent Family Members<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php
                                        //save data in applicant house holds
                                        echo $this->Form->control('ApplicantHouseholdDetails.dependent_family_members', ['label' => false, 'class' => 'form-control', 'min' => 0, 'required']);
                                        ?>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Attachments<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php
                                        //save data in applicant house holds
//                                                        echo $this->Form->control('ApplicantAttachments.attachments', ['label' => false, 'class' => 'form-control', 'min' => 0, 'required']);
                                        echo $this->Form->control('ApplicantAttachments.attachments[]', ['id' => 'attachments', 'secure' => false, 'label' => false, 'type' => 'file', 'style' => 'margin:unset', 'multiple' => true, 'required']);
                                        ?>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div> 
                        <!-- /.row -->
                    </div> <!-- /.widget-content -->
                </div> <!-- /.widget -->
            </div> <!-- /.col-md-12 -->
            <div class="col-md-12 form-vertical no-margin">
                <div class="widget">
                    <div class="widget-header">
                        <h4>Address Details</h4>
                    </div>
                    <div class="widget-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Current Address<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->control('Applicantaddresses.current_address', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Permanent Address<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->control('Applicantaddresses.permenent_address', ['label' => false, 'class' => 'form-control', 'required']);
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Postal Address<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->control('Applicantaddresses.postal_address', ['label' => false, 'class' => 'form-control', 'required']);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">City<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->control('Applicantaddresses.city_id', ['label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'options' => $cities, 'required']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.row -->

                    </div> <!-- /.widget-content -->
                </div> <!-- /.widget -->
            </div>
            <div class="col-md-12 form-vertical no-margin">
                <div class="widget">
                    <div class="widget-header">
                        <h4>Contact Details</h4>
                    </div>

                    <div class="widget-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Mobile Number<span class="required"> *</span></label>
                                    <div class="col-md-8">
                                        <?php
                                        echo $this->Form->control('Applicantcontacts.mob_number', ['label' => false, 'class' => 'form-control', "data-mask" => "0399 9999 999", 'required']);
                                        ?>
                                        <span class="help-block">03xx xxxx xxx</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Telephone Number</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->control('Applicantcontacts.tel_number', ['label' => false, 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.row -->

                    </div> <!-- /.widget-content -->
                </div> <!-- /.widget -->

                <div class="form-actions">
                    <!--<input type="submit" value="Update Account" class="btn btn-primary pull-right">-->
                    <?= $this->Form->button(__('Save Account'), ['class' => 'btn btn-primary pull-right']); ?>
                </div>
            </div> <!-- /.col-md-12 -->

            <?php echo $this->Form->end(); ?>
        </div> <!-- /.row -->
        <!-- /Page Content -->
    </div>
    <!-- /.container -->

</div>
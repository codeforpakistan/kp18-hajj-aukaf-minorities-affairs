<!--=== Edit Account ===-->
<div class="tab-pane <?= $personal_active; ?>" id="personal_info">
    <!--<form class="form-horizontal" action="#">-->
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
                            <label class="col-md-4 control-label">CNIC<span class="required"> *</span></label>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('Applicants.cnic', ['label' => false, 'class' => 'form-control', 'data-mask' => '99999-9999999-9', 'required']); ?>
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
                        <?php
                        $profession = '';
//                                                debug()
                        if (!empty($applicant['applicantprofessions'])) {
                            $profession = $applicant['applicantprofessions'][0]['profession'];
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Profession<span class="required"> *</span></label>
                            <div class="col-md-8">
                                <?php
                                //save data in applicantincomes
                                echo $this->Form->control('Applicantprofessions.profession', ['label' => false, 'class' => 'form-control', 'value' => $profession, 'required']);
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <?php
                        $monthly_income = '';
                        if (!empty($applicant['applicantincomes'])) {
                            $monthly_income = $applicant['applicantincomes'][0]['monthly_income'];
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Monthly Income<span class="required"> *</span></label>
                            <div class="col-md-8">
                                <?php
                                //save data in applicantincomes
                                echo $this->Form->control('Applicantincomes.monthly_income', ['label' => false, 'class' => 'form-control', 'value' => $monthly_income, 'required']);
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Dependent Family Members<span class="required"> *</span></label>
                            <div class="col-md-8">
                                <?php
                                $dependent = '';
                                if (!empty($applicant['applicant_household_details'])) {
                                    $dependent = $applicant['applicant_household_details'][0]['dependent_family_members'];
                                }
                                //save data in applicant house holds
                                echo $this->Form->control('ApplicantHouseholdDetails.dependent_family_members', ['label' => false, 'class' => 'form-control', 'min' => 0, 'value' => $dependent, 'required']);
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="col-md-12" style="height: 200px;padding-left: 0;">
                                    <?php
                                    $image_name = 'upload.png';
                                    if (!empty($applicant['image']) && file_exists(WWW_ROOT . 'img' . DS . 'applicants' . DS . $applicant['image'])) {
                                        $image_name = $applicant['image'];
                                    }
                                    ?>
                                    <img style="height: 95%;border: 2px solid #ddd;border-radius: 4px;" class="img img-responsive" src="<?php echo $this->request->webroot . 'img/applicants/' . $image_name ?>" alt="<?= $applicant['full_name'] ?>">
                                </div>

                                <div class=" col-md-12 fileinput-holder input-group input-width-xlarge">
                                    <div id="applicant_img_name" class="fileinput-preview uneditable-input form-control" style="cursor: text; text-overflow: ellipsis; ">No file selected...</div>
                                    <div class="input-group-btn">
                                        <span class="fileinput-btn btn" style="overflow: hidden; position: relative; cursor: pointer; ">Browse...
                                            <?php
                                            echo $this->Form->control('Applicants.image', [
                                                'templates' => [
                                                    'inputContainer' => '{{content}}'
                                                ],
                                                'label' => false,
                                                'type' => 'file',
                                                "data-style" => "fileinput",
                                                'id' => 'applicant_image',
                                                "style" => "position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 99px; opacity: 0;"]
                                            );
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            <?php
            $current = $permenent = $postal = $city = '';
            if (!empty($applicant['applicantaddresses'])) {
                $current = $applicant['applicantaddresses'][0]['current_address'];
                $permenent = $applicant['applicantaddresses'][0]['permenent_address'];
                $postal = $applicant['applicantaddresses'][0]['postal_address'];
                $city = $applicant['applicantaddresses'][0]['city_id'];
            }
            ?>
            <div class="widget-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Current Address<span class="required"> *</span></label>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('Applicantaddresses.current_address', ['label' => false, 'class' => 'form-control', 'value' => $current, 'required']); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Permanent Address<span class="required"> *</span></label>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('Applicantaddresses.permenent_address', ['label' => false, 'class' => 'form-control', 'value' => $permenent, 'required']);
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Postal Address<span class="required"> *</span></label>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('Applicantaddresses.postal_address', ['label' => false, 'class' => 'form-control', 'value' => $postal, 'required']);
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">City<span class="required"> *</span></label>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('Applicantaddresses.city_id', ['label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'options' => $cities, 'value' => $city, 'required']);
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
            <?php
            $mob = $tel = '';
            if (!empty($applicant['applicantcontacts'])) {
                $mob = $applicant['applicantcontacts'][0]['mob_number'];
                $tel = $applicant['applicantcontacts'][0]['tel_number'];
            }
            ?>
            <div class="widget-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Mobile Number<span class="required"> *</span></label>
                            <div class="col-md-8">
                                <?php
                                echo $this->Form->control('Applicantcontacts.mob_number', ['label' => false, 'class' => 'form-control', "data-mask" => "0399 9999 999", 'value' => $mob, 'required']);
                                ?>
                                <span class="help-block">03xx xxxx xxx</span>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Telephone Number</label>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('Applicantcontacts.tel_number', ['label' => false, 'class' => 'form-control', 'value' => $tel]); ?>
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
    <!--</form>-->
</div>
<!-- /Edit Account -->
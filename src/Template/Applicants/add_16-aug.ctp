<style>
    .control-label{
        text-align: left;
    }
    #content{
        margin-left: unset;
    }
    li.active{
        background-color: #eee6;
    }
    .nav-justified > li{
        border: 1px solid #eee;
    }
    .control-label{
        /*text-align: unset !important;*/
    }
    .form-actions{
        background-color: #eee6;
    }
    .custom_head{
        color: green;
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
</style>
<div id="content">
    <div class="container">
        <!--=== Inline Tabs ===-->
        <div class="row" style="margin-top: 60px;">
            <div class="col-md-12">
                <?= $this->Flash->render() ?>
            </div>
            <!--=== Form Wizard ===-->
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="widget box" id="form_wizard">
                    <div class="widget-header"style="background-color:#117D2C;">
                        <h4 style="color:white">Please Fill the form carefully</h4>
                        <!--                        <div class="toolbar no-padding">
                                                    <div class="btn-group">
                                                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                                                    </div>
                                                </div>-->
                    </div>
                    <div class="widget-content">
                        <!--<form class="form-horizontal" id="sample_form" action="#">-->
                        <?= $this->Form->create($applicant, ['class' => 'form-horizontal', 'id' => 'sample_form', 'type' => 'file']) ?>

                        <div class="form-wizard">
                            <div class="form-body">
                                <!--=== Steps ===-->
                                <ul class="nav nav-pills nav-justified steps">
                                    <li class="active">
                                        <a href="#initial" data-toggle="tab" class="step">
                                            <span class="number">1</span>
                                            <span class="desc"><i class="icon-ok"></i>Initial</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a  style="" href="#tab2" data-toggle="tab" class="step">
                                            <span class="number">2</span>
                                            <span class="desc"><i class="icon-ok"></i> Your Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a  style="" href="#tab3" data-toggle="tab" class="step active">
                                            <span class="number">3</span>
                                            <span class="desc"><i class="icon-ok"></i> Contact Details</span>
                                        </a>
                                    </li>
                                    <li id="qualification_list">
                                        <a  style="" href="#tab5" data-toggle="tab" class="step">
                                            <span class="number" id="q_num"></span>
                                            <span class="desc"><i class="icon-ok"></i>Qualification details</span>
                                        </a>
                                    </li>
                                    <li id="confirmation">
                                        <a style="" href="#tab4" data-toggle="tab" class="step">
                                            <span class="number" id="c_num" >4</span>
                                            <span class="desc"><i class="icon-ok"></i> Confirmation</span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- /Steps -->

                                <!--=== Progressbar ===-->
                                <!--                                <div id="bar" class="progress progress-striped" role="progressbar">
                                                                    <div class="progress-bar progress-bar-success"></div>
                                                                </div>-->
                                <!-- /Progressbar -->

                                <!--=== Tab Content ===-->
                                <div class="tab-content" style="margin-top:60px">

                                    <!--=== Available On All Tabs ===-->
                                    <div class="alert alert-danger hide-default">
                                        <button class="close" data-dismiss="alert"></button>
                                        You missed some fields. They have been highlighted.
                                    </div>
                                    <!-- /Available On All Tabs -->

                                    <!--=== Basic Information ===-->
                                    <div class="tab-pane active" id="initial">
                                        <!--<h4 class="block padding-bottom-10px">Enter CNIC and Select Grant you want to apply</h4>-->

                                        <div class="form-group">
                                            <label class="control-label col-md-3">CNIC<span class="required">*</span></label>
                                            <div class="col-md-5">
                                                <?php echo $this->Form->control('Applicants.cnic', ['id' => 'cnic', 'label' => false, 'class' => 'form-control', 'data-mask' => '99999-9999999-9', 'required']); ?>
                                                <!--<input type="text" class="form-control required" name="username"/>-->
                                                <span id="cnic_error" class="help-block">Enter CNIC.</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Available Grants <span class="required">*</span></label>
                                            <div class="col-md-5">
                                                <?php echo $this->Form->control('ApplicantFunddetails.fund_id', ['id' => 'fund_id', 'label' => false, 'class' => 'form-control', 'empty' => true, 'required']); ?>
                                                <span id="grant_error" class="help-block">Please select Grant.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Basic Information -->

                                    <!--=== Your Profile ===-->
                                    <div class="tab-pane" id="tab2">
                                        <h3 style="color:#117D2C;" class="block padding-bottom-10px">We want to know more about you</h3>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Fullname <span class="required">*</span></label>
                                            <div class="col-md-5">
                                                <?php echo $this->Form->control('Applicants.name', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                                <span class="help-block">Provide your full name</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Father Name <span class="required">*</span></label>
                                            <div class="col-md-5">
                                                <?php echo $this->Form->control('Applicants.father_name', ['label' => false, 'class' => 'form-control', 'required']);
                                                ?>                                                <span class="help-block">Enter Father Name</span>
                                            </div>
                                        </div>
                                        <div id="bride_div">

                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Religion<span class="required"> *</span></label>
                                            <div class="col-md-5">
                                                <?php echo $this->Form->control('Applicants.religion_id', ['label' => false, 'class' => 'form-control', 'empty' => 'Select Religion', 'options' => $religions, 'required']);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Gender<span class="required"> *</span></label>
                                            <div class="col-md-5">
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
                                            <label class="col-md-3 control-label">Marital Status<span class="required"> *</span></label>
                                            <div class="col-md-5">
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
                                            <label class="col-md-3 control-label">Profession</label>
                                            <div class="col-md-5">
                                                <?php
                                                //save data in applicantincomes
                                                echo $this->Form->control('Applicantprofessions.profession', ['label' => false, 'class' => 'form-control']);
                                                ?>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Monthly Income<span class="required"> *</span></label>
                                            <div class="col-md-5">
                                                <?php
                                                //save data in applicantincomes
                                                echo $this->Form->control('Applicantincomes.monthly_income', ['label' => false, 'class' => 'form-control', 'required']);
                                                ?>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Dependent Family Members<span class="required"> *</span></label>
                                            <div class="col-md-5">
                                                <?php
                                                //save data in applicant house holds
                                                echo $this->Form->control('ApplicantHouseholdDetails.dependent_family_members', ['label' => false, 'class' => 'form-control', 'min' => 0, 'required']);
                                                ?>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Attachments<span class="required"> *</span></label>
                                            <div class="col-md-5">
                                                <?php
                                                echo $this->Form->control('ApplicantAttachments.attachments[]', ['id' => 'attachments', 'secure' => false, 'label' => false, 'type' => 'file', 'style' => 'margin:unset', 'multiple' => true, 'required']);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Your Profile -->

                                    <!--=== Billing Setup ===-->
                                    <div class="tab-pane" id="tab3">
                                        <h3 style="color:#117D2C;" class="block padding-bottom-10px">Provide your Contact details</h3>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Current Address<span class="required"> *</span></label>
                                            <div class="col-md-5">
                                                <?php echo $this->Form->control('Applicantaddresses.current_address', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Permanent Address<span class="required"> *</span></label>
                                            <div class="col-md-5">
                                                <?php echo $this->Form->control('Applicantaddresses.permenent_address', ['label' => false, 'class' => 'form-control', 'required']);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Postal Address<span class="required"> *</span></label>
                                            <div class="col-md-5">
                                                <?php echo $this->Form->control('Applicantaddresses.postal_address', ['label' => false, 'class' => 'form-control', 'required']);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">City<span class="required"> *</span></label>
                                            <div class="col-md-5">
                                                <?php echo $this->Form->control('Applicantaddresses.city_id', ['label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'options' => $cities, 'required']);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Mobile Number<span class="required"> *</span></label>
                                            <div class="col-md-5">
                                                <?php
                                                echo $this->Form->control('Applicantcontacts.mob_number', ['label' => false, 'class' => 'form-control', "data-mask" => "0399 9999 999", 'required']);
                                                ?>
                                                <span class="help-block">03xx xxxx xxx</span>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Billing Setup -->

                                    <!--=== Confirmation ===-->
                                    <div class="tab-pane" id="tab4">
                                        <h3  style="color:#117D2C;" class="block padding-bottom-10px">Please Review your Information</h3>
                                        <h4  style="color:#117D2C;" class="form-section">Personal Info</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">CNIC:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicants[cnic]"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Grant:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="ApplicantFunddetails[fund_id]"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Name:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicants[name]"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Father Name</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicants[father_name]"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Religon:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicants[religion_id]"></p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Profession:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicantprofessions[profession]"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Monthly Income:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicantincomes[monthly_income]"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Family members:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="ApplicantHouseholdDetails[dependent_family_members]"></p>
                                            </div>
                                        </div>
                                        <h4  style="color:#117D2C;" class="form-section">Contact Information</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">current Address:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicantaddresses[current_address]"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Permanent address:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicantaddresses[permenent_address]"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Postal Address:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicantaddresses[postal_address]"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">City:</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicantaddresses[city_id]"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Mobile Number</label>
                                            <div class="col-md-5">
                                                <p class="form-control-static" data-display="Applicantcontacts[mob_number]"></p>
                                            </div>
                                        </div>
                                        <div class="form-actions" style="background-color: unset;border: none;">
                                            <?= $this->Form->button(__('Click to Apply'), ['class' => 'btn btn-success pull-right']); ?>
                                        </div>

                                    </div>

                                    <!-- /Confirmation -->
                                    <!--=== qualification Setup ===-->
                                    <div class="tab-pane" id="tab5">
                                        <h3 style="" class="block padding-bottom-10px">Please enter your qualifications in lowest to highest (Chronological) order.</h3>

                                        <div class="row">

                                            <div class="col-md-6">                                              
                                                <h4 class="custom_head">Qualification Details</h4>

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Qualification level<span class="required"> *</span></label>
                                                    <div class="col-md-8">
                                                        <?php
                                                        echo $this->Form->control('Qualifications.qualification_level_id[]', ['id' => 'qualification_level0', 'onchange' => 'change_fields(0)', 'label' => false, 'class' => 'form-control', 'empty' => true, 'options' => $qualificationLevels, 'required']);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Completed</label>
                                                    <div class="col-md-8">
                                                        <?php
                                                        echo $this->Form->control('Qualifications.completed.0', ['id' => 'completed0', 'onchange' => 'change_completed(0)', 'type' => 'checkbox', 'class' => 'uniform', 'style' => 'margin-top: 8px;', 'label' => false,
                                                            'templates' => [
                                                                'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                                'inputContainer' => '{{content}}'
                                                        ]]);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group" style="display:none;" id="div_passing_date0">
                                                    <label class="col-md-4 control-label">Date of completion</label>
                                                    <div class="col-md-8">
                                                        <?php
                                                        echo $this->Form->control('Qualifications.passing_date[]', ['id' => 'passing_date0', 'type' => 'text', 'data-mask' => '2099-99-99', 'label' => false, 'class' => 'form-control']);
                                                        ?>
                                                        <span class="help-block">yyyy-mm-dd</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Education System</label>
                                                    <div class="col-md-8">
                                                        <?php
                                                        echo $this->Form->control('Qualifications.education_system.0', ['type' => 'radio', 'class' => 'uniform', 'options' => ['annual' => 'Annual', 'semester' => 'Semester', 'term' => 'Term'], 'label' => false,
                                                            'templates' => [
                                                                'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                                'inputContainer' => '{{content}}'
                                                            ], 'required']);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <h4  class="custom_head">Academic Performance Details</h4>

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Grading System</label>
                                                    <div class="col-md-8">
                                                        <?php
                                                        
                                                        echo $this->Form->control('Qualifications.grading_system.0', ['secure'=>false,'id' => 'grading_system0', 'onchange' => 'grading_system(0)', 'type' => 'radio', 'class' => 'uniform', 'options' => ['cgpa' => 'CGPA', 'marks' => 'Marks'], 'label' => false,
                                                            'templates' => [
                                                                'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                                'inputContainer' => '{{content}}'
                                                            ], 'required']);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div id="cgpa_fields0" style="display:none;">
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Total CGPA</label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.total_cgpa[]', ['id' => 'total_cgpa0', 'class' => 'form-control', 'empty' => true, 'options' => ['4' => '4', '5' => '5'], 'label' => false]);
                                                            ?>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Obtained CGPA</label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.obtained_cgpa', ['id' => 'obtained_cgpa0', 'type' => 'text', 'class' => 'form-control', 'data-mask' => '9.99', 'label' => false]);
                                                            ?> 
                                                            <span id="obtained_cgpa_error0"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="marks_fields0">
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Total Marks</label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.total_marks[]', ['id' => 'total_marks0', 'type' => 'text', 'class' => 'form-control', 'label' => false, 'required']);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Obtained Marks</label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.obtained_marks', ['id' => 'obtained_marks0', 'type' => 'text', 'class' => 'form-control', 'label' => false, 'required']);
                                                            ?>
                                                            <span id="obtained_marks_error0"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="percentage_div0" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Percentage</label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.percentage[]', ['id' => 'percentage0', 'class' => 'form-control', 'type' => 'text', 'data-mask' => '99.99', 'label' => false]);
                                                            ?>
                                                            <span id="percentage_error0"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4  class="custom_head">Institute Details</h4>

                                                <div id="school_fields0">
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">City<span class="required"> *</span></label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            $this->Form->unlockField('Institutes.city_id');
                                                            echo $this->Form->control('Institutes.city_id[]', ['id' => 'city_dropdown0', 'secure' => false, 'empty' => true, 'label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'options' => $cities, 'required']);
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Select Board<span class="required"> *</span></label>
                                                        <div class="col-md-8">
                                                            <?php echo $this->Form->control('Qualifications.degree_awarding_id[]', ['id' => 'degree_awarding_id0', 'label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'empty' => true, 'options' => $degreeAwardings, 'required']);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">School/College<span class="required"> *</span></label>
                                                        <div class="col-md-8">
                                                            <?php echo $this->Form->control('Institutes.name[]', ['id' => 'institue_name0', 'label' => false, 'class' => 'form-control', 'required']);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Institute Sector</label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo $this->Form->control('Institutes.institute_sector.0', ['type' => 'radio', 'class' => 'uniform', 'options' => ['pri' => 'Private', 'pub' => 'Public'], 'label' => false,
                                                                'templates' => [
                                                                    'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                                    'inputContainer' => '{{content}}'
                                                                ], 'required']);
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Discipline <span class="required"> *</span></label>
                                                        <div class="col-md-8">
                                                            <?php echo $this->Form->control('Qualifications.discipline_id[]', ['id' => 'discipline0', 'label' => false, 'class' => 'form-control', 'empty' => 'Select Discipline', 'options' => array(), 'required']);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="university_fields0" style="display: none">
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Select University <span class="required"> *</span></label>
                                                        <div class="col-md-8">
                                                            <?php echo $this->Form->control('Qualifications.institute_id[]', ['id' => 'institute_id0', 'label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'empty' => true, 'options' => $institutes]);
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Discipline <span class="required"> *</span></label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo $this->Form->control('Disciplines.discipline[]', ['id' => 'discipline_field0', 'label' => false, 'class' => 'form-control', 'required']);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                            </div>
                                        </div> <!-- /.row -->
                                        <div id="div_add_education" class="col-md-12" style="float:unset;text-align: right">
                                            <a href="#" id="add_education" class="btn btn-primary btn-sm">
                                                Add More
                                            </a>
                                            <br/><br/>
                                        </div>

                                    </div>
                                    <!-- /qualification Setup -->

                                </div>
                                <!-- /Tab Content -->
                            </div>

                            <!--=== Form Actions ===-->
                            <div class="form-actions fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-offset-3 col-md-9"  style="text-align:right">
                                            <a href="javascript:void(0);" class="btn button-previous">
                                                <i class="icon-angle-left"></i> Back
                                            </a>
                                            <a href="javascript:void(0);" id="continue" class="btn btn-primary button-next">
                                                Continue <i class="icon-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Form Actions -->
                        </div>
                        <?php echo $this->Form->end(); ?>

                    </div>
                </div>
                <!-- /Form Wizard -->
            </div>
            <div class="col-md-1"></div>

            <!-- /Page Content -->
        </div> <!-- /.row -->
        <!-- /Page Content -->
    </div>
    <!-- /.container -->

</div>
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
    .skiptranslate{
        float:right;
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
            <?php if (isset($no_available_grants)) { ?>
                <!--=== Confirmation ===-->
                <!--<div class="tab-pane" id="tab4">-->
                <h3  style="color:#117D2C;font-size: 20px;color: red;"><?= $no_available_grants; ?></h3>
                <!--</div>-->
                <!-- /Confirmation -->
            <?php } else { ?>
                <div class="col-md-10">
                    <div class="widget box" id="form_wizard">
                        <div class="widget-header"style="background-color:#117D2C;">
                            <h4 style="color:white">Please Fill the form carefully</h4>
                        </div>
                        <div class="widget-content">
                            <div class="lang"  id="google_translate_element" style="margin-bottom: 15px;padding: 0 5px;min-height: 15px;">
                                <?php
                                if ($auth->user('role_id') == 1 || $auth->user('role_id') == 2) {
                                    ?>
                                    <a onclick="window.history.go(-1);return false;" style ="font-size: 14px;color: green;text-decoration: underline; cursor: pointer;">Go back</a>
                                <?php } ?>
                            </div>
                            <script type="text/javascript">
                                function googleTranslateElementInit() {
                                    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                }
                            </script>
                            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

                            <!--<form class="form-horizontal" id="sample_form" action="#">-->
                            <?= $this->Form->create(false, ['class' => 'form-horizontal', 'id' => 'sample_form', 'type' => 'file']) ?>

                            <!--=== Basic Information ===-->
                            <?php
                            if (!$this->request->session()->read('Applicantcnic')) {
                                ?>
                                <style>
                                    .bg-image{
                                        background-image:url('<?php echo $this->request->webroot . 'img/bg1.jpg'; ?>');   
                                        background-position: bottom;
                                        background-size: cover;
                                        background-repeat:no-repeat;
                                    }
                                    #content{
                                        background: unset;
                                    }
                                </style>
                                <div class="" id="initial" style="margin-top: 25px !important;">
                                    <div class="form-group">
                                        <label class="control-label col-md-offset-3 col-md-2">CNIC<span class="required">*</span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('cnic', ['id' => 'cnic', 'label' => false, 'class' => 'form-control', 'pattern' => "[0-9]{5}-[0-9]{7}-[0-9]{1}", 'data-mask' => '99999-9999999-9', 'required']); ?>
                                            <!--<input type="text" class="form-control required" name="username"/>-->
                                            <span id="cnic_error" class="help-block">CNIC format (xxxxx-xxxxxxx-x)</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-offset-3 col-md-2">Available Grants <span class="required">*</span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('fund_id', ['id' => 'fund_id', 'label' => false, 'class' => 'form-control', 'empty' => 'Select Grant', 'required']); ?>
                                            <span id="grant_error" class="help-block">Please select Grant.</span>
                                            <br/>
                                            <?php
                                            if (!empty($last_date->toArray()) || $auth->user('role_id')) {
                                                echo $this->Form->button(__('Click to Apply'), ['class' => 'btn btn-success pull-right', 'style' => 'margin-left:5px;']);
                                            }
                                            echo $this->Form->button(__('Check Your Status'), ['name' => 'check_status', 'class' => 'btn btn-info pull-right']);
                                            ?>
                                        </div>
                                        <div class="col-lg-12">
                                            <br/><br/>
                                            <ol style="color: red;padding: 0px 15px;font-size: 14px;list-style: unset;">
                                                <?php
                                                if (isset($last_date)) {
                                                    foreach ($last_date as $l_d):
                                                        ?>
                                                        <li>Last date of <?php echo ucfirst($l_d->fund_name) . ' is &nbsp;<b>' . date('d-F-Y', strtotime($l_d->last_date)) . '</b>'; ?></li>
                                                        <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </ol>
                                        </div>

                                    </div>

                                    <?php
//                                if (isset($message)) {
                                    ?>
                                    <!--                                    <div class="form-group">
                                                                            <p class="col-md-offset-3 col-md-6" style="padding: 10px;background-color: #eee8;font-size: 16px;"><?php echo $message; ?></p>
                                    
                                                                        </div>-->
                                    <?php // }      ?>
                                </div>
                                <!-- /Basic Information -->
                                <?php
                            } else {
                                ?>
                                <style>
                                    .bg-image{
                                        /*background-image:url('<?php echo $this->request->webroot . 'img/bg1.jpg'; ?>')*/   
                                        background-color: #eee;
                                    }
                                    #content{
                                        background: #eee;
                                    }
                                </style>
                                <div class="form-wizard">
                                    <div class="form-body">
                                        <!--=== Steps ===-->
                                        <ul class="nav nav-pills nav-justified steps">
                                            <li>
                                                <a  style="" href="#tab2" data-toggle="tab" class="step">
                                                    <span class="number">1</span>
                                                    <span class="desc"><i class="icon-ok"></i> General Info</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a  style="" href="#tab3" data-toggle="tab" class="step active">
                                                    <span class="number">2</span>
                                                    <span class="desc"><i class="icon-ok"></i> Contact Details</span>
                                                </a>
                                            </li>
                                            <?php if ($subCategory->id == 3) { ?>
                                                <li>
                                                    <a  style="" href="#tab5" data-toggle="tab" class="step">
                                                        <span class="number" id="q_num">3</span>
                                                        <span class="desc"><i class="icon-ok"></i>Qualification details</span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <li id="confirmation">
                                                <a style="" href="#tab4" data-toggle="tab" class="step">
                                                    <span class="number" id="c_num" ><?= ($subCategory->id == 3) ? '4' : '3' ?></span>
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
                                                Please Fill up the highlighted Fields.
                                            </div>
                                            <!-- /Available On All Tabs -->

                                            <!--=== Your Profile ===-->
                                            <div class="tab-pane" id="tab2">
                                                <h3 style="color:#117D2C;" class="block padding-bottom-10px">We want to know more about you</h3>
                                                <?php if (isset($error_msg)) { ?>
                                                    <div class="alert alert-danger fade in message error">
                                                        <i class="icon-remove close" data-dismiss="alert"></i>
                                                        <strong>Error!</strong><br/> <?= $error_msg ?>
                                                    </div>
                                                    <?php
                                                }
                                                $g_s = '';
                                                $m_s = '';
                                                $f_label = '';
                                                if ($subCategory->id == 2) {
                                                    $g_s = 'female'
                                                    ?>
                                                    <h3 style="border: 1px solid #eee;background-color: #eee9;padding: 10px 5px;">Bride Details</h3>
                                                <?php } ?>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Full Name <span class="required">*</span></label>
                                                    <div class="col-md-5">
                                                        <?php echo $this->Form->control('Applicants.name', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                                        <span class="help-block">Provide your full name</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    // checks if it is widow, merriage, health grant
                                                    if ($subCategory->id == 1) {
                                                        $g_s = 'female';
                                                        $m_s = 4;
                                                        $f_label = '/Husbands';
                                                    }
                                                    ?>
                                                    <label class="control-label col-md-3">Father<?php echo $f_label; ?> Name <span class="required">*</span></label>
                                                    <div class="col-md-5">
                                                        <?php echo $this->Form->control('Applicants.father_name', ['label' => false, 'class' => 'form-control', 'required']);
                                                        ?>                                                <span class="help-block">Enter Father Name</span>
                                                    </div>
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
                                                            'value' => $g_s
                                                            , 'templates' => [
                                                                'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                                'inputContainer' => '{{content}}'
                                                            ], 'required']);
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
                                                if ($subCategory->id == 3) {
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Domicile<span class="required"> *</span></label>
                                                        <div class="col-md-5">
                                                            <?php echo $this->Form->control('Applicants.domicile', ['label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'options' => $cities, 'required']);
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Marital Status<span class="required"> *</span></label>
                                                        <div class="col-md-5">
                                                            <?php
                                                            echo $this->Form->control('Applicants.maritalstatus_id', ['type' => 'radio', 'class' => 'uniform', 'label' => false, 'options' => $maritalstatus,
                                                                'value' => $m_s
                                                                , 'templates' => [
                                                                    'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                                    'inputContainer' => '{{content}}'
                                                                ], 'required']);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <!--merrige Grant-->
                                                    <?php if ($subCategory->id == 2) { ?>
                                                        <h3 style = "border: 1px solid #eee;background-color: #eee9;padding: 10px 5px;">Groom Details</h3>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Groom Name <span class="required">*</span></label>
                                                            <div class="col-md-5">
                                                                <?php echo $this->Form->control('Applicants.gname', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                                                <span class="help-block">Enter full name</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Father Name <span class="required">*</span></label>
                                                            <div class="col-md-5">
                                                                <?php echo $this->Form->control('Applicants.gfather_name', ['label' => false, 'class' => 'form-control', 'required']);
                                                                ?>                                               
                                                                <span class="help-block">Enter Father Name</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">CNIC <span class="required">*</span></label>
                                                            <div class="col-md-5">
                                                                <?php echo $this->Form->control('Applicants.gcnic', ['label' => false, 'class' => 'form-control', 'pattern' => "[0-9]{5}-[0-9]{7}-[0-9]{1}", "data-mask" => "99999-9999999-9", 'required']);
                                                                ?>                                                
                                                                <span class="help-block">Enter CNIC(xxxxx-xxxxxxx-x)</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Contact Number <span class="required">*</span></label>
                                                            <div class="col-md-5">
                                                                <?php echo $this->Form->control('Applicants.gcontact', ['label' => false, 'class' => 'form-control', 'pattern' => "[0-9]{4} [0-9]{7}", "data-mask" => "0399 9999999", 'required']);
                                                                ?>                                                
                                                                <span class="help-block">Enter CNIC(xxxxx-xxxxxxx-x)</span>
                                                            </div>
                                                        </div>

                                                    <?php } else {
                                                        ?>
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
                                                                <span class="help-block">Input must be number</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Dependent Family Members<span class="required"> *</span></label>
                                                            <div class="col-md-5">
                                                                <?php
                                                                //save data in applicant house holds
                                                                echo $this->Form->control('ApplicantHouseholdDetails.dependent_family_members', ['label' => false, 'class' => 'form-control', 'min' => 0, 'required']);
                                                                ?>
                                                                <span class="help-block">Input must be number</span>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    if ($subCategory->id == 4) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Disease<span class="required">*</span></label>
                                                            <div class="col-md-5">
                                                                <?php echo $this->Form->control('Applicants.disease', ['label' => false, 'class' => 'form-control', 'required']);
                                                                ?>                                               
                                                            </div>
                                                        </div>
                                                        <h3 style = "border: 1px solid #eee;background-color: #eee9;padding: 10px 5px;">Disease & hospitalization Details</h3>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Doctor Name <span class="required">*</span></label>
                                                            <div class="col-md-5">
                                                                <?php echo $this->Form->control('Applicants.dname', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Address of Hospital/clinic <span class="required">*</span></label>
                                                            <div class="col-md-5">
                                                                <?php echo $this->Form->control('Applicants.clinic_address', ['label' => false, 'class' => 'form-control', 'required']);
                                                                ?>                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Contact Number <span class="required">*</span></label>
                                                            <div class="col-md-5">
                                                                <?php echo $this->Form->control('Applicants.dcontact', ['label' => false, 'class' => 'form-control', 'required']);
                                                                ?>                                                
                                                            </div>
                                                        </div>  
                                                        <?php
                                                    }
                                                }
                                                ?>
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
                                                    <label class="col-md-3 control-label">District<span class="required"> *</span></label>
                                                    <div class="col-md-5">
                                                        <?php echo $this->Form->control('Applicantaddresses.city_id', ['label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'options' => $cities, 'required']);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-bottom: 0;">
                                                    <label class="col-md-3 control-label">Mobile Number<span class="required"> *</span></label>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->control('Applicantcontacts.mob_number[]', ['label' => false, 'class' => 'form-control', 'pattern' => "[0-9]{4} [0-9]{7}", "data-mask" => "0399 9999999", 'required']);
                                                        ?>
                                                        <span class="help-block">03xx xxxxxxx</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-8">
                                                    <a class="pull-right" href="#" id="add_contact_row">add more</a>  

                                                </div>
                                                <br/><br/>
                                            </div>
                                            <!-- /Billing Setup -->
                                            <?php
                                            if ($subCategory->id == 3) {
                                                ?>
                                                <!--=== qualification Setup ===-->
                                                <div class="tab-pane" id="tab5">
                                                    <h3 style="" class="block padding-bottom-10px">Please provide detail of recently passed class</h3>

                                                    <div class="row">

                                                        <div class="col-md-6">                                              
                                                            <h4 class="custom_head">Qualification Details</h4>

                                                            <div class="form-group">
                                                                <label class="col-md-4 control-label">Qualification level<span class="required"> *</span></label>
                                                                <div class="col-md-8">
                                                                    <?php
                                                                    echo $this->Form->control('Qualifications.qualification_level_id', ['id' => 'qualification_level', 'label' => false, 'class' => 'form-control', 'empty' => true, 'options' => $qualificationLevels, 'required']);
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <!--                                                        <div class="form-group">
                                                                                                                        <label class="col-md-4 control-label">Completed</label>
                                                                                                                        <div class="col-md-8">
                                                            <?php
//                                                                echo $this->Form->control('Qualifications.completed', ['id' => 'completed', 'type' => 'checkbox', 'class' => 'uniform', 'style' => 'margin-top: 8px;', 'label' => false,
//                                                                    'templates' => [
//                                                                        'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
//                                                                        'inputContainer' => '{{content}}'
//                                                                ]]);
                                                            ?>
                                                                                                                        </div>
                                                                                                                    </div>-->

                                                            <div class="form-group">
                                                                <label class="col-md-4 control-label">Education System</label>
                                                                <div class="col-md-8">
                                                                    <?php
                                                                    echo $this->Form->control('Qualifications.education_system', ['type' => 'radio', 'class' => 'uniform', 'options' => ['annual' => 'Annual', 'semester' => 'Semester', 'term' => 'Term'], 'label' => false,
                                                                        'templates' => [
                                                                            'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                                            'inputContainer' => '{{content}}'
                                                                        ], 'required']);
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="div_passedclass" style="display:none">
                                                                <label id="label_passedclass" class="col-md-4 control-label">Recently passed class</label>
                                                                <div class="col-md-8">
                                                                    <?php
                                                                    echo $this->Form->control('Qualifications.recent_class', ['id' => 'recent_class', 'type' => 'text', 'label' => false, 'class' => 'form-control']);
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="div_passing_date" style="display:none">
                                                                <label class="col-md-4 control-label">Date of completion</label>
                                                                <div class="col-md-8">
                                                                    <?php
                                                                    echo $this->Form->control('Qualifications.passing_date', ['id' => 'passing_date', 'type' => 'text', 'data-mask' => '2099-99-99', 'label' => false, 'class' => 'form-control']);
                                                                    ?>
                                                                    <span class="help-block">yyyy-mm-dd</span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="div_currentclass" style="display:none">
                                                                <label id="label_currentclass" class="col-md-4 control-label">Current class</label>
                                                                <div class="col-md-8">
                                                                    <?php
                                                                    echo $this->Form->control('Qualifications.current_class', ['id' => 'current_class', 'type' => 'text', 'label' => false, 'class' => 'form-control']);
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">

                                                            <h4  class="custom_head">Academic performance details of recently passed exam</h4>

                                                            <div class="form-group">
                                                                <label class="col-md-4 control-label">Grading System</label>
                                                                <div class="col-md-8">
                                                                    <?php
                                                                    echo $this->Form->control('Qualifications.grading_system', ['id' => 'grading_system', 'type' => 'radio', 'class' => 'uniform', 'options' => ['cgpa' => 'CGPA', 'marks' => 'Marks'], 'label' => false,
                                                                        'templates' => [
                                                                            'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                                            'inputContainer' => '{{content}}'
                                                                        ], 'required']);
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div id="cgpa_fields" style="display:none;">
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">Total CGPA</label>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                        echo $this->Form->control('Qualifications.total_cgpa', ['id' => 'total_cgpa', 'class' => 'form-control', 'empty' => true, 'options' => ['4' => '4', '5' => '5'], 'label' => false]);
                                                                        ?>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">Obtained CGPA</label>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                        echo $this->Form->control('Qualifications.obtained_cgpa', ['id' => 'obtained_cgpa', 'type' => 'text', 'class' => 'form-control', 'data-mask' => '9.99', 'label' => false]);
                                                                        ?> 
                                                                        <span id="obtained_cgpa_error"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="marks_fields">
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">Total Marks</label>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                        echo $this->Form->control('Qualifications.total_marks', ['id' => 'total_marks', 'type' => 'text', 'class' => 'form-control', 'label' => false, 'required']);
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">Obtained Marks</label>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                        echo $this->Form->control('Qualifications.obtained_marks', ['id' => 'obtained_marks', 'type' => 'text', 'class' => 'form-control', 'label' => false, 'required']);
                                                                        ?>
                                                                        <span id="obtained_marks_error"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="percentage_div" style="display: none;">
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">Percentage</label>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                        echo $this->Form->control('Qualifications.percentage', ['id' => 'percentage', 'class' => 'form-control', 'type' => 'text', 'data-mask' => '99.99', 'label' => false]);
                                                                        ?>
                                                                        <span id="percentage_error"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div> 

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4  class="custom_head">Institute Details</h4>

                                                            <div id="school_fields">
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">City<span class="required"> *</span></label>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                        $this->Form->unlockField('Institutes.city_id');
                                                                        echo $this->Form->control('Institutes.city_id', ['id' => 'city_dropdown', 'secure' => false, 'empty' => true, 'label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'options' => $cities, 'required']);
                                                                        ?>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">Select Board<span class="required"> *</span></label>
                                                                    <div class="col-md-8">
                                                                        <?php echo $this->Form->control('Qualifications.degree_awarding_id', ['id' => 'degree_awarding_id', 'label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'empty' => true, 'options' => $degreeAwardings, 'required']);
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">School/College<span class="required"> *</span></label>
                                                                    <div class="col-md-8">
                                                                        <?php echo $this->Form->control('Institutes.name', ['id' => 'institue_name', 'label' => false, 'class' => 'form-control', 'required']);
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">Institute Sector</label>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                        echo $this->Form->control('Institutes.institute_sector', ['type' => 'radio', 'class' => 'uniform', 'options' => ['pri' => 'Private', 'pub' => 'Public'], 'label' => false,
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
                                                                        <?php echo $this->Form->control('Qualifications.discipline_id', ['id' => 'discipline', 'label' => false, 'class' => 'form-control', 'empty' => 'Select Discipline', 'options' => array(), 'required']);
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="university_fields" style="display: none">
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">Select University <span class="required"> *</span></label>
                                                                    <div class="col-md-8">
                                                                        <?php echo $this->Form->control('Qualifications.institute_id', ['id' => 'institute_id', 'label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'empty' => true, 'options' => $institutes]);
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">Discipline <span class="required"> *</span></label>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                        echo $this->Form->control('Disciplines.discipline', ['id' => 'discipline_field', 'label' => false, 'class' => 'form-control', 'required']);
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">

                                                        </div>
                                                    </div> <!-- /.row -->

                                                </div>
                                                <!-- /qualification Setup -->

                                            <?php } ?>
                                            <!--=== Confirmation ===-->
                                            <div class="tab-pane" id="tab4">
                                                <h3  style="color:#117D2C;" class="block padding-bottom-10px">Please Review your Information</h3>
                                                <h4  style="color:#117D2C;" class="form-section">Personal Info</h4>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">CNIC:</label>
                                                    <div class="col-md-5">
                                                        <p class="form-control-static" data-display="Applicants[cnic]"><?php echo $this->request->session()->read('Applicantcnic') ?></p>
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
                                                <?php
                                                if ($subCategory->id == 3) {
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Domicile:</label>
                                                        <div class="col-md-5">
                                                            <p class="form-control-static" data-display="Applicants[domicile]"></p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
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
                                                <?php } ?>
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
                                <?php
                            }
                            ?>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                    <!-- /Form Wizard -->
                </div>
            <?php } ?>
            <div class="col-md-1"></div>

            <!-- /Page Content -->
        </div> <!-- /.row -->
        <!-- /Page Content -->
    </div>
    <!-- /.container -->

</div>

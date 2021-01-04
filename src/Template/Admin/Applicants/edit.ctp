<style>
    .form-line1{
        background-color: #eee6;
        padding: 1px 5px;
        border: 1px solid #eee;
    }
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>js/ajax.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>js/admin_custom.js"></script>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Edit Applicant Details</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href='<?= $this->request->webroot . 'admin/Applicants'; ?>'>All Applicants</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= $this->Form->create($applicant, ['type' => 'file']) ?>
                                <div class="form-group">
                                    <div class="form-line1">
                                        <h4>Personal Info</h4>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicants.cnic', ['class' => 'form-control', 'required', 'pattern' => '^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$']); ?>
                                        <label class="form-label">CNIC (12345-6789012-3)</label>
                                    </div>
                                </div>
                                <!--                            <div class="form-group form-float">
                                                                    <div class="form-line">
                                <?php // echo $this->Form->control('ApplicantFunddetails.fund_id', ['options' => $fund,'class'=>'form-control show-tick show sub_categ','value'=>$applicant['applicant_funddetails'][0]['fund_id'],'id'=>'funds','label'=>false,'required']);?>
                                                                    </div>                                    
                                                             </div>-->

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicants.name', ['class' => 'form-control', 'pattern' => '[[A-Za-z\s]+', 'id' => 'name12', 'required']); ?>
                                        <label class="form-label">Applicants Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicants.father_name', ['class' => 'form-control', 'pattern' => '[[A-Za-z\s]+', 'required']); ?>
                                        <label class="form-label">Father Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">

                                    <div class="form-line">
                                        <?php echo $this->Form->control('Applicants.religion_id', ['empty' => 'Select Religion', 'options' => $religions, 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>

                                    </div>
                                </div>


                                <div class="demo-radio-button">
                                    <label class="form-label">Gender</label>
                                    <?php
                                    echo $this->Form->control('Applicants.gender', ['label' => false, 'type' => 'radio', 'label' => false, 'escape' => false, 'options' => array('male' => '&nbsp;Male', 'female' => '&nbsp;Female'), 'value' => $applicant['gender'], 'templates' => [
                                            'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                                            'radioWrapper' => '{{label}}'
                                    ]]);
                                    ?>
                                </div>
                                <div class="form-group form-float">
                                    <?php ?>
                                    <div class="form-line">
                                        <?php echo $this->Form->control('Applicants.maritalstatus_id', ['empty' => 'Select Marital Status', 'options' => $maritalstatus, 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>
                                    </div>                                    
                                </div>
                                <?php
                                if ($fund_details_results[0]['sub_cat'] == 3) {
                                    ?>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <?php
                                            echo $this->Form->control('Applicants.domicile', ['options' => $city, 'class' => 'form-control', 'label' => false, 'required']);
                                            ?>
                                            <label class="form-label">Domicile</label>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    if ($fund_details_results[0]['sub_cat'] == 2) {
                                        ?>
                                        <div class="form-group">
                                            <div class="form-line1">
                                                <h4>Groom Details</h4>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->control('Applicants.gname', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                                <label class="form-label">Groom Name</span>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->control('Applicants.gfather_name', ['label' => false, 'class' => 'form-control', 'required']);
                                                ?>                                               
                                                <label class="form-label">Father Name <span class="required">*</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->control('Applicants.gcnic', ['label' => false, 'class' => 'form-control', 'pattern' => "[0-9]{5}-[0-9]{7}-[0-9]{1}", "data-mask" => "99999-9999999-9", 'required']);
                                                ?>                                                
                                                <label class="form-label">CNIC <span class="required">*</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->control('Applicants.gcontact', ['label' => false, 'class' => 'form-control', 'pattern' => "[0-9]{4} [0-9]{7}", "data-mask" => "0399 9999999", 'required']);
                                                ?>                                                
                                                <label class="form-label">Contact Number <span class="required">*</span></label>
                                            </div>
                                        </div>

                                    <?php } else { ?>
                                        <div class = "form-group form-float">
                                            <div class = "form-line">
                                                <?php echo $this->Form->text('Applicantprofessions.profession', ['value' => $applicant['applicantprofessions'][0]['profession'], 'class' => 'form-control', 'label' => false, 'required']);
                                                ?>
                                                <label class="form-label">Profession</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->text('Applicantincomes.monthly_income', ['value' => $applicant['applicantincomes'][0]['monthly_income'], 'class' => 'form-control', 'label' => false, 'required']); ?>
                                                <label class="form-label">Monthly Income</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php
                                                if (isset($applicant['applicant_household_details'][0]['dependent_family_members'])) {
                                                    $household = $applicant['applicant_household_details'][0]['dependent_family_members'];
                                                } else {
                                                    $household = '';
                                                }
                                                echo $this->Form->text('ApplicantHouseholdDetails.dependent_family_members', ['value' => $household, 'class' => 'form-control', 'label' => false, 'pattern' => '[0-9]+', 'required']);
                                                ?>
                                                <label class="form-label">Number of family members</label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    if ($fund_details_results[0]['sub_cat'] == 4) {
                                        ?>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->control('Applicants.disease', ['label' => false, 'class' => 'form-control', 'required']);
                                                ?> 
                                                <label class="form-label">Disease<span class="required">*</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line1">
                                                <h4>Disease & hospitalization Details</h4>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->control('Applicants.dname', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                                <label class="form-label">Doctor Name <span class="required">*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->control('Applicants.clinic_address', ['label' => false, 'class' => 'form-control', 'required']);
                                                ?>   
                                                <label class="form-label">Address of Hospital/clinic <span class="required">*</span></label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->control('Applicants.dcontact', ['label' => false, 'class' => 'form-control', 'required']);
                                                ?>   
                                                <label class="form-label">Contact Number <span class="required">*</span></label>

                                            </div>
                                        </div>  
                                        <?php
                                    }
                                }
                                ?>
                                <br/>
                                <div class="form-group">
                                    <div class="form-line1">
                                        <h4>Contact Info</h4>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicantaddresses.current_address', ['value' => $applicant['applicantaddresses'][0]['current_address'], 'class' => 'form-control', 'label' => false, 'required']); ?>
                                        <label class="form-label">Current Address</label>
                                    </div>                                  
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicantaddresses.permenent_address', ['value' => $applicant['applicantaddresses'][0]['permenent_address'], 'class' => 'form-control', 'label' => false, 'required']); ?>
                                        <label class="form-label">Permanent Address</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicantaddresses.postal_address', ['value' => $applicant['applicantaddresses'][0]['postal_address'], 'class' => 'form-control', 'label' => false, 'required']); ?>
                                        <label class="form-label">Postal Code</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">

                                    <div class="form-line">
                                        <?php echo $this->Form->control('Applicantaddresses.city_id', ['value' => $city1['id'], 'empty' => 'Select District', 'options' => $city, 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>

                                    </div>

                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicantcontacts.mob_number', ['value' => $applicant['applicantcontacts'][0]['mob_number'], 'class' => 'form-control', 'label' => false, 'required']); ?>
                                        <label class="form-label">Mobile Number</label>
                                    </div>
                                </div>   
                                <?php if ($fund_details_results[0]['sub_cat'] == 3) { ?>                             
                                    <div id="show"> 
                                        <br/>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line1">
                                                        <h4>Qualification Info</h4>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <?php
//                                        debug($applicant->qualifications[0]);
                                                        if (isset($applicant->qualifications[0]->qualification_level_id)) {
                                                            $qualificationlev = $applicant->qualifications[0]->qualification_level_id;
                                                        } else {
                                                            $qualificationlev = '';
                                                        }
                                                        ?>
                                                        <?php echo $this->Form->control('Qualifications.qualification_level_id', ['id' => 'qualification_level', 'options' => $qualificationLevels, 'class' => 'form-control show-tick', 'value' => $qualificationlev, 'label' => false]); ?>
                                                    </div>
                                                </div>
                                                <div class="demo-radio-button">
                                                    <label class="form-label">Education System</label>
                                                    <?php
                                                    echo $this->Form->control('Qualifications.education_system', ['label' => false, 'type' => 'radio', 'options' => ['annual' => 'Annual', 'semester' => 'Semester', 'term' => 'Term'], 'value' => $applicant->qualifications[0]->education_system, 'escape' => false, 'templates' => [
                                                            'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                                                            'radioWrapper' => '{{label}}'
                                                        ], 'required']);
                                                    ?>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <?php echo $this->Form->text('Qualifications.recent_class', ['id' => 'recent_class', 'value' => $applicant->qualifications[0]->recent_class, 'class' => 'form-control', 'label' => false, 'required']); ?>
                                                        <label class="form-label">Recent Class</label>
                                                    </div>                                  
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <?php
                                                        echo $this->Form->control('Qualifications.passing_date', ['id' => 'passing_date', 'label' => false, 'class' => 'form-control', 'value' => date('Y-m-d', strtotime($applicant->qualifications[0]->passing_date)), 'required']);
                                                        ?>
                                                        <label class="form-label">Date of completion (YYYY-MM-DD)</label>
                                                    </div>                                  
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <?php echo $this->Form->text('Qualifications.current_class', ['id' => 'current_class', 'value' => $applicant->qualifications[0]->current_class, 'class' => 'form-control', 'label' => false, 'required']); ?>
                                                        <label class="form-label">Current class</label>
                                                    </div>                                  
                                                </div>
                                                <div class="demo-radio-button">
                                                    <label class="form-label">Grading System</label>
                                                    <?php
                                                    echo $this->Form->control('Qualifications.grading_system', ['id' => 'grading_system', 'type' => 'radio', 'class' => 'uniform', 'options' => ['cgpa' => 'CGPA', 'marks' => 'Marks'], 'value' => $applicant->qualifications[0]->grading_system, 'label' => false,
                                                        'templates' => [
                                                            'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                                                            'radioWrapper' => '{{label}}'
                                                        ], 'required']);
                                                    ?>
                                                </div>

                                                <div id="cgpa_fields" style="display:none;">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.total_cgpa', ['id' => 'total_cgpa', 'class' => 'form-control show-tick', 'empty' => 'Select Total CGPA', 'options' => ['4' => '4', '5' => '5'], 'value' => $applicant->qualifications[0]->total_cgpa, 'label' => false]);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.obtained_cgpa', ['id' => 'obtained_cgpa', 'value' => $applicant->qualifications[0]->obtained_cgpa, 'type' => 'text', 'class' => 'form-control', 'label' => false]);
                                                            ?> 
                                                            <label class="form-label">Obtained CGPA</label>
                                                        </div>
                                                        <span id="obtained_cgpa_error"></span>
                                                    </div>
                                                </div>
                                                <div id="marks_fields">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.total_marks', ['id' => 'total_marks', 'type' => 'text', 'class' => 'form-control', 'value' => $applicant->qualifications[0]->total_marks, 'label' => false, 'required']);
                                                            ?>
                                                            <label class="form-label">Total Marks</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.obtained_marks', ['id' => 'obtained_marks', 'value' => $applicant->qualifications[0]->obtained_marks, 'type' => 'text', 'class' => 'form-control', 'label' => false, 'required']);
                                                            ?>
                                                            <label class="form-label">Obtained Marks</label>
                                                        </div>
                                                        <span id="obtained_marks_error"></span>
                                                    </div>
                                                </div>
                                                <div id="percentage_div" style="display: none;">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.percentage', ['id' => 'percentage', 'class' => 'form-control', 'type' => 'text', 'data-mask' => '99.99', 'value' => $applicant->qualifications[0]->percentage, 'label' => false]);
                                                            ?>
                                                            <label class="form-label">Percentage</label>
                                                        </div>
                                                        <span id="percentage_error"></span>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line1">
                                                        <h4  class="custom_head">Institute Details</h4>
                                                    </div>
                                                </div>

                                                <div id="school_fields">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php
                                                            $this->Form->unlockField('Institutes.city_id');
                                                            echo $this->Form->control('Institutes.city_id', ['id' => 'city_dropdown', 'secure' => false, 'empty' => 'Select City', 'label' => false, 'class' => 'form-control', 'options' => $city, 'value' => @$applicant->qualifications[0]->institute->city_id, 'required']);
                                                            ?>
                                                        </div>
                                                    </div>


                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php echo $this->Form->control('Qualifications.degree_awarding_id', ['id' => 'degree_awarding_id', 'label' => false, 'class' => 'form-control', 'empty' => 'Select Board', 'options' => $degreeAwardings, 'value' => @$applicant->qualifications[0]->degree_awarding_id, 'required']);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php echo $this->Form->control('Institutes.name', ['id' => 'institue_name', 'label' => false, 'class' => 'form-control', 'value' => @$applicant->qualifications[0]->institute->name, 'required']);
                                                            ?>
                                                            <label class="form-label">School/College<span class="required"> *</span></label>
                                                        </div>
                                                    </div>


                                                    <div class="demo-radio-button">
                                                        <label class="form-label">Institute Sector</label>
                                                        <?php
                                                        echo $this->Form->control('Institutes.institute_sector', ['type' => 'radio', 'options' => ['pri' => 'Private', 'pub' => 'Public'], 'value' => @$applicant->qualifications[0]->institute->institute_sector, 'label' => false,
                                                            'templates' => [
                                                                'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                                                                'radioWrapper' => '{{label}}'
                                                            ], 'required']);
                                                        ?>
                                                    </div>

                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php
                                                            echo $this->Form->control('Qualifications.discipline_id', ['id' => 'discipline', 'label' => false, 'class' => 'form-control', 'empty' => 'Select Discipline', 'options' => $disciplines, 'value' => @$applicant->qualifications[0]->discipline_id, 'required']);
                                                            ?>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="university_fields" style="display: none">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php echo $this->Form->control('Qualifications.institute_id', ['id' => 'institute_id', 'label' => false, 'class' => 'form-control', 'empty' => 'Select University', 'options' => $institutes, 'value' => @$applicant->qualifications[0]->institute_id]);
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <?php
//                                            debug($applicant->qualifications[0]->discipline->discipline);
                                                            echo $this->Form->control('Disciplines.discipline', ['id' => 'discipline_field', 'type' => 'text', 'label' => false, 'class' => 'form-control', 'required', 'value' => @$applicant->qualifications[0]->discipline->discipline]);
                                                            ?>
                                                            <label class="form-label">Discipline</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <button class="btn btn-success waves-effect" type="submit" id="submit">SUBMIT</button>
                                <?= $this->Form->end() ?>   
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Validation -->


</div>
</section>
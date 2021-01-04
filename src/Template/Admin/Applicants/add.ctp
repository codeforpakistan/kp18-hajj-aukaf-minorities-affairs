<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>js/ajax.js"></script>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Applicants
            </h2>
        </div>

        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Add Applicants</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href='<?= $this->request->webroot . 'admin/Applicants'; ?>'>View Applicants</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="body">
                        <?= $this->Form->create($applicant, ['type' => 'file']) ?>



                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicants.name', ['class' => 'form-control', 'pattern' => '[[A-Za-z\s]+', 'id' => 'name12', 'required']); ?>
                                <label class="form-label">Applicants Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicants.father_or_husband_name', ['class' => 'form-control', 'pattern' => '[[A-Za-z\s]+', 'required']); ?>
                                <label class="form-label">Father Name OR Husband Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">

                            <div class="form-line">
                                <?php echo $this->Form->control('Applicants.religion_id', ['empty' => 'Select Religion', 'options' => $religions, 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>

                            </div>
                        </div>



                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicants.cnic', ['class' => 'form-control', 'required', 'pattern' => '^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$']); ?>
                                <label class="form-label">CNIC</label>
                            </div>
                        </div>

                        <div class="demo-radio-button">
                            <label class="form-label">Gender</label>
                            <?php
                            echo $this->Form->control('Applicants.gender', ['label' => false, 'type' => 'radio', 'label' => false, 'escape' => false, 'options' => array('male' => '&nbsp;Male', 'female' => '&nbsp;Female'), 'templates' => [
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
                        <div id="groom">
                            <div class="form-group form-float" >
                                <div class="form-line">
                                    <?php echo $this->Form->text('Applicants.groom_or_bride_name', ['class' => 'form-control', 'id' => 'groom_name']); ?>
                                    <label class="form-label">Groom or Bride Name</label>
                                </div>

                            </div>
                        </div>
                        <div class="form-group form-float">

                            <div class="form-line">
                                <?php echo $this->Form->control('ApplicantFunddetails.fund_id', ['empty' => 'Select Funds', 'class' => 'form-control show-tick show sub_categ', 'id' => 'funds', 'label' => false, 'required', 'options' => $funds]); ?>

                            </div>


                        </div>

                        <!--                                <div class="form-group form-float">
                                                           
                                                            <div class="form-line">
                        <?php //echo $this->Form->control('Applies.fund_category_id', ['empty' => 'Select Fund Cateogry','class'=>'form-control show-tick','id'=>'fund_categ','label'=>false,'required']); ?>
                                                               
                                                            </div>
                                                            
                                                        </div>
                                                       
                                                        <div class="form-group form-float">
                                                           
                                                            <div class="form-line">
                        <?php //echo $this->Form->control('Applies.sub_category_id', ['empty' => 'Select Fund Sub Cateogry','class'=>'form-control show-tick show sub_categ','id'=>'sub_categ','label'=>false,'required']); ?>
                                                        
                                                            </div>
                                                            
                                                            
                                                        </div>-->


                        <div class="form-group">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicantaddresses.current_address', ['class' => 'form-control', 'label' => false, 'required']); ?>
                                <label class="form-label">Current Address</label>
                            </div>

                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicantaddresses.permenent_address', ['class' => 'form-control', 'label' => false, 'required']); ?>
                                <label class="form-label">Permanent Address</label>
                            </div>
                        </div>
                        <div class="form-group form-float">

                            <div class="form-line">
                                <?php echo $this->Form->control('Applicantaddresses.city_id', ['empty' => 'Select District', 'options' => $city, 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>

                            </div>

                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicantaddresses.postal_address', ['class' => 'form-control', 'label' => false, 'required']); ?>
                                <label class="form-label">Postal Code</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicantaddresses.zip_code', ['class' => 'form-control', 'label' => false, 'required']); ?>
                                <label class="form-label">Zip Code</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicantcontacts.mob_number', ['class' => 'form-control', 'label' => false, 'required', 'pattern' => '03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}']); ?>
                                <label class="form-label">Mobile Number</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicantcontacts.tel_number', ['class' => 'form-control', 'label' => false, 'required']); ?>
                                <label class="form-label">Telephone Number</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicantincomes.monthly_income', ['class' => 'form-control', 'label' => false, 'required']); ?>
                                <label class="form-label">Monthly Income</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('Applicantprofessions.profession', ['class' => 'form-control', 'label' => false, 'required']); ?>
                                <label class="form-label">Profession</label>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form">
                                <label class="form-label">Attachment</label>
                                <?php echo $this->Form->control('ApplicantAttachments.attachments[]', ['class' => 'form-control', 'secure' => false, 'type' => 'file', 'multiple' => true, 'label' => false]); ?>

                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('ApplicantHouseholdDetails.dependent_family_members', ['class' => 'form-control', 'label' => false, 'pattern' => '[0-9]+', 'required']); ?>
                                <label class="form-label">Number of family members</label>
                            </div>
                        </div>


                        <div id="show"> 
                            <div class="form-group form-float">

                                <div class="form-line">
                                    <?php echo $this->Form->control('Qualifications.qualification_level_id', ['empty' => 'Select Qualification level', 'options' => $qualificationLevels, 'class' => 'form-control show-tick', 'id' => 'qual_level', 'label' => false]); ?>
                                </div>
                            </div>

                            <div class="form-group form-float">                                   
                                <div class="form-line">
                                    <?php echo $this->Form->control('Qualifications.discipline_id', ['empty' => 'Select Discipline', 'options' => $disciplines, 'class' => 'form-control show-tick', 'id' => 'dis_id', 'label' => false]); ?>
                                </div>
                            </div>

                            <div class="form-group form-float">

                                <div class="form-line">
                                    <?php echo $this->Form->control('Qualifications.institute_id', ['empty' => 'Select Institude', 'options' => $institutes, 'class' => 'form-control show-tick', 'id' => 'ins_id', 'label' => false]); ?>

                                </div>

                            </div>

                            <div class="form-group form-float">

                                <div class="form-line">
                                    <?php echo $this->Form->control('Qualifications.degree_awarding_id', ['empty' => 'Select Degree Awarding', 'options' => $degreeAwardings, 'class' => 'form-control show-tick', 'id' => 'deg_id', 'label' => false]); ?>

                                </div>

                            </div>
                            <div class="demo-radio-button">
                                <label class="form-label">Education System</label>
                                <?php
                                echo $this->Form->control('Qualifications.education_system', ['label' => false, 'type' => 'radio', 'label' => false, 'escape' => false, 'options' => array('annual' => '&nbsp;Annual', 'semester' => '&nbsp;Semester', 'term' => '&nbsp;Term'), 'templates' => [
                                        'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                                        'radioWrapper' => '{{label}}'
                                ]]);
                                ?>


                            </div>
                            <div class="demo-radio-button">
                                <label class="form-label">Grading System</label>
                                <?php
                                echo $this->Form->control('Qualifications.grading_system', ['label' => false, 'type' => 'radio', 'label' => false, 'escape' => false, 'options' => array('cgpa' => '&nbsp;CGPA', 'marks' => '&nbsp;Marks'), 'templates' => [
                                        'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                                        'radioWrapper' => '{{label}}'
                                ]]);
                                ?>


                            </div>


                            <div id="marks">
                                <span id="obtain1"><span>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->text('Qualifications.total_marks', ['class' => 'form-control', 'id' => 'total_marks', 'label' => false]); ?>
                                                <label class="form-label">total Marks</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?php echo $this->Form->text('Qualifications.obtained_marks', ['class' => 'form-control', 'id' => 'obtain_marks', 'label' => false]); ?>
                                                <label class="form-label">Obtained Marks</label>
                                            </div>
                                        </div>

                                        </div>
                                        <div id="cgpa">   
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <?php echo $this->Form->text('Qualifications.total_cgpa', ['class' => 'form-control', 'id' => 'total_cgpa', 'label' => false]); ?>
                                                    <label class="form-label">Total CGPA</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <?php echo $this->Form->text('Qualifications.obtained_cgpa', ['class' => 'form-control', 'id' => 'obtain_cgpa', 'label' => false]); ?>
                                                    <label class="form-label">Obtained CGPA</label>

                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <?php echo $this->Form->text('Qualifications.percentage', ['class' => 'form-control', 'id' => 'percent', 'label' => false]); ?>
                                                    <label class="form-label">Percentage</label>
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                        <button class="btn btn-primary waves-effect" type="submit" id="submit">SUBMIT</button>
                                        <?= $this->Form->end() ?>   
                                        </div>

                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        <!-- #END# Basic Validation -->


                                        </div>
                                        </section>
                                        <script>
                                            $("#submit").focus(function () {
                                                var value = $('#obtain_marks').val();
                                                var value1 = $('#total_marks').val();
                                                var value2 = Math.round((value * 100) / value1);
                                                if (value2)
                                                {
                                                    $('#obtain').html(value2);
                                                    $('#percent').val(value2);
                                                }

                                                // alert(value);
                                                //alert( "Handler for .focus() called." );

                                            });
                                            $(document).ready(function () {

                                                $('#applicants-gender-male').attr('checked', true);

                                                $('#qualifications-grading-system-cgpa').attr('checked', true);
                                                $('#qualifications-education-system-annual').attr('checked', true);

                                                $('#show').hide();

                                                $('#groom').hide();
                                                // alert($('#groom_name').val(''));
                                                //$('#cgpa').hide();
                                                $('#marks').hide();
                                                $('#').hide();

                                                $('#fund_categ').change(function () {
                                                    var value = $('#sub_categ').val();
                                                    value = "";
                                                    //alert(value);
                                                    //alert(value="");
                                                    $('#qual_level').attr('required', false);

                                                    $('#dis_id').attr('required', false);
                                                    $('#ins_id').attr('required', false);
                                                    $('#deg_id').attr('required', false);
                                                    $('#total_cgpa').attr('required', false);
                                                    $('#obtain_cgpa').attr('required', false);
                                                    $('#perc').attr('required', false);
                                                    $('#total_marks').attr('required', false);
                                                    $('#obtain_marks').attr('required', false);
                                                    $('#groom_name').attr('required', false);

                                                    if (value == "3")
                                                    {
                                                        $('#show').show();



                                                    } else {
                                                        $('#show').hide();

                                                    }
                                                    if (value == "2")
                                                    {
                                                        alert(value);
                                                        $('#groom').show();

                                                    } else {
                                                        $('#groom').hide();


                                                    }
                                                });

                                                $('#sub_categ').change(function () {
                                                    var value = $(this).val();
                                                    alert();
                                                    $('#groom_name').val('');
                                                    $('#qual_level').val('');
                                                    $('#dis_id').val('');
                                                    $('#ins_id').val('');
                                                    $('#deg_id').val('');
                                                    $('#total_cgpa').val('');
                                                    $('#obtain_cgpa').val('');
                                                    $('#perc').val('');
                                                    $('#total_marks').val('');
                                                    $('#obtain_marks').val('');
                                                    //alert(value);
                                                    $('#qual_level').attr('required', false);

                                                    $('#dis_id').attr('required', false);
                                                    $('#ins_id').attr('required', false);
                                                    $('#deg_id').attr('required', false);
                                                    $('#total_cgpa').attr('required', false);
                                                    $('#obtain_cgpa').attr('required', false);
                                                    $('#perc').attr('required', false);
                                                    $('#total_marks').attr('required', false);
                                                    $('#obtain_marks').attr('required', false);
                                                    if (value == "3")
                                                    {
                                                        $('#show').show();
                                                        $('#qual_level').attr('required', true);

                                                        $('#dis_id').attr('required', true);
                                                        $('#ins_id').attr('required', true);
                                                        $('#deg_id').attr('required', true);
                                                        $('#total_cgpa').attr('required', true);
                                                        $('#obtain_cgpa').attr('required', true);
                                                        $('#perc').attr('required', true);



                                                    } else {
                                                        $('#show').hide();
                                                        $('#qual_level').attr('required', false);
                                                        $('#dis_id').attr('required', false);
                                                        $('#ins_id').attr('required', false);
                                                        $('#deg_id').attr('required', false);
                                                        $('#total_cgpa').attr('required', false);
                                                        $('#obtain_cgpa').attr('required', false);
                                                        $('#perc').attr('required', false);

                                                    }




                                                });
                                                $('#qualifications-grading-system-cgpa').change(function () {
                                                    var value = $(this).val();
                                                    //alert(value);
                                                    $('#total_marks').val('');
                                                    $('#obtain_marks').val('');
                                                    if (value == "cgpa")
                                                    {
                                                        $('#cgpa').show();
                                                        $('#marks').hide();
                                                        $('#total_cgpa').attr('required', true);
                                                        $('#obtain_cgpa').attr('required', true);
                                                        $('#perc').attr('required', true);
                                                        $('#total_marks').attr('required', false);
                                                        $('#obtain_marks').attr('required', false);

                                                    } else {
                                                        $('#cgpa').hide();
                                                        $('#total_cgpa').attr('required', false);
                                                        $('#obtain_cgpa').attr('required', false);
                                                        $('#perc').attr('required', false);
                                                    }

                                                });

                                                $('#qualifications-grading-system-marks').click(function () {
                                                    var value = $(this).val();
                                                    $('#total_cgpa').val('');
                                                    $('#obtain_cgpa').val('');
                                                    $('#perc').val('');


                                                    //alert(value);
                                                    if (value == "marks")
                                                    {
                                                        $('#marks').show();
                                                        $('#cgpa').hide();
                                                        $('#total_cgpa').attr('required', false);
                                                        $('#obtain_cgpa').attr('required', false);
                                                        $('#perc').attr('required', false);
                                                        $('#total_marks').attr('required', true);
                                                        $('#obtain_marks').attr('required', true);

                                                    } else {
                                                        $('#marks').hide();
                                                        $('#total_marks').attr('required', false);
                                                        $('#obtain_marks').attr('required', false);

                                                    }

                                                });

                                                $('#sub_categ').change(function () {
                                                    var value = $(this).val();
                                                    //var groom;
                                                    $('#groom_name').attr('required', false);
                                                    $('#groom_name').val('');

                                                    //alert(groom);
                                                    if (value == "2")
                                                    {
                                                        $('#groom').show();
                                                        $('#groom_name').attr('required', true);



                                                    } else {
                                                        $('#groom').hide();
                                                        $('#groom_name').attr('required', false);
                                                        //alert('#groom_name').val() == '');
                                                    }
                                                });




                                            });




                                        </script>
                                        <script>
                                            $(document).ready(function () {
                                                $('#funds').change(function () {
                                                    var value = $(this).val();
                                                    // alert(value);
                                                    //return false;


                                                    if (value != "")
                                                    {
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: 'subcategory',
                                                            data: 'value=' + value,
                                                            contentType: 'json',
                                                            success: function (data)
                                                            {
                                                                //  alert( JSON.parse(data));

                                                                var data = JSON.parse(data);
                                                                //s alert(data);

                                                                if ($.isEmptyObject(data))
                                                                {

                                                                    $('#sub_categ').empty();
                                                                    $('#fund_categ').empty();


                                                                } else
                                                                {

                                                                    $('#sub_categ').empty();
                                                                    $('#fund_categ').empty();

                                                                    $.each(data, function (key, value) {

                                                                        var value1 = value.sub_category_id;
                                                                        //alert(value1);
                                                                        $('#groom_name').val('');
                                                                        $('#qual_level').val('');
                                                                        $('#dis_id').val('');
                                                                        $('#ins_id').val('');
                                                                        $('#deg_id').val('');
                                                                        $('#total_cgpa').val('');
                                                                        $('#obtain_cgpa').val('');
                                                                        $('#perc').val('');
                                                                        $('#total_marks').val('');
                                                                        $('#obtain_marks').val('');
                                                                        //alert(value);
                                                                        $('#qual_level').attr('required', false);

                                                                        $('#dis_id').attr('required', false);
                                                                        $('#ins_id').attr('required', false);
                                                                        $('#deg_id').attr('required', false);
                                                                        $('#total_cgpa').attr('required', false);
                                                                        $('#obtain_cgpa').attr('required', false);
                                                                        $('#perc').attr('required', false);
                                                                        $('#total_marks').attr('required', false);
                                                                        $('#obtain_marks').attr('required', false);
                                                                        if (value1 == "3")
                                                                        {
                                                                            $('#show').show();
                                                                            $('#qual_level').attr('required', true);

                                                                            $('#dis_id').attr('required', true);
                                                                            $('#ins_id').attr('required', true);
                                                                            $('#deg_id').attr('required', true);
                                                                            $('#total_cgpa').attr('required', true);
                                                                            $('#obtain_cgpa').attr('required', true);
                                                                            $('#perc').attr('required', true);



                                                                        } else {
                                                                            $('#show').hide();
                                                                            $('#qual_level').attr('required', false);
                                                                            $('#dis_id').attr('required', false);
                                                                            $('#ins_id').attr('required', false);
                                                                            $('#deg_id').attr('required', false);
                                                                            $('#total_cgpa').attr('required', false);
                                                                            $('#obtain_cgpa').attr('required', false);
                                                                            $('#perc').attr('required', false);

                                                                        }
                                                                        $('#groom_name').attr('required', false);
                                                                        $('#groom_name').val('');

                                                                        //alert(groom);
                                                                        if (value1 == "2")
                                                                        {
                                                                            $('#groom').show();
                                                                            $('#groom_name').attr('required', true);



                                                                        } else {
                                                                            $('#groom').hide();
                                                                            $('#groom_name').attr('required', false);
                                                                            //alert('#groom_name').val() == '');
                                                                        }



                                                                        //var Option ="<option value='"+value.sub_category_id+"'>"+value.sub_category_id+" </option>";


                                                                        $('#sub').val(value.sub_category_id);


                                                                        //alert(Option);
                                                                        // var value1 = $('#sub_categ').val();
                                                                        ///lert(value1+'sub_categ');


                                                                        //$('#sub_categ').append(Option);
                                                                        //alert($('#sub_categ').val('h'));  
                                                                        //alert('sub_categ='+s.val());
                                                                    });
                                                                    $.each(data, function (key, value) {



                                                                        var Option = "<option value='" + value.fund_category_id + "'>" + value.fund_category_id + " </option>";





                                                                        //				/alert(Option);
                                                                        // var value1 = $('#sub_categ').val();
                                                                        ///lert(value1+'sub_categ');


                                                                        $('#fund_categ').append(Option);
                                                                        //alert($('#sub_categ').val('h'));  
                                                                        //alert('sub_categ='+s.val());
                                                                    });




                                                                }
                                                            }, error: function (error) {
                                                                // alert(JSON.stringify(error));
                                                            }


                                                        });
                                                    } else
                                                    {
                                                        $('#sub_categ').empty();
                                                        $('#sub_categ').append("<option value=''>--Select--</option>");
                                                        //alert(value);
                                                    }

                                                });

                                            });

                                        </script>

<style>
    .form-line1{
        background-color: #eee6;
        padding: 1px 5px;
        border: 1px solid #eee;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
  
  <script type="text/javascript" src="<?php echo $this->request->webroot ;?>js/ajax.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>

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
                            <h2>Edit Applicants</h2>
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
                                <div class="form-group">
                                    <div class="form-line1">
                                        <h4>Personal Info</h4>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                       <?php echo $this->Form->text('Applicants.cnic',['class'=>'form-control','required','pattern'=>'^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$']);?>
                                        <label class="form-label">CNIC</label>
                                    </div>
                                </div>
<!--                            <div class="form-group form-float">
                                    <div class="form-line">
                                       <?php // echo $this->Form->control('ApplicantFunddetails.fund_id', ['options' => $fund,'class'=>'form-control show-tick show sub_categ','value'=>$applicant['applicant_funddetails'][0]['fund_id'],'id'=>'funds','label'=>false,'required']);?>
                                    </div>                                    
                             </div>-->
                            
                                <div class="form-group form-float">
                                    <div class="form-line">
                                       <?php echo $this->Form->text('Applicants.name',['class'=>'form-control','pattern'=>'[[A-Za-z\s]+','id'=>'name12','required']);?>
                                       <label class="form-label">Applicants Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                       <?php echo $this->Form->text('Applicants.father_name',['class'=>'form-control','pattern'=>'[[A-Za-z\s]+','required']);?>
                                        <label class="form-label">Father Name</label>
                                    </div>
                                </div>
                               <div class="form-group form-float">
                                   
                                    <div class="form-line">
                                        <?php echo $this->Form->control('Applicants.religion_id', ['empty' => 'Select Religion', 'options' => $religions,'class'=>'form-control show-tick','label'=>false,'required']);?>
                                       
                                    </div>
                                </div>
                                
                               
                            <div class="demo-radio-button">
                                <label class="form-label">Gender</label>
                                <?php
                                echo $this->Form->control('Applicants.gender', ['label' => false, 'type' => 'radio', 'label' => false, 'value' => $applicant['gender'], 'escape' => false, 'options' => array('male' => '&nbsp;Male', 'female' => '&nbsp;Female'), 'templates' => [
                                        'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                                        'radioWrapper' => '{{label}}'
                                ]]);
                                ?>
                            </div>
                            <div class="form-group form-float">
                                   <?php  ?>
                                   <div class="form-line">
                                        <?php echo $this->Form->control('Applicants.maritalstatus_id', ['empty' => 'Select Marital Status', 'options' => $maritalstatus ,'class'=>'form-control show-tick','label'=>false,'required']);?>
                                    </div>                                    
                                </div>
                            <?php
                            if($fund_details_results[0]['sub_cat']!=3){
                            ?>
                               <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php                                        
                                        echo $this->Form->text('Applicantprofessions.profession',['value'=> $applicant['applicantprofessions'][0]['profession'],'class'=>'form-control','label'=>false,'required']);?>
                                        <label class="form-label">Profession</label>
                                    </div>
                                </div>
                             <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicantincomes.monthly_income',['value'=>$applicant['applicantincomes'][0]['monthly_income'],'class'=>'form-control','label'=>false,'required']);?>
                                        <label class="form-label">Monthly Income</label>
                                    </div>
                                </div>
                             <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php
                                         
                                         if(isset($applicant['applicant_household_details'][0]['dependent_family_members']))
                                        {
                                           $household=$applicant['applicant_household_details'][0]['dependent_family_members']; 
                                        }
                                        else{
                                          $household='';  
                                        }
                                        echo $this->Form->text('ApplicantHouseholdDetails.dependent_family_members',['value'=>$household,'class'=>'form-control','label'=>false,'pattern'=>'[0-9]+','required']);?>
                                        <label class="form-label">Number of family members</label>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($applicant->applicant_attachments)){ ?>
                            <div class="form-group">
                                    <div class="form">
                                        <p>Existing Image/Images</p>
                                        <?php foreach ($applicant->applicant_attachments as $each_img): ?>                                        
                                        <img src="<?php echo $this->request->webroot.'img/applicants/'.$each_img->attachments;?>" width="100"> 
                                         <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php }?>
                            <div class="form-group form-float">
                                    <div class="form">
                                        <label class="form-label">Attachment</label>
                                      <?php echo $this->Form->control('ApplicantAttachments.attachments[]', ['secure' => false, 'type' => 'file', 'multiple' => true,'label'=>false]);?>
                                        
                                    </div>
                                </div>
                             <br/>
                            <div class="form-group">
                                
                                    <div class="form-line1">
                                        <h4>Contact Info</h4>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                   <div class="form-line">
                                       <?php echo $this->Form->text('Applicantaddresses.current_address',['value'=>$applicant['applicantaddresses'][0]['current_address'],'class'=>'form-control','label'=>false,'required']);?>
                                        <label class="form-label">Current Address</label>
                                    </div>                                  
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicantaddresses.permenent_address',['value'=>$applicant['applicantaddresses'][0]['permenent_address'],'class'=>'form-control','label'=>false,'required']);?>
                                        <label class="form-label">Permanent Address</label>
                                    </div>
                                </div>
                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicantaddresses.postal_address',['value'=>$applicant['applicantaddresses'][0]['postal_address'],'class'=>'form-control','label'=>false,'required']);?>
                                        <label class="form-label">Postal Code</label>
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                   
                                    <div class="form-line">
                                        <?php echo $this->Form->control('Applicantaddresses.city_id', ['value'=>$city1['id'],'empty' => 'Select District', 'options' => $city,'class'=>'form-control show-tick','label'=>false,'required']);?>
                                       
                                    </div>
                                    
                                </div>
                               
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('Applicantcontacts.mob_number',['value'=>$applicant['applicantcontacts'][0]['mob_number'],'class'=>'form-control','label'=>false,'required']);?>
                                        <label class="form-label">Mobile Number</label>
                                    </div>
                                </div>   
                            <?php 
                            if($fund_details_results[0]['sub_cat']==3){?>                             
                             <div id="show"> 
                                <br/>
                                <div class="form-group form-float">
                                    <div class="form-line1">
                                        <h4>Qualification Info</h4>
                                    </div>
                                </div>
                               <div class="form-group form-float">
                                   
                                    <div class="form-line">
                                        <?php 
                                        if(isset($qualifications[0]['qualification_level']['id']))
                                        {
                                           $qualificationlev=$qualifications[0]['qualification_level']['id']; 
                                        }
                                        else{
                                          $qualificationlev='';  
                                        }
                                       // echo $qualificationlev;?>
                                        <?php echo $this->Form->control('Qualifications.qualification_level_id', [ 'options' => $qualificationLevels,'class'=>'form-control show-tick','value'=> $qualificationlev,'label'=>false]);?>
                                       
                                    </div>
                                    
                                </div>
                               
                               <div class="form-group form-float">
                                   
                                    <div class="form-line">
                                         <?php 
                                        if(isset($qualifications[0]['discipline']['id']))
                                        {
                                           $disciplne=$qualifications[0]['discipline']['id']; 
                                        }
                                        else{
                                          $disciplne='';  
                                        }
                                       // echo $qualificationlev;?>
                                        <?php echo $this->Form->control('Qualifications.discipline_id', ['value'=>$disciplne,'empty' => 'Select Discipline', 'options' => $disciplines,'class'=>'form-control show-tick','label'=>false]);?>
                                       
                                    </div>
                                    
                                </div>
                               
                               <div class="form-group form-float">
                                   
                                    <div class="form-line">
                                         <?php 
                                        if(isset($qualifications[0]['institute']['id']))
                                        {
                                           $institute=$qualifications[0]['institute']['id']; 
                                        }
                                        else{
                                          $institute='';  
                                        }
                                       // echo $qualificationlev;?>
                                        <?php echo $this->Form->control('Qualifications.institute_id', ['value'=>$institute,'empty' => 'Select Institude', 'options' => $institutes,'class'=>'form-control show-tick','label'=>false]);?>
                                       
                                    </div>
                                    
                                </div>
                                
                               <div class="form-group form-float">
                                   
                                    <div class="form-line">
                                          <?php 
                                        if(isset($qualifications[0]['degree_awarding']['id']))
                                        {
                                           $degree=$qualifications[0]['degree_awarding']['id']; 
                                        }
                                        else{
                                          $degree='';  
                                        }
                                       // echo $qualificationlev;?>
                                        <?php echo $this->Form->control('Qualifications.degree_awarding_id', ['value'=>$degree,'empty' => 'Select Degree Awarding', 'options' => $degreeAwardings,'class'=>'form-control show-tick','label'=>false]);?>
                                       
                                    </div>
                                    
                                </div>
                             <div class="demo-radio-button">
                                                <label class="form-label">Education System</label>
                                                <?php 
                                        if(isset($qualifications[0]['education_system']))
                                        {
                                           $educat=$qualifications[0]['education_system']; 
                                        }
                                        else{
                                          $educat='';  
                                        }?>
                                                <?php echo $this->Form->control('Qualifications.education_system', ['value'=>$educat,'label' => false, 'type' => 'radio', 'label' => false, 'escape' => false, 'options' => array('annual' => '&nbsp;Annual', 'semester' => '&nbsp;Semester', 'term' => '&nbsp;Term'), 'templates' => [
                               'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                               'radioWrapper' => '{{label}}'
                       ]]); ?>
                                   
                                
                            </div>
                              <div class="demo-radio-button">
                                                <label class="form-label">Grading System</label>
                                                <?php 
                                        if(isset($qualifications[0]['grading_system']))
                                        {
                                           $grad=$qualifications[0]['grading_system']; 
                                        }
                                        else{
                                          $grad='';  
                                        }?>
                                        <input type="hidden" id="grad" value="<?php echo  $grad;?>"/>
                                                <?php echo $this->Form->control('Qualifications.grading_system', ['value'=>$grad,'label' => false, 'type' => 'radio', 'label' => false, 'escape' => false, 'options' => array('cgpa' => '&nbsp;CGPA', 'marks' => '&nbsp;Marks'), 'templates' => [
                               'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                               'radioWrapper' => '{{label}}'
                       ]]); ?>
                                   
                                
                            </div>
                                
                                
                                <div id="marks">
                                     
                               <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php 
                                        if(isset($qualifications[0]['total_marks']))
                                        {
                                           $tmarks=$qualifications[0]['total_marks']; 
                                        }
                                        else{
                                          $tmarks='';  
                                        }
                                       // echo $qualificationlev;?>
                                        <?php echo $this->Form->text('Qualifications.total_marks',['value'=>$tmarks,'class'=>'form-control','id'=>'total_m','label'=>false]);?>
                                        <label class="form-label">total Marks</label>
                                    </div>
                                </div>
                               <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php 
                                        if(isset($qualifications[0]['obtained_marks']))
                                        {
                                           $omarks=$qualifications[0]['obtained_marks']; 
                                        }
                                        else{
                                          $omarks='';  
                                        }
                                       // echo $qualificationlev;?>
                                        <?php echo $this->Form->text('Qualifications.obtained_marks',['value'=>$omarks,'class'=>'form-control','id'=>'obtain_m','label'=>false]);?>
                                        <label class="form-label">Obtained Marks</label>
                                        
                                    </div>
                                </div>
                              
                            </div>
                                 <div id="cgpa">   
                                <div class="form-group form-float">
                                    <div class="form-line">
                                         <?php 
                                        if(isset($qualifications[0]['total_cgpa']))
                                        {
                                           $tcgpa=$qualifications[0]['total_cgpa']; 
                                        }
                                        else{
                                          $tcgpa='';  
                                        }
                                       // echo $qualificationlev;?>
                                        <?php echo $this->Form->text('Qualifications.total_cgpa',['value'=>$tcgpa,'class'=>'form-control','label'=>false]);?>
                                        <label class="form-label">Total CGPA</label>
                                    </div>
                                </div>
                               <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php 
                                        if(isset($qualifications[0]['obtained_cgpa']))
                                        {
                                           $ocgpa=$qualifications[0]['obtained_cgpa']; 
                                        }
                                        else{
                                          $ocgpa='';  
                                        }
                                       // echo $qualificationlev;?>
                                        <?php echo $this->Form->text('Qualifications.obtained_cgpa',['value'=>$ocgpa,'class'=>'form-control','label'=>false]);?>
                                        <label class="form-label">Obtained CGPA</label>
                                        
                                    </div>
                                </div>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php 
                                        if(isset($qualifications[0]['percentage'])&& $qualifications[0]['grading_system']=='cgpa')
                                        {
                                           $per=$qualifications[0]['percentage']; 
                                        }
                                        else{
                                          $per='';  
                                        }
                                       // echo $qualificationlev;?>
                                        <?php echo $this->Form->text('Qualifications.percentage',['value'=>$per,'class'=>'form-control','id'=>'percent','label'=>false]);?>
                                        
                                        <label class="form-label">Percentage</label>
                                    </div>
                                </div>
                                     
                                 </div>
                                
                            </div>
<?php } ?>
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
     $( "#submit" ).focus(function() {
         var value = $('#obtain_m').val();
         //alert(value);
         var    value1 = $('#total_m').val();
         var value2=Math.round((value*100)/value1);
         //alert(value2);
         if (value2)
         {
         $('#obtain').html(value2);
         $('#percent').val(value2);
     });
//        alert($('#percent').val());
  //alert( "Handler for .focus() called." );
  

      $(document).ready(function() {
           var grad = $('#grad').val();
        
        
         if(grad=="cgpa")
		   {      
                       $('#total_marks').val('');
       $('#obtain_marks').val('');
			   $('#cgpa').show();
                           $('#marks').hide();
                           $('#total_cgpa').attr('required', true);
                           $('#obtain_cgpa').attr('required', true);
                           $('#perc').attr('required', true);
                           $('#total_marks').attr('required', false);
                           $('#obtain_marks').attr('required', false);
			   
		   }
                   else{
                       $('#cgpa').hide();
                       $('#total_cgpa').attr('required', false);
                       $('#obtain_cgpa').attr('required', false);
                       $('#perc').attr('required', false);
                   }
                   
                 
                    if(grad=="marks")
		    {              
		                   $('#total_cgpa').val('');
                           $('#obtain_cgpa').val('');
                           $('#perc').val('');    
			              $('#marks').show();
                           $('#cgpa').hide();
                           $('#total_cgpa').attr('required', false);
                           $('#obtain_cgpa').attr('required', false);
                           $('#perc').attr('required', false);
                           $('#total_marks').attr('required', true);
                           $('#obtain_marks').attr('required', true);
			   
		   }
                   else{
                       $('#marks').hide();
                       $('#total_marks').attr('required', false);
                       $('#obtain_marks').attr('required', false);
                       
                   }
        //$('#applicants-gender-male').attr('checked', true);
        
        //$('#qualifications-grading-system-cgpa').attr('checked', true);
        //$('#qualifications-education-system-annual').attr('checked', true);
       
        $('#show').hide();
        
       $('#groom').hide();
      // alert($('#groom_name').val(''));
       //$('#cgpa').hide();
      // $('#marks').hide();
       $('#').hide();
       
       $('#fund_categ').change(function() {
           var value = $('#sub_categ').val();
           value="";
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
           
          if(value=="3")
		   {       
			   $('#show').show();
                           
                            
			   
		   }
                   else{
                       $('#show').hide();
                       
                   }
                   if(value=="2")
		   {       alert(value);
			   $('#groom').show();
                          
		   }
                   else{
                       $('#groom').hide();
                       
                        
                   }  
       });
       
    $('#sub_categ').change(function() {
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
        if(value=="3")
		   {       
			   $('#show').show();
                           $('#qual_level').attr('required', true);
                           
                           $('#dis_id').attr('required', true);
                           $('#ins_id').attr('required', true);
                           $('#deg_id').attr('required', true);
                           $('#total_cgpa').attr('required', true);
                           $('#obtain_cgpa').attr('required', true);
                           $('#perc').attr('required', true);
                           
                          
			   
		   }
                   else{
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
$('#qualifications-grading-system-cgpa').change(function() {
        var value = $(this).val();
        //alert(value);
        $('#total_marks').val('');
       $('#obtain_marks').val('');
         if(value=="cgpa")
		   {       
			   $('#cgpa').show();
                           $('#marks').hide();
                           $('#total_cgpa').attr('required', true);
                           $('#obtain_cgpa').attr('required', true);
                           $('#perc').attr('required', true);
                           $('#total_marks').attr('required', false);
                           $('#obtain_marks').attr('required', false);
			   
		   }
                   else{
                       $('#cgpa').hide();
                       $('#total_cgpa').attr('required', false);
                       $('#obtain_cgpa').attr('required', false);
                       $('#perc').attr('required', false);
                   }
        
               });
               
               $('#qualifications-grading-system-marks').click(function() {
        var value = $(this).val();
        $('#total_cgpa').val('');
       $('#obtain_cgpa').val('');
       $('#perc').val('');
       
        
        //alert(value);
         if(value=="marks")
		   {       
			   $('#marks').show();
                           $('#cgpa').hide();
                           $('#total_cgpa').attr('required', false);
                           $('#obtain_cgpa').attr('required', false);
                           $('#perc').attr('required', false);
                           $('#total_marks').attr('required', true);
                           $('#obtain_marks').attr('required', true);
			   
		   }
                   else{
                       $('#marks').hide();
                       $('#total_marks').attr('required', false);
                       $('#obtain_marks').attr('required', false);
                       
                   }
        
               });
               
$('#sub_categ').change(function() {
        var value = $(this).val();
        //var groom;
        $('#groom_name').attr('required', false);
        $('#groom_name').val('');
       
        //alert(groom);
        if(value=="2")
		   {       
			   $('#groom').show();
                           $('#groom_name').attr('required', true);
                         
			   
			   
		   }
                   else{
                       $('#groom').hide();
                       $('#groom_name').attr('required', false);
                       //alert('#groom_name').val() == '');
                   }
               });




});
	
     
    
                                        
</script>
<script>
    $(document).ready(function() {
    $('#funds').change(function() {
        var value = $(this).val();
       // alert(value);
        //return false;


        if (value != "")
        {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->Url->build(array('controller' => 'applicants', 'action' => 'subcategory')); ?>',
                data: 'value='+value,
                contentType: 'json',
                success: function(data)
                {
                  //  alert( JSON.parse(data));
                      
                       var  data = JSON.parse(data);
                     //alert(data);
                        
                    if ($.isEmptyObject(data))
                    {

                        $('#sub_categ').empty();
                        $('#fund_categ').empty();


                    }
                    else
                    {
                       
                        $('#sub_categ').empty();
                        $('#fund_categ').empty();
                        
                     $.each(data,function(key,value){
				
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
                            if(value1=="3")
                                       {       
                                               $('#show').show();
                                               $('#qual_level').attr('required', true);

                                               $('#dis_id').attr('required', true);
                                               $('#ins_id').attr('required', true);
                                               $('#deg_id').attr('required', true);
                                               $('#total_cgpa').attr('required', true);
                                               $('#obtain_cgpa').attr('required', true);
                                               $('#perc').attr('required', true);



                                       }
                                       else{
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
                                        if(value1=="2")
                                                   {       
                                                           $('#groom').show();
                                                           $('#groom_name').attr('required', true);



                                                   }
                                                   else{
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
                                        $.each(data,function(key,value){
				
                                   
                                    
				var Option ="<option value='"+value.fund_category_id+"'>"+value.fund_category_id+" </option>";
					
                                            
					
                                 
                                           
//				/alert(Option);
                                       // var value1 = $('#sub_categ').val();
                                        ///lert(value1+'sub_categ');
                                        
                                      
                              $('#fund_categ').append(Option);
                             //alert($('#sub_categ').val('h'));  
					//alert('sub_categ='+s.val());
					});
                                        
                   


                    }
                }, error: function(error) {
                  // alert(JSON.stringify(error));
                }


            });
        }
        else
        {
            $('#sub_categ').empty();
            $('#sub_categ').append("<option value=''>--Select--</option>");
            //alert(value);
        }

    });

});
	
    </script>
    
    <script>
    $(document).ready(function() {
    
        var value = $('#funds').val();
       // alert(value);
        //return false;


        if (value != "")
        {   //alert(value);
            $.ajax({
                type: 'GET',
                url: 'https://minorities.kp.gov.pk/cakedemo/admin/applicants/subcategory',
                data: 'value='+value,
                contentType: 'json',
                success: function(data)
                {
                // alert( JSON.parse(data));
                      
                       var  data = JSON.parse(data);
                     //alert(data);
                        
                    if ($.isEmptyObject(data))
                    {

                        $('#sub_categ').empty();
                        $('#fund_categ').empty();


                    }
                    else
                    {
                       
                        $('#sub_categ').empty();
                        $('#fund_categ').empty();
                        
                     $.each(data,function(key,value){
				
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
                            if(value1=="3")
                                       {       
                                               $('#show').show();
                                               $('#qual_level').attr('required', true);

                                               $('#dis_id').attr('required', true);
                                               $('#ins_id').attr('required', true);
                                               $('#deg_id').attr('required', true);
                                               $('#total_cgpa').attr('required', true);
                                               $('#obtain_cgpa').attr('required', true);
                                               $('#perc').attr('required', true);



                                       }
                                       else{
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
                                        if(value1=="2")
                                                   {       
                                                           $('#groom').show();
                                                           $('#groom_name').attr('required', true);



                                                   }
                                                   else{
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
                                        $.each(data,function(key,value){
				
                                   
                                    
				var Option ="<option value='"+value.fund_category_id+"'>"+value.fund_category_id+" </option>";
					
                                            
					
                                 
                                           
//				/alert(Option);
                                       // var value1 = $('#sub_categ').val();
                                        ///lert(value1+'sub_categ');
                                        
                                      
                              $('#fund_categ').append(Option);
                             //alert($('#sub_categ').val('h'));  
					//alert('sub_categ='+s.val());
					});
                                        
                   


                    }
                }, error: function(error) {
                  // alert(JSON.stringify(error));
                }


            });
        }
        else
        {
            $('#sub_categ').empty();
            $('#sub_categ').append("<option value=''>--Select--</option>");
            //alert(value);
        }

   

});
	
    </script>
    

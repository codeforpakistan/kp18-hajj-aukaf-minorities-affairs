<!-- === Your Profile ===-->
<div class="tab-pane" id="tab2">
    <h3 style="color:#117D2C;" class="block padding-bottom-10px">We want to know more about you</h3>
    @if (isset($error_msg))
        <div class="alert alert-danger fade in message error">
            <i class="icon-remove close" data-dismiss="alert"></i>
            <strong>Error!</strong><br/> <?= $error_msg ?>
        </div>
    @endif
    @php
        $g_s = '';
        $m_s = '';
        $f_label = '';
    @endphp
    @if ($selectedFund->sub_category_id == 2)
        @php
            $g_s = 'female';
            $m_s = 1;
        @endphp
        <h3 style="border: 1px solid #eee;background-color: #eee9;padding: 10px 5px;">Bride Details</h3>
    @endif

    <div class="form-group">
        <label class="control-label col-md-3">Full Name <span class="required">*</span></label>
        <div class="col-md-5">
            {!! Form::text('Applicant[name]', null, [
                'label' => false,
                'class' => 'form-control',
                'required'
            ]) !!}
            <span class="help-block">Provide your full name</span>
        </div>
    </div>
    <div class="form-group">
        @if ($selectedFund->sub_category_id == 1)
            @php
                // checks if it is widow, merriage, health grant
                $g_s = 'female';
                $m_s = 4;
                $f_label = '/Husbands';
            @endphp
        @endif
        <label class="control-label col-md-3">Father{{ $f_label }} Name <span class="required">*</span></label>
        <div class="col-md-5">
            {!! Form::text('Applicant[father_name]', null, [
                'label' => false,
                'class' => 'form-control',
                'required'
            ]) !!}
            <span class="help-block">Enter Father Name</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Religion<span class="required"> *</span></label>
        <div class="col-md-5">
            {!! Form::select('Applicant[religion_id]', $religions, null, [
                'class' => 'form-control',
                'label' => false,
                'placeholder' => 'Select Religion',
                'required',
            ]) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Gender<span class="required"> *</span></label>
        <div class="col-md-5">
            {!! Form::select('Applicant[gender]', ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'], $g_s, [
                'class' => 'form-control',
                'label' => false,
                'placeholder' => 'Select Gender',
                'required',
            ]) !!}
        </div>
    </div>
    @if ($selectedFund->sub_category_id == 3)
        <div class="form-group">
            <label class="col-md-3 control-label">Domicile<span class="required"> *</span></label>
            <div class="col-md-5">
                {!! Form::select('Applicant[domicile]', $cities, null, [
                    'class' => 'form-control',
                    'label' => false,
                    'placeholder' => 'Select District',
                    'required',
                ]) !!}
            </div>
        </div>
    @else
        <div class="form-group">
            <label class="col-md-3 control-label">Marital Status<span class="required"> *</span></label>
            <div class="col-md-5">
                {!! Form::select('Applicant[maritalstatus_id]', $maritalstatus, $m_s, [
                    'class' => 'form-control',
                    'label' => false,
                    'placeholder' => 'Select Marital Status',
                    'required',
                ]) !!}
            </div>
        </div>
        <!--merrige Grant-->
        @if ($selectedFund->sub_category_id == 2)
            <h3 style = "border: 1px solid #eee;background-color: #eee9;padding: 10px 5px;">Groom Details</h3>
            <div class="form-group">
                <label class="control-label col-md-3">Groom Name <span class="required">*</span></label>
                <div class="col-md-5">
                    {!! Form::text('Applicant[gname]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'required'
                    ]) !!}
                    <span class="help-block">Enter full name</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Father Name <span class="required">*</span></label>
                <div class="col-md-5">
                    {!! Form::text('Applicant[gfather_name]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'required'
                    ]) !!}
                    <span class="help-block">Enter Father Name</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">CNIC <span class="required">*</span></label>
                <div class="col-md-5">
                    {!! Form::text('Applicant[gcnic]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'pattern' => '[0-9]{5}-[0-9]{7}-[0-9]{1}',
                        "data-mask" => "99999-9999999-9",
                        'required'
                    ]) !!}
                    <span class="help-block">Enter CNIC(xxxxx-xxxxxxx-x)</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Contact Number <span class="required">*</span></label>
                <div class="col-md-5">
                    {!! Form::text('Applicant[gcontact]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'pattern' => '[0-9]{4} [0-9]{7}',
                        "data-mask" => "0399 9999999",
                        'required'
                    ]) !!}
                </div>
            </div>
        @else
            <div class="form-group">
                <label class="col-md-3 control-label">Profession</label>
                <div class="col-md-5">
                    {!! Form::text('ApplicantProfession[profession]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'required'
                    ]) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Monthly Income<span class="required"> *</span></label>
                <div class="col-md-5">
                    {!! Form::number('ApplicantIncome[monthly_income]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'required'
                    ]) !!}
                    <span class="help-block">Input must be number</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Dependent Family Members<span class="required"> *</span></label>
                <div class="col-md-5">
                    {!! Form::number('ApplicantHouseholdDetail[dependent_family_members]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'min' => 0,
                        'required'
                    ]) !!}
                    <span class="help-block">Input must be number</span>
                </div>
            </div>
        @endif
        @if ($selectedFund->sub_category_id == 4)
            <div class="form-group">
                <label class="control-label col-md-3">Disease<span class="required">*</span></label>
                <div class="col-md-5">
                    {!! Form::text('Applicant[disease]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'required'
                    ]) !!}
                </div>
            </div>
            <h3 style = "border: 1px solid #eee;background-color: #eee9;padding: 10px 5px;">Disease & Hospitalization Details</h3>
            <div class="form-group">
                <label class="control-label col-md-3">Doctor Name <span class="required">*</span></label>
                <div class="col-md-5">
                    {!! Form::text('Applicant[dname]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'required'
                    ]) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Address of Hospital/clinic <span class="required">*</span></label>
                <div class="col-md-5">
                    {!! Form::text('Applicant[clinic_address]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'required'
                    ]) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Contact Number <span class="required">*</span></label>
                <div class="col-md-5">
                    {!! Form::text('Applicant[dcontact]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'pattern' => '[0-9]{4} [0-9]{7}',
                        "data-mask" => "0399 9999999",
                        'required'
                    ]) !!}
                </div>
            </div>  
        @endif
    @endif
</div>
<!-- /Your Profile 
<!--=== Billing Setup ===-->
<div class="tab-pane" id="tab3">
    <h3 style="color:#117D2C;" class="block padding-bottom-10px">Provide your Contact details</h3>

    <div class="form-group">
        <label class="col-md-3 control-label">Current Address<span class="required"> *</span></label>
        <div class="col-md-5">
            {!! Form::text('ApplicantAddress[current_address]', null, [
                'label' => false,
                'class' => 'form-control',
                'required'
            ]) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Permanent Address<span class="required"> *</span></label>
        <div class="col-md-5">
            {!! Form::text('ApplicantAddress[permenent_address]', null, [
                'label' => false,
                'class' => 'form-control',
                'required'
            ]) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Postal Address<span class="required"> *</span></label>
        <div class="col-md-5">
            {!! Form::text('ApplicantAddress[postal_address]', null, [
                'label' => false,
                'class' => 'form-control',
                'required'
            ]) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">District<span class="required"> *</span></label>
        <div class="col-md-5">
            {!! Form::select('ApplicantAddress[city_id]', $cities, $cities->first(), [
                'class' => 'form-control',
                'label' => true,
                'placeholder' => 'Select City/District',
                'required',
            ]) !!}
        </div>
    </div>
    <div class="form-group" style="margin-bottom: 0;">
        <label class="col-md-3 control-label">Mobile Number<span class="required"> *</span></label>
        <div class="col-md-5">
            {!! Form::text('ApplicantContact[mob_number][]', null, [
                'label' => false,
                'class' => 'form-control',
                'pattern' => "[0-9]{4} [0-9]{7}",
                "data-mask" => "0399 9999999",
                'required'
            ]) !!}
            <span class="help-block">03xx xxxxxxx</span>
        </div>
    </div>
    <div class="col-md-8">
        <a class="pull-right" href="#" id="add_contact_row">add more</a>  
    </div>
    <br/><br/>
</div>
<!-- /Billing Setup -->
<!--=== Confirmation ===-->
<div class="tab-pane" id="tab4">
    <h3  style="color:#117D2C;" class="block padding-bottom-10px">Please Review your Information</h3>
    <h4  style="color:#117D2C;" class="form-section">Personal Info</h4>
    <div class="form-group">
        <label class="control-label col-md-3">CNIC:</label>
        <div class="col-md-5">
            <p class="form-control-static" data-display="Applicant[cnic]">{{ request()->input('cnic') }}</p>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Name:</label>
        <div class="col-md-5">
            <p class="form-control-static" data-display="Applicant[name]"></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Father Name</label>
        <div class="col-md-5">
            <p class="form-control-static" data-display="Applicant[father_name]"></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Religon:</label>
        <div class="col-md-5">
            <p class="form-control-static" data-display="Applicant[religion_id]"></p>
        </div>
    </div>
    @if ($selectedFund->sub_category_id == 3)
        <div class="form-group">
            <label class="control-label col-md-3">Domicile:</label>
            <div class="col-md-5">
                <p class="form-control-static" data-display="Applicant[domicile]"></p>
            </div>
        </div>
    @else
        <div class="form-group">
            <label class="control-label col-md-3">Profession:</label>
            <div class="col-md-5">
                <p class="form-control-static" data-display="ApplicantProfession[profession]"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Monthly Income:</label>
            <div class="col-md-5">
                <p class="form-control-static" data-display="ApplicantIncome[monthly_income]"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Family members:</label>
            <div class="col-md-5">
                <p class="form-control-static" data-display="ApplicantHouseholdDetail[dependent_family_members]"></p>
            </div>
        </div>
    @endif
    <h4  style="color:#117D2C;" class="form-section">Contact Information</h4>
    <div class="form-group">
        <label class="control-label col-md-3">current Address:</label>
        <div class="col-md-5">
            <p class="form-control-static" data-display="ApplicantAddress[current_address]"></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Permanent address:</label>
        <div class="col-md-5">
            <p class="form-control-static" data-display="ApplicantAddress[permenent_address]"></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Postal Address:</label>
        <div class="col-md-5">
            <p class="form-control-static" data-display="ApplicantAddress[postal_address]"></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">City:</label>
        <div class="col-md-5">
            <p class="form-control-static" data-display="ApplicantAddress[city_id]"></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Mobile Number</label>
        <div class="col-md-5">
            <p class="form-control-static" data-display="ApplicantContact[mob_number][]"></p>
        </div>
    </div>
    <div class="form-actions" style="background-color: unset;border: none;">
        <button class="btn btn-success pull-right" type="submit">Click to Apply</button>
    </div>
</div>
<!-- /Confirmation -->
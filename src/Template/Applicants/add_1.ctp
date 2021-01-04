<div class="row">
    <div class="col-sm-2"></div>

    <div class="col-sm-8">
        <?= $this->Form->create($applicant, ['type' => 'file']) ?>
        <fieldset>
            <legend><?= __('Personal Info') ?></legend>
            <?php
            //save data in Applicant table
            echo $this->Form->control('Applicants.name', ['class' => 'form-control']);
            echo $this->Form->control('Applicants.father_or_husband_name', ['class' => 'form-control']);
            echo $this->Form->control('Applicants.religion_id', ['class' => 'form-control', 'empty' => 'Select Religion', 'options' => $religions]);
            echo $this->Form->control('Applicants.cnic', ['class' => 'form-control']);
            echo $this->Form->control('Applicants.gender', ['label' => false, 'type' => 'radio', 'label' => false, 'escape' => false, 'options' => array('male' => '&nbsp;Male', 'female' => '&nbsp;Female'), 'templates' => [
                    'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                    'radioWrapper' => '<div class="radio">{{label}}</div>'
            ]]);
            echo $this->Form->control('Applicants.maritalstatus_id', ['empty' => 'Your marital status', 'options' => $maritalstatus, 'label' => 'Marital Status', 'class' => 'form-control']);

//            echo $this->Form->control('groom_or_bride_name');
            //save data in Applicantaddresses table
            echo $this->Form->control('Applicantaddresses.current_address', ['class' => 'form-control']);
            echo $this->Form->control('Applicantaddresses.permenent_address', ['class' => 'form-control']);
            echo $this->Form->control('Applicantaddresses.city_id', ['empty' => 'Select City', 'options' => $cities, 'class' => 'form-control']);
            echo $this->Form->control('Applicantaddresses.postal_address', ['class' => 'form-control']);
//        echo $this->Form->control('Applicantaddresses.zip_code', ['class' => 'form-control']);
// save data in applicantcontacts
            echo $this->Form->control('Applicantcontacts.mob_number', ['class' => 'form-control']);
            echo $this->Form->control('Applicantcontacts.tel_number', ['class' => 'form-control']);

            //save data in applicantincomes
            echo $this->Form->control('Applicantincomes.monthly_income', ['class' => 'form-control']);

            // save data in applicantprofessions
            echo $this->Form->control('Applicantprofessions.profession', ['class' => 'form-control']);

// save households in applicant_household_details table
            echo $this->Form->control('ApplicantHouseholdDetails.dependent_family_members', ['class' => 'form-control']);
            //save attachments in Applicant's attachment table
            echo $this->Form->control('ApplicantAttachments.attachments[]', ['secure' => false, 'label' => 'Attachments', 'class' => 'form-control', 'type' => 'file', 'multiple' => true]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('save'), ['name' => 'save', 'class' => 'btn btn-primary']); ?>
        <?= $this->Form->button(__('save and continue'), ['name' => 'continue', 'class' => 'btn btn-primary']); ?>

        <?= $this->Form->end() ?>
    </div>
    <div class="col-sm-2"></div>
</div>
<br/><br/>


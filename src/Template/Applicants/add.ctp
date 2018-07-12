<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Religions'), ['controller' => 'Religions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Religion'), ['controller' => 'Religions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicant Attachments'), ['controller' => 'ApplicantAttachments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant Attachment'), ['controller' => 'ApplicantAttachments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicant Household Details'), ['controller' => 'ApplicantHouseholdDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant Household Detail'), ['controller' => 'ApplicantHouseholdDetails', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicantaddresses'), ['controller' => 'Applicantaddresses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantaddress'), ['controller' => 'Applicantaddresses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicantcontacts'), ['controller' => 'Applicantcontacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantcontact'), ['controller' => 'Applicantcontacts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicantincomes'), ['controller' => 'Applicantincomes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantincome'), ['controller' => 'Applicantincomes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicantprofessions'), ['controller' => 'Applicantprofessions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantprofession'), ['controller' => 'Applicantprofessions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applies'), ['controller' => 'Applies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Apply'), ['controller' => 'Applies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Provided Funds'), ['controller' => 'ProvidedFunds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Provided Fund'), ['controller' => 'ProvidedFunds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicants form large-9 medium-8 columns content">
    <?= $this->Form->create($applicant, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Personal Info') ?></legend>
        <?php
        //save data in Applicant table
        echo $this->Form->control('Applicants.name');
        echo $this->Form->control('Applicants.father_or_husband_name');
        echo $this->Form->control('Applicants.religion_id', ['empty' => 'Select Religion', 'options' => $religions]);
        echo $this->Form->control('Applicants.cnic');
//            echo $this->Form->control('groom_or_bride_name');
        //save data in Applicantaddresses table
        echo $this->Form->control('Applicantaddresses.current_address');
        echo $this->Form->control('Applicantaddresses.permenent_address');
        echo $this->Form->control('Applicantaddresses.city');
        echo $this->Form->control('Applicantaddresses.postal_address');
        echo $this->Form->control('Applicantaddresses.zip_code');
// save data in applicantcontacts
        echo $this->Form->control('Applicantcontacts.mob_number');
        echo $this->Form->control('Applicantcontacts.tel_number');

        //save data in applicantincomes
        echo $this->Form->control('Applicantincomes.monthly_income');

        // save data in applicantprofessions
        echo $this->Form->control('Applicantprofessions.profession');

        //save attachments in Applicant's attachment table
        echo $this->Form->control('ApplicantAttachments.attachments[]', ['secure' => false, 'type' => 'file', 'multiple' => true]);

// save households in applicant_household_details table
        echo $this->Form->control('ApplicantHouseholdDetails.dependent_family_members');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

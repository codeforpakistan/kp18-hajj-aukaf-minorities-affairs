<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicant->id)]
            )
        ?></li>
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
    <?= $this->Form->create($applicant) ?>
    <fieldset>
        <legend><?= __('Edit Applicant') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('father_or_husband_name');
            echo $this->Form->control('religion_id', ['options' => $religions]);
            echo $this->Form->control('cnic');
            echo $this->Form->control('groom_or_bride_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

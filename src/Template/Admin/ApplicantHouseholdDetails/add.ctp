<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicantHouseholdDetail $applicantHouseholdDetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Applicant Household Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantHouseholdDetails form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantHouseholdDetail) ?>
    <fieldset>
        <legend><?= __('Add Applicant Household Detail') ?></legend>
        <?php
            echo $this->Form->control('applicant_id', ['options' => $applicants]);
            echo $this->Form->control('dependent_family_members');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

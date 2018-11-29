<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicantHouseholdDetail $applicantHouseholdDetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicant Household Detail'), ['action' => 'edit', $applicantHouseholdDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicant Household Detail'), ['action' => 'delete', $applicantHouseholdDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantHouseholdDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicant Household Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant Household Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicantHouseholdDetails view large-9 medium-8 columns content">
    <h3><?= h($applicantHouseholdDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Applicant') ?></th>
            <td><?= $applicantHouseholdDetail->has('applicant') ? $this->Html->link($applicantHouseholdDetail->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantHouseholdDetail->applicant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicantHouseholdDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dependent Family Members') ?></th>
            <td><?= $this->Number->format($applicantHouseholdDetail->dependent_family_members) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= $applicantHouseholdDetail->updated ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

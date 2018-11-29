<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicantincome $applicantincome
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicantincome'), ['action' => 'edit', $applicantincome->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicantincome'), ['action' => 'delete', $applicantincome->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantincome->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicantincomes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicantincome'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicantincomes view large-9 medium-8 columns content">
    <h3><?= h($applicantincome->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Applicant') ?></th>
            <td><?= $applicantincome->has('applicant') ? $this->Html->link($applicantincome->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantincome->applicant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monthly Income') ?></th>
            <td><?= h($applicantincome->monthly_income) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicantincome->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= $applicantincome->updated ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

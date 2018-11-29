<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicantprofession $applicantprofession
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicantprofession'), ['action' => 'edit', $applicantprofession->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicantprofession'), ['action' => 'delete', $applicantprofession->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantprofession->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicantprofessions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicantprofession'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicantprofessions view large-9 medium-8 columns content">
    <h3><?= h($applicantprofession->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Applicant') ?></th>
            <td><?= $applicantprofession->has('applicant') ? $this->Html->link($applicantprofession->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantprofession->applicant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profession') ?></th>
            <td><?= h($applicantprofession->profession) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicantprofession->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= $this->Number->format($applicantprofession->updated) ?></td>
        </tr>
    </table>
</div>

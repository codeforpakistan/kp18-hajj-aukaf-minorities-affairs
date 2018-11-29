<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicantAttachment $applicantAttachment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicant Attachment'), ['action' => 'edit', $applicantAttachment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicant Attachment'), ['action' => 'delete', $applicantAttachment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantAttachment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicant Attachments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant Attachment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicantAttachments view large-9 medium-8 columns content">
    <h3><?= h($applicantAttachment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Applicant') ?></th>
            <td><?= $applicantAttachment->has('applicant') ? $this->Html->link($applicantAttachment->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantAttachment->applicant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attachments') ?></th>
            <td><?= h($applicantAttachment->attachments) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicantAttachment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= $applicantAttachment->updated ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

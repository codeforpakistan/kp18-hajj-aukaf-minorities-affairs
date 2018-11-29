<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicantcontact $applicantcontact
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicantcontact'), ['action' => 'edit', $applicantcontact->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicantcontact'), ['action' => 'delete', $applicantcontact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantcontact->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicantcontacts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicantcontact'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicantcontacts view large-9 medium-8 columns content">
    <h3><?= h($applicantcontact->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Applicant') ?></th>
            <td><?= $applicantcontact->has('applicant') ? $this->Html->link($applicantcontact->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantcontact->applicant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mob Number') ?></th>
            <td><?= h($applicantcontact->mob_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tel Number') ?></th>
            <td><?= h($applicantcontact->tel_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicantcontact->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= $this->Number->format($applicantcontact->updated) ?></td>
        </tr>
    </table>
</div>

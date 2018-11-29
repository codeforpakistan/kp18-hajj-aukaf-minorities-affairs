<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicant'), ['action' => 'edit', $applicant->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicant'), ['action' => 'delete', $applicant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicant->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicants view large-9 medium-8 columns content">
    <h3><?= h($applicant->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($applicant->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fname') ?></th>
            <td><?= h($applicant->fname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cnic') ?></th>
            <td><?= h($applicant->cnic) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Current Address') ?></th>
            <td><?= h($applicant->current address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Permanent Address') ?></th>
            <td><?= h($applicant->permanent address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zipcode') ?></th>
            <td><?= h($applicant->zipcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($applicant->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telephone Number') ?></th>
            <td><?= h($applicant->telephone number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile Number') ?></th>
            <td><?= h($applicant->mobile number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicant->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Of Birth') ?></th>
            <td><?= h($applicant->date of birth) ?></td>
        </tr>
    </table>
</div>

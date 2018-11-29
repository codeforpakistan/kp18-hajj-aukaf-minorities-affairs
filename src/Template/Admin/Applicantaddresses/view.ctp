<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicantaddress $applicantaddress
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicantaddress'), ['action' => 'edit', $applicantaddress->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicantaddress'), ['action' => 'delete', $applicantaddress->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantaddress->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicantaddresses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicantaddress'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicantaddresses view large-9 medium-8 columns content">
    <h3><?= h($applicantaddress->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Applicant') ?></th>
            <td><?= $applicantaddress->has('applicant') ? $this->Html->link($applicantaddress->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantaddress->applicant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Current Address') ?></th>
            <td><?= h($applicantaddress->current_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Permenent Address') ?></th>
            <td><?= h($applicantaddress->permenent_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($applicantaddress->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Postal Address') ?></th>
            <td><?= h($applicantaddress->postal_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zip Code') ?></th>
            <td><?= h($applicantaddress->zip_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicantaddress->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= $applicantaddress->updated ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

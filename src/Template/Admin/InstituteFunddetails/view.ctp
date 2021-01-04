<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InstituteFunddetail $instituteFunddetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Institute Funddetail'), ['action' => 'edit', $instituteFunddetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Institute Funddetail'), ['action' => 'delete', $instituteFunddetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $instituteFunddetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Institute Funddetails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Institute Funddetail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Funds'), ['controller' => 'Funds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fund'), ['controller' => 'Funds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="instituteFunddetails view large-9 medium-8 columns content">
    <h3><?= h($instituteFunddetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Applicant') ?></th>
            <td><?= $instituteFunddetail->has('applicant') ? $this->Html->link($instituteFunddetail->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $instituteFunddetail->applicant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fund') ?></th>
            <td><?= $instituteFunddetail->has('fund') ? $this->Html->link($instituteFunddetail->fund->fund_name, ['controller' => 'Funds', 'action' => 'view', $instituteFunddetail->fund->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount Recived') ?></th>
            <td><?= h($instituteFunddetail->amount_recived) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($instituteFunddetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Selected') ?></th>
            <td><?= $this->Number->format($instituteFunddetail->selected) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Date') ?></th>
            <td><?= h($instituteFunddetail->payment_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Appling Date') ?></th>
            <td><?= h($instituteFunddetail->appling_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($instituteFunddetail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($instituteFunddetail->modified) ?></td>
        </tr>
    </table>
</div>

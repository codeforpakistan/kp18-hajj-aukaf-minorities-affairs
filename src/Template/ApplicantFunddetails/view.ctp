<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicantFunddetail $applicantFunddetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicant Funddetail'), ['action' => 'edit', $applicantFunddetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicant Funddetail'), ['action' => 'delete', $applicantFunddetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantFunddetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicant Funddetails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant Funddetail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'FundCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fund Category'), ['controller' => 'FundCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicantFunddetails view large-9 medium-8 columns content">
    <h3><?= h($applicantFunddetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Applicant') ?></th>
            <td><?= $applicantFunddetail->has('applicant') ? $this->Html->link($applicantFunddetail->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantFunddetail->applicant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fund Category') ?></th>
            <td><?= $applicantFunddetail->has('fund_category') ? $this->Html->link($applicantFunddetail->fund_category->id, ['controller' => 'FundCategories', 'action' => 'view', $applicantFunddetail->fund_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub Category') ?></th>
            <td><?= $applicantFunddetail->has('sub_category') ? $this->Html->link($applicantFunddetail->sub_category->id, ['controller' => 'SubCategories', 'action' => 'view', $applicantFunddetail->sub_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount Recived') ?></th>
            <td><?= h($applicantFunddetail->amount_recived) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Check Number') ?></th>
            <td><?= h($applicantFunddetail->check_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicantFunddetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Date') ?></th>
            <td><?= h($applicantFunddetail->payment_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Appling Date') ?></th>
            <td><?= h($applicantFunddetail->appling_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($applicantFunddetail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($applicantFunddetail->modified) ?></td>
        </tr>
    </table>
</div>

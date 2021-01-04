<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Apply $apply
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Apply'), ['action' => 'edit', $apply->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Apply'), ['action' => 'delete', $apply->id], ['confirm' => __('Are you sure you want to delete # {0}?', $apply->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Apply'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'FundCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fund Category'), ['controller' => 'FundCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applies view large-9 medium-8 columns content">
    <h3><?= h($apply->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Applicant') ?></th>
            <td><?= $apply->has('applicant') ? $this->Html->link($apply->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $apply->applicant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fund Category') ?></th>
            <td><?= $apply->has('fund_category') ? $this->Html->link($apply->fund_category->id, ['controller' => 'FundCategories', 'action' => 'view', $apply->fund_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub Category') ?></th>
            <td><?= $apply->has('sub_category') ? $this->Html->link($apply->sub_category->id, ['controller' => 'SubCategories', 'action' => 'view', $apply->sub_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($apply->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($apply->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($apply->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($apply->modified) ?></td>
        </tr>
    </table>
</div>

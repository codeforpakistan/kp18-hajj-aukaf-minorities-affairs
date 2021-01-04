<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fund $fund
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fund'), ['action' => 'edit', $fund->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fund'), ['action' => 'delete', $fund->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fund->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Funds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fund'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'FundCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fund Category'), ['controller' => 'FundCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="funds view large-9 medium-8 columns content">
    <h3><?= h($fund->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fund Category') ?></th>
            <td><?= $fund->has('fund_category') ? $this->Html->link($fund->fund_category->id, ['controller' => 'FundCategories', 'action' => 'view', $fund->fund_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub Category') ?></th>
            <td><?= $fund->has('sub_category') ? $this->Html->link($fund->sub_category->id, ['controller' => 'SubCategories', 'action' => 'view', $fund->sub_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Amount') ?></th>
            <td><?= h($fund->total_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount Remaining') ?></th>
            <td><?= h($fund->amount_remaining) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($fund->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receiving Date') ?></th>
            <td><?= h($fund->receiving_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($fund->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($fund->modified) ?></td>
        </tr>
    </table>
</div>

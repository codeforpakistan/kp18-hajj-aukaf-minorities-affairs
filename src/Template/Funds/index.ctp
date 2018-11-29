<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fund[]|\Cake\Collection\CollectionInterface $funds
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fund'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'FundCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fund Category'), ['controller' => 'FundCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="funds index large-9 medium-8 columns content">
    <h3><?= __('Funds') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fund_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sub_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receiving_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_remaining') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($funds as $fund): ?>
            <tr>
                <td><?= $this->Number->format($fund->id) ?></td>
                <td><?= $fund->has('fund_category') ? $this->Html->link($fund->fund_category->id, ['controller' => 'FundCategories', 'action' => 'view', $fund->fund_category->id]) : '' ?></td>
                <td><?= $fund->has('sub_category') ? $this->Html->link($fund->sub_category->id, ['controller' => 'SubCategories', 'action' => 'view', $fund->sub_category->id]) : '' ?></td>
                <td><?= h($fund->total_amount) ?></td>
                <td><?= h($fund->receiving_date) ?></td>
                <td><?= h($fund->amount_remaining) ?></td>
                <td><?= h($fund->created) ?></td>
                <td><?= h($fund->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fund->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fund->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fund->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fund->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

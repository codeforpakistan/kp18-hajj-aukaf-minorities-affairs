<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubCategory[]|\Cake\Collection\CollectionInterface $subCategories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sub Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'FundCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fund Category'), ['controller' => 'FundCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applies'), ['controller' => 'Applies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Apply'), ['controller' => 'Applies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Funds'), ['controller' => 'Funds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fund'), ['controller' => 'Funds', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Provided Funds'), ['controller' => 'ProvidedFunds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Provided Fund'), ['controller' => 'ProvidedFunds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subCategories index large-9 medium-8 columns content">
    <h3><?= __('Sub Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fund_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_of_fund') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subCategories as $subCategory): ?>
            <tr>
                <td><?= $this->Number->format($subCategory->id) ?></td>
                <td><?= $subCategory->has('fund_category') ? $this->Html->link($subCategory->fund_category->id, ['controller' => 'FundCategories', 'action' => 'view', $subCategory->fund_category->id]) : '' ?></td>
                <td><?= h($subCategory->type_of_fund) ?></td>
                <td><?= h($subCategory->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subCategory->id)]) ?>
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

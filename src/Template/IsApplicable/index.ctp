<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IsApplicable[]|\Cake\Collection\CollectionInterface $isApplicable
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Is Applicable'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="isApplicable index large-9 medium-8 columns content">
    <h3><?= __('Is Applicable') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sub_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('maritalstatus_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($isApplicable as $isApplicable): ?>
            <tr>
                <td><?= $this->Number->format($isApplicable->id) ?></td>
                <td><?= $isApplicable->has('sub_category') ? $this->Html->link($isApplicable->sub_category->id, ['controller' => 'SubCategories', 'action' => 'view', $isApplicable->sub_category->id]) : '' ?></td>
                <td><?= $this->Number->format($isApplicable->maritalstatus_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $isApplicable->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $isApplicable->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $isApplicable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $isApplicable->id)]) ?>
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

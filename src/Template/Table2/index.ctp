<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Table2[]|\Cake\Collection\CollectionInterface $table2
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Table2'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="table2 index large-9 medium-8 columns content">
    <h3><?= __('Table2') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fname') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($table2 as $table2): ?>
            <tr>
                <td><?= $this->Number->format($table2->id) ?></td>
                <td><?= $this->Number->format($table2->fname) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $table2->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $table2->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $table2->id], ['confirm' => __('Are you sure you want to delete # {0}?', $table2->id)]) ?>
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

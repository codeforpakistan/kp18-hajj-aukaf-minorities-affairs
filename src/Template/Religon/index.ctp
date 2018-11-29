<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Religon[]|\Cake\Collection\CollectionInterface $religon
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Religon'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicant'), ['controller' => 'Applicant', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicant', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="religon index large-9 medium-8 columns content">
    <h3><?= __('Religon') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($religon as $religon): ?>
            <tr>
                <td><?= $this->Number->format($religon->id) ?></td>
                <td><?= h($religon->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $religon->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $religon->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $religon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $religon->id)]) ?>
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

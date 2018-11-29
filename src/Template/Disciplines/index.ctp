<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Discipline[]|\Cake\Collection\CollectionInterface $disciplines
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Discipline'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualification Levels'), ['controller' => 'QualificationLevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Qualification Level'), ['controller' => 'QualificationLevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualifications'), ['controller' => 'Qualifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Qualification'), ['controller' => 'Qualifications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="disciplines index large-9 medium-8 columns content">
    <h3><?= __('Disciplines') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qualification_level_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('discipline') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($disciplines as $discipline): ?>
            <tr>
                <td><?= $this->Number->format($discipline->id) ?></td>
                <td><?= $discipline->has('qualification_level') ? $this->Html->link($discipline->qualification_level->name, ['controller' => 'QualificationLevels', 'action' => 'view', $discipline->qualification_level->id]) : '' ?></td>
                <td><?= h($discipline->discipline) ?></td>
                <td><?= h($discipline->created) ?></td>
                <td><?= h($discipline->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $discipline->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $discipline->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $discipline->id], ['confirm' => __('Are you sure you want to delete # {0}?', $discipline->id)]) ?>
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

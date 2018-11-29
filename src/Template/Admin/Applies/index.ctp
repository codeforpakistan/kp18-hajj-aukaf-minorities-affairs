<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Apply[]|\Cake\Collection\CollectionInterface $applies
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Apply'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'FundCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fund Category'), ['controller' => 'FundCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applies index large-9 medium-8 columns content">
    <h3><?= __('Applies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fund_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sub_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applies as $apply): ?>
            <tr>
                <td><?= $this->Number->format($apply->id) ?></td>
                <td><?= $apply->has('applicant') ? $this->Html->link($apply->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $apply->applicant->id]) : '' ?></td>
                <td><?= $apply->has('fund_category') ? $this->Html->link($apply->fund_category->id, ['controller' => 'FundCategories', 'action' => 'view', $apply->fund_category->id]) : '' ?></td>
                <td><?= $apply->has('sub_category') ? $this->Html->link($apply->sub_category->type_of_fund, ['controller' => 'SubCategories', 'action' => 'view', $apply->sub_category->id]) : '' ?></td>
                <td><?= h($apply->date) ?></td>
                <td><?= h($apply->created) ?></td>
                <td><?= h($apply->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $apply->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $apply->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $apply->id], ['confirm' => __('Are you sure you want to delete # {0}?', $apply->id)]) ?>
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

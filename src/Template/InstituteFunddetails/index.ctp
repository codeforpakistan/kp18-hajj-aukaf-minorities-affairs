<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InstituteFunddetail[]|\Cake\Collection\CollectionInterface $instituteFunddetails
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Institute Funddetail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Funds'), ['controller' => 'Funds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fund'), ['controller' => 'Funds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="instituteFunddetails index large-9 medium-8 columns content">
    <h3><?= __('Institute Funddetails') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fund_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_recived') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('appling_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('selected') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($instituteFunddetails as $instituteFunddetail): ?>
            <tr>
                <td><?= $this->Number->format($instituteFunddetail->id) ?></td>
                <td><?= $instituteFunddetail->has('applicant') ? $this->Html->link($instituteFunddetail->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $instituteFunddetail->applicant->id]) : '' ?></td>
                <td><?= $instituteFunddetail->has('fund') ? $this->Html->link($instituteFunddetail->fund->id, ['controller' => 'Funds', 'action' => 'view', $instituteFunddetail->fund->id]) : '' ?></td>
                <td><?= h($instituteFunddetail->amount_recived) ?></td>
                <td><?= h($instituteFunddetail->payment_date) ?></td>
                <td><?= h($instituteFunddetail->appling_date) ?></td>
                <td><?= $this->Number->format($instituteFunddetail->selected) ?></td>
                <td><?= h($instituteFunddetail->created) ?></td>
                <td><?= h($instituteFunddetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $instituteFunddetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $instituteFunddetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $instituteFunddetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $instituteFunddetail->id)]) ?>
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

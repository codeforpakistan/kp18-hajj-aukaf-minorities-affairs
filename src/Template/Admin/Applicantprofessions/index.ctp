<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicantprofession[]|\Cake\Collection\CollectionInterface $applicantprofessions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicantprofession'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantprofessions index large-9 medium-8 columns content">
    <h3><?= __('Applicantprofessions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('profession') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantprofessions as $applicantprofession): ?>
            <tr>
                <td><?= $this->Number->format($applicantprofession->id) ?></td>
                <td><?= $applicantprofession->has('applicant') ? $this->Html->link($applicantprofession->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantprofession->applicant->id]) : '' ?></td>
                <td><?= h($applicantprofession->profession) ?></td>
                <td><?= $this->Number->format($applicantprofession->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantprofession->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantprofession->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantprofession->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantprofession->id)]) ?>
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

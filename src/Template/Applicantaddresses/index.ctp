<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicantaddress[]|\Cake\Collection\CollectionInterface $applicantaddresses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicantaddress'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantaddresses index large-9 medium-8 columns content">
    <h3><?= __('Applicantaddresses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('current_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('permenent_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('postal_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zip_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantaddresses as $applicantaddress): ?>
            <tr>
                <td><?= $this->Number->format($applicantaddress->id) ?></td>
                <td><?= $applicantaddress->has('applicant') ? $this->Html->link($applicantaddress->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantaddress->applicant->id]) : '' ?></td>
                <td><?= h($applicantaddress->current_address) ?></td>
                <td><?= h($applicantaddress->permenent_address) ?></td>
                <td><?= h($applicantaddress->city) ?></td>
                <td><?= h($applicantaddress->postal_address) ?></td>
                <td><?= h($applicantaddress->zip_code) ?></td>
                <td><?= h($applicantaddress->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantaddress->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantaddress->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantaddress->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantaddress->id)]) ?>
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

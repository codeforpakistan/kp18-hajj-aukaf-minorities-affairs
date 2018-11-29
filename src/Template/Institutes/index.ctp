<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Institute[]|\Cake\Collection\CollectionInterface $institutes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Institute'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Institute Types'), ['controller' => 'InstituteTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Institute Type'), ['controller' => 'InstituteTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicantcontacts'), ['controller' => 'Applicantcontacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantcontact'), ['controller' => 'Applicantcontacts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualifications'), ['controller' => 'Qualifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Qualification'), ['controller' => 'Qualifications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="institutes index large-9 medium-8 columns content">
    <h3><?= __('Institutes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('institute_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('institute_sector') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicantcontact_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($institutes as $institute): ?>
            <tr>
                <td><?= $this->Number->format($institute->id) ?></td>
                <td><?= $institute->has('institute_type') ? $this->Html->link($institute->institute_type->id, ['controller' => 'InstituteTypes', 'action' => 'view', $institute->institute_type->id]) : '' ?></td>
                <td><?= h($institute->name) ?></td>
                <td><?= $institute->has('city') ? $this->Html->link($institute->city->name, ['controller' => 'Cities', 'action' => 'view', $institute->city->id]) : '' ?></td>
                <td><?= h($institute->institute_sector) ?></td>
                <td><?= h($institute->address) ?></td>
                <td><?= $institute->has('applicantcontact') ? $this->Html->link($institute->applicantcontact->id, ['controller' => 'Applicantcontacts', 'action' => 'view', $institute->applicantcontact->id]) : '' ?></td>
                <td><?= h($institute->created) ?></td>
                <td><?= h($institute->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $institute->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $institute->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $institute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $institute->id)]) ?>
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

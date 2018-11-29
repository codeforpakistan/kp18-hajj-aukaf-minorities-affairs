<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicantcontact[]|\Cake\Collection\CollectionInterface $applicantcontacts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicantcontact'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantcontacts index large-9 medium-8 columns content">
    <h3><?= __('Applicantcontacts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mob_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tel_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantcontacts as $applicantcontact): ?>
            <tr>
                <td><?= $this->Number->format($applicantcontact->id) ?></td>
                <td><?= $applicantcontact->has('applicant') ? $this->Html->link($applicantcontact->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantcontact->applicant->id]) : '' ?></td>
                <td><?= h($applicantcontact->mob_number) ?></td>
                <td><?= h($applicantcontact->tel_number) ?></td>
                <td><?= $this->Number->format($applicantcontact->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantcontact->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantcontact->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantcontact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantcontact->id)]) ?>
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

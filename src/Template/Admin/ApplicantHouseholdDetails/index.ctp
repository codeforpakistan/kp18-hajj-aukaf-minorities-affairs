<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicantHouseholdDetail[]|\Cake\Collection\CollectionInterface $applicantHouseholdDetails
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicant Household Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantHouseholdDetails index large-9 medium-8 columns content">
    <h3><?= __('Applicant Household Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dependent_family_members') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantHouseholdDetails as $applicantHouseholdDetail): ?>
            <tr>
                <td><?= $this->Number->format($applicantHouseholdDetail->id) ?></td>
                <td><?= $applicantHouseholdDetail->has('applicant') ? $this->Html->link($applicantHouseholdDetail->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantHouseholdDetail->applicant->id]) : '' ?></td>
                <td><?= $this->Number->format($applicantHouseholdDetail->dependent_family_members) ?></td>
                <td><?= h($applicantHouseholdDetail->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantHouseholdDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantHouseholdDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantHouseholdDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantHouseholdDetail->id)]) ?>
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

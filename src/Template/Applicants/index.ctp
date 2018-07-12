<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant[]|\Cake\Collection\CollectionInterface $applicants
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Religions'), ['controller' => 'Religions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Religion'), ['controller' => 'Religions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicant Attachments'), ['controller' => 'ApplicantAttachments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant Attachment'), ['controller' => 'ApplicantAttachments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicant Household Details'), ['controller' => 'ApplicantHouseholdDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant Household Detail'), ['controller' => 'ApplicantHouseholdDetails', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicantaddresses'), ['controller' => 'Applicantaddresses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantaddress'), ['controller' => 'Applicantaddresses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicantcontacts'), ['controller' => 'Applicantcontacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantcontact'), ['controller' => 'Applicantcontacts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicantincomes'), ['controller' => 'Applicantincomes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantincome'), ['controller' => 'Applicantincomes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicantprofessions'), ['controller' => 'Applicantprofessions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantprofession'), ['controller' => 'Applicantprofessions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applies'), ['controller' => 'Applies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Apply'), ['controller' => 'Applies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Provided Funds'), ['controller' => 'ProvidedFunds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Provided Fund'), ['controller' => 'ProvidedFunds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicants index large-9 medium-8 columns content">
    <h3><?= __('Applicants') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('father_or_husband_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('religion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cnic') ?></th>
                <th scope="col"><?= $this->Paginator->sort('groom_or_bride_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicants as $applicant): ?>
            <tr>
                <td><?= $this->Number->format($applicant->id) ?></td>
                <td><?= h($applicant->name) ?></td>
                <td><?= h($applicant->father_or_husband_name) ?></td>
                <td><?= $applicant->has('religion') ? $this->Html->link($applicant->religion->id, ['controller' => 'Religions', 'action' => 'view', $applicant->religion->id]) : '' ?></td>
                <td><?= h($applicant->cnic) ?></td>
                <td><?= h($applicant->groom_or_bride_name) ?></td>
                <td><?= h($applicant->created) ?></td>
                <td><?= h($applicant->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicant->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicant->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicant->id)]) ?>
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

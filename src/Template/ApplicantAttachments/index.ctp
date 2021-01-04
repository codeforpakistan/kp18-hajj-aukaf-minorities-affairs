<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicantAttachment[]|\Cake\Collection\CollectionInterface $applicantAttachments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicant Attachment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantAttachments index large-9 medium-8 columns content">
    <h3><?= __('Applicant Attachments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attachments') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantAttachments as $applicantAttachment): ?>
            <tr>
                <td><?= $this->Number->format($applicantAttachment->id) ?></td>
                <td><?= $applicantAttachment->has('applicant') ? $this->Html->link($applicantAttachment->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantAttachment->applicant->id]) : '' ?></td>
                <td><?= h($applicantAttachment->attachments) ?></td>
                <td><?= h($applicantAttachment->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantAttachment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantAttachment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantAttachment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantAttachment->id)]) ?>
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

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicantFunddetail[]|\Cake\Collection\CollectionInterface $applicantFunddetails
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicant Funddetail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'FundCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fund Category'), ['controller' => 'FundCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantFunddetails index large-9 medium-8 columns content">
    <h3><?= __('Applicant Funddetails') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fund_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sub_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_recived') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('check_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('appling_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantFunddetails as $applicantFunddetail): ?>
            <tr>
                <td><?= $this->Number->format($applicantFunddetail->id) ?></td>
                <td><?= $applicantFunddetail->has('applicant') ? $this->Html->link($applicantFunddetail->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $applicantFunddetail->applicant->id]) : '' ?></td>
                <td><?= $applicantFunddetail->has('fund_category') ? $this->Html->link($applicantFunddetail->fund_category->id, ['controller' => 'FundCategories', 'action' => 'view', $applicantFunddetail->fund_category->id]) : '' ?></td>
                <td><?= $applicantFunddetail->has('sub_category') ? $this->Html->link($applicantFunddetail->sub_category->id, ['controller' => 'SubCategories', 'action' => 'view', $applicantFunddetail->sub_category->id]) : '' ?></td>
                <td><?= h($applicantFunddetail->amount_recived) ?></td>
                <td><?= h($applicantFunddetail->payment_date) ?></td>
                <td><?= h($applicantFunddetail->check_number) ?></td>
                <td><?= h($applicantFunddetail->appling_date) ?></td>
                <td><?= h($applicantFunddetail->created) ?></td>
                <td><?= h($applicantFunddetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantFunddetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantFunddetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantFunddetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantFunddetail->id)]) ?>
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

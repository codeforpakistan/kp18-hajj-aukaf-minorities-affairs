<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant[]|\Cake\Collection\CollectionInterface $applicant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicant index large-9 medium-8 columns content">
    <h3><?= __('Applicant') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cnic') ?></th>
                <th scope="col"><?= $this->Paginator->sort('religon_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_of_birth') ?></th>
                <th scope="col"><?= $this->Paginator->sort('current_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('permanent_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zipcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('telephone_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile_number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicant as $applicant): ?>
            <tr>
                <td><?= $this->Number->format($applicant->id) ?></td>
                <td><?= h($applicant->name) ?></td>
                <td><?= h($applicant->fname) ?></td>
                <td><?= h($applicant->cnic) ?></td>
                <td><?= $this->Number->format($applicant->religon_id) ?></td>
                <td><?= h($applicant->date_of_birth) ?></td>
                <td><?= h($applicant->current_address) ?></td>
                <td><?= h($applicant->permanent_address) ?></td>
                <td><?= h($applicant->zipcode) ?></td>
                <td><?= h($applicant->email) ?></td>
                <td><?= h($applicant->telephone_number) ?></td>
                <td><?= h($applicant->mobile_number) ?></td>
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

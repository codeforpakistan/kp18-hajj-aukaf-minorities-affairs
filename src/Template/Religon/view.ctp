<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Religon $religon
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Religon'), ['action' => 'edit', $religon->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Religon'), ['action' => 'delete', $religon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $religon->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Religon'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Religon'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicant'), ['controller' => 'Applicant', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicant', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="religon view large-9 medium-8 columns content">
    <h3><?= h($religon->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($religon->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($religon->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Applicant') ?></h4>
        <?php if (!empty($religon->applicant)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Fname') ?></th>
                <th scope="col"><?= __('Cnic') ?></th>
                <th scope="col"><?= __('Religon Id') ?></th>
                <th scope="col"><?= __('Date Of Birth') ?></th>
                <th scope="col"><?= __('Current Address') ?></th>
                <th scope="col"><?= __('Permanent Address') ?></th>
                <th scope="col"><?= __('Zipcode') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Telephone Number') ?></th>
                <th scope="col"><?= __('Mobile Number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($religon->applicant as $applicant): ?>
            <tr>
                <td><?= h($applicant->id) ?></td>
                <td><?= h($applicant->name) ?></td>
                <td><?= h($applicant->fname) ?></td>
                <td><?= h($applicant->cnic) ?></td>
                <td><?= h($applicant->religon_id) ?></td>
                <td><?= h($applicant->date_of_birth) ?></td>
                <td><?= h($applicant->current_address) ?></td>
                <td><?= h($applicant->permanent_address) ?></td>
                <td><?= h($applicant->zipcode) ?></td>
                <td><?= h($applicant->email) ?></td>
                <td><?= h($applicant->telephone_number) ?></td>
                <td><?= h($applicant->mobile_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Applicant', 'action' => 'view', $applicant->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Applicant', 'action' => 'edit', $applicant->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applicant', 'action' => 'delete', $applicant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicant->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

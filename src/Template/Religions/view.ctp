<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Religion $religion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Religion'), ['action' => 'edit', $religion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Religion'), ['action' => 'delete', $religion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $religion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Religions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Religion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="religions view large-9 medium-8 columns content">
    <h3><?= h($religion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Rligion Name') ?></th>
            <td><?= h($religion->rligion_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($religion->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Applicants') ?></h4>
        <?php if (!empty($religion->applicants)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Father Or Husband Name') ?></th>
                <th scope="col"><?= __('Religion Id') ?></th>
                <th scope="col"><?= __('Cnic') ?></th>
                <th scope="col"><?= __('Groom Or Bride Name') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($religion->applicants as $applicants): ?>
            <tr>
                <td><?= h($applicants->id) ?></td>
                <td><?= h($applicants->name) ?></td>
                <td><?= h($applicants->father_or_husband_name) ?></td>
                <td><?= h($applicants->religion_id) ?></td>
                <td><?= h($applicants->cnic) ?></td>
                <td><?= h($applicants->groom_or_bride_name) ?></td>
                <td><?= h($applicants->created) ?></td>
                <td><?= h($applicants->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Applicants', 'action' => 'view', $applicants->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Applicants', 'action' => 'edit', $applicants->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applicants', 'action' => 'delete', $applicants->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicants->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

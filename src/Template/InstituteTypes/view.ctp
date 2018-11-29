<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InstituteType $instituteType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Institute Type'), ['action' => 'edit', $instituteType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Institute Type'), ['action' => 'delete', $instituteType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $instituteType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Institute Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Institute Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Institutes'), ['controller' => 'Institutes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Institute'), ['controller' => 'Institutes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="instituteTypes view large-9 medium-8 columns content">
    <h3><?= h($instituteType->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($instituteType->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($instituteType->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Institutes') ?></h4>
        <?php if (!empty($instituteType->institutes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Institute Type Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Institute Sector') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Applicantcontact Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($instituteType->institutes as $institutes): ?>
            <tr>
                <td><?= h($institutes->id) ?></td>
                <td><?= h($institutes->institute_type_id) ?></td>
                <td><?= h($institutes->name) ?></td>
                <td><?= h($institutes->city_id) ?></td>
                <td><?= h($institutes->institute_sector) ?></td>
                <td><?= h($institutes->address) ?></td>
                <td><?= h($institutes->applicantcontact_id) ?></td>
                <td><?= h($institutes->created) ?></td>
                <td><?= h($institutes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Institutes', 'action' => 'view', $institutes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Institutes', 'action' => 'edit', $institutes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Institutes', 'action' => 'delete', $institutes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $institutes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

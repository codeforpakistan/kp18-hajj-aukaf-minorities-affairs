<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SchoolClass $schoolClass
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit School Class'), ['action' => 'edit', $schoolClass->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete School Class'), ['action' => 'delete', $schoolClass->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolClass->id)]) ?> </li>
        <li><?= $this->Html->link(__('List School Classes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School Class'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="schoolClasses view large-9 medium-8 columns content">
    <h3><?= h($schoolClass->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Class Number') ?></th>
            <td><?= h($schoolClass->class_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($schoolClass->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($schoolClass->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($schoolClass->modified) ?></td>
        </tr>
    </table>
</div>

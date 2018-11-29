<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Table1 $table1
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Table1'), ['action' => 'edit', $table1->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Table1'), ['action' => 'delete', $table1->id], ['confirm' => __('Are you sure you want to delete # {0}?', $table1->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Table1s'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Table1'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="table1s view large-9 medium-8 columns content">
    <h3><?= h($table1->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($table1->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($table1->id) ?></td>
        </tr>
    </table>
</div>

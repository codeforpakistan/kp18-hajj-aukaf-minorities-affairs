<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instituteclass $instituteclass
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Instituteclass'), ['action' => 'edit', $instituteclass->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Instituteclass'), ['action' => 'delete', $instituteclass->id], ['confirm' => __('Are you sure you want to delete # {0}?', $instituteclass->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Instituteclasses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Instituteclass'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Institutes'), ['controller' => 'Institutes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Institute'), ['controller' => 'Institutes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="instituteclasses view large-9 medium-8 columns content">
    <h3><?= h($instituteclass->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Institute') ?></th>
            <td><?= $instituteclass->has('institute') ? $this->Html->link($instituteclass->institute->name, ['controller' => 'Institutes', 'action' => 'view', $instituteclass->institute->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class No') ?></th>
            <td><?= h($instituteclass->class_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Students') ?></th>
            <td><?= h($instituteclass->total_students) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minority Students') ?></th>
            <td><?= h($instituteclass->minority_students) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Needy Students') ?></th>
            <td><?= h($instituteclass->needy_students) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Textbook Cost') ?></th>
            <td><?= h($instituteclass->textbook_cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Boys Uniform') ?></th>
            <td><?= h($instituteclass->boys_uniform) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Girls Uniform') ?></th>
            <td><?= h($instituteclass->girls_uniform) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($instituteclass->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($instituteclass->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($instituteclass->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($instituteclass->modified) ?></td>
        </tr>
    </table>
</div>

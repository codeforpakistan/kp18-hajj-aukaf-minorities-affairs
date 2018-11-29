<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Table2 $table2
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Table2'), ['action' => 'edit', $table2->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Table2'), ['action' => 'delete', $table2->id], ['confirm' => __('Are you sure you want to delete # {0}?', $table2->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Table2'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Table2'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="table2 view large-9 medium-8 columns content">
    <h3><?= h($table2->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($table2->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fname') ?></th>
            <td><?= $this->Number->format($table2->fname) ?></td>
        </tr>
    </table>
</div>

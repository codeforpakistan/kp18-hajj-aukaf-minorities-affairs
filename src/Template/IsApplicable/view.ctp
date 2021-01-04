<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IsApplicable $isApplicable
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Is Applicable'), ['action' => 'edit', $isApplicable->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Is Applicable'), ['action' => 'delete', $isApplicable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $isApplicable->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Is Applicable'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Is Applicable'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="isApplicable view large-9 medium-8 columns content">
    <h3><?= h($isApplicable->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Sub Category') ?></th>
            <td><?= $isApplicable->has('sub_category') ? $this->Html->link($isApplicable->sub_category->id, ['controller' => 'SubCategories', 'action' => 'view', $isApplicable->sub_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($isApplicable->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Maritalstatus Id') ?></th>
            <td><?= $this->Number->format($isApplicable->maritalstatus_id) ?></td>
        </tr>
    </table>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InstituteType $instituteType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Institute Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Institutes'), ['controller' => 'Institutes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Institute'), ['controller' => 'Institutes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="instituteTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($instituteType) ?>
    <fieldset>
        <legend><?= __('Add Institute Type') ?></legend>
        <?php
            echo $this->Form->control('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

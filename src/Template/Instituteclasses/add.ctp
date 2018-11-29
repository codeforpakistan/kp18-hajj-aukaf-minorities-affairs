<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instituteclass $instituteclass
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Instituteclasses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Institutes'), ['controller' => 'Institutes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Institute'), ['controller' => 'Institutes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="instituteclasses form large-9 medium-8 columns content">
    <?= $this->Form->create($instituteclass) ?>
    <fieldset>
        <legend><?= __('Add Instituteclass') ?></legend>
        <?php
            echo $this->Form->control('institute_id', ['options' => $institutes]);
            echo $this->Form->control('class_no');
            echo $this->Form->control('total_students');
            echo $this->Form->control('minority_students');
            echo $this->Form->control('needy_students');
            echo $this->Form->control('textbook_cost');
            echo $this->Form->control('boys_uniform');
            echo $this->Form->control('girls_uniform');
            echo $this->Form->control('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

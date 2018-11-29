<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QualificationLevel $qualificationLevel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Qualification Levels'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Disciplines'), ['controller' => 'Disciplines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Discipline'), ['controller' => 'Disciplines', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualifications'), ['controller' => 'Qualifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Qualification'), ['controller' => 'Qualifications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="qualificationLevels form large-9 medium-8 columns content">
    <?= $this->Form->create($qualificationLevel) ?>
    <fieldset>
        <legend><?= __('Add Qualification Level') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

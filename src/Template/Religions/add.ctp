<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Religion $religion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Religions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="religions form large-9 medium-8 columns content">
    <?= $this->Form->create($religion) ?>
    <fieldset>
        <legend><?= __('Add Religion') ?></legend>
        <?php
            echo $this->Form->control('rligion_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

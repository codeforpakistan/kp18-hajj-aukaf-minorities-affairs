<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Religon $religon
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $religon->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $religon->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Religon'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicant'), ['controller' => 'Applicant', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicant', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="religon form large-9 medium-8 columns content">
    <?= $this->Form->create($religon) ?>
    <fieldset>
        <legend><?= __('Edit Religon') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

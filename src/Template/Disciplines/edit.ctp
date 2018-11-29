<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Discipline $discipline
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $discipline->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $discipline->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Disciplines'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Qualification Levels'), ['controller' => 'QualificationLevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Qualification Level'), ['controller' => 'QualificationLevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualifications'), ['controller' => 'Qualifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Qualification'), ['controller' => 'Qualifications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="disciplines form large-9 medium-8 columns content">
    <?= $this->Form->create($discipline) ?>
    <fieldset>
        <legend><?= __('Edit Discipline') ?></legend>
        <?php
            echo $this->Form->control('qualification_level_id', ['options' => $qualificationLevels]);
            echo $this->Form->control('discipline');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

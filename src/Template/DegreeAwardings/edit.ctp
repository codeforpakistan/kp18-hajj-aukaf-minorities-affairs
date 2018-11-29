<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DegreeAwarding $degreeAwarding
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $degreeAwarding->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $degreeAwarding->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Degree Awardings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Qualifications'), ['controller' => 'Qualifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Qualification'), ['controller' => 'Qualifications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="degreeAwardings form large-9 medium-8 columns content">
    <?= $this->Form->create($degreeAwarding) ?>
    <fieldset>
        <legend><?= __('Edit Degree Awarding') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

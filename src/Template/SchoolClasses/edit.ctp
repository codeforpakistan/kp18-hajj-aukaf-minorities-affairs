<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SchoolClass $schoolClass
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $schoolClass->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $schoolClass->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List School Classes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="schoolClasses form large-9 medium-8 columns content">
    <?= $this->Form->create($schoolClass) ?>
    <fieldset>
        <legend><?= __('Edit School Class') ?></legend>
        <?php
            echo $this->Form->control('class_number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

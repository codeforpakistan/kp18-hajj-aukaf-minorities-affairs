<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Maritalstatus $maritalstatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $maritalstatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $maritalstatus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Maritalstatus'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="maritalstatus form large-9 medium-8 columns content">
    <?= $this->Form->create($maritalstatus) ?>
    <fieldset>
        <legend><?= __('Edit Maritalstatus') ?></legend>
        <?php
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

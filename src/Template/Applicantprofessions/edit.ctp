<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicantprofession $applicantprofession
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicantprofession->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicantprofession->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Applicantprofessions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantprofessions form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantprofession) ?>
    <fieldset>
        <legend><?= __('Edit Applicantprofession') ?></legend>
        <?php
            echo $this->Form->control('applicant_id', ['options' => $applicants]);
            echo $this->Form->control('profession');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

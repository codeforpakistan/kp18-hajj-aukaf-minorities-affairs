<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicantcontact $applicantcontact
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicantcontact->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicantcontact->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Applicantcontacts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantcontacts form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantcontact) ?>
    <fieldset>
        <legend><?= __('Edit Applicantcontact') ?></legend>
        <?php
            echo $this->Form->control('applicant_id', ['options' => $applicants]);
            echo $this->Form->control('mob_number');
            echo $this->Form->control('tel_number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

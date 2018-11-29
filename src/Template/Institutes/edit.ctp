<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Institute $institute
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $institute->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $institute->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Institutes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Institute Types'), ['controller' => 'InstituteTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Institute Type'), ['controller' => 'InstituteTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applicantcontacts'), ['controller' => 'Applicantcontacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantcontact'), ['controller' => 'Applicantcontacts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualifications'), ['controller' => 'Qualifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Qualification'), ['controller' => 'Qualifications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="institutes form large-9 medium-8 columns content">
    <?= $this->Form->create($institute) ?>
    <fieldset>
        <legend><?= __('Edit Institute') ?></legend>
        <?php
            echo $this->Form->control('institute_type_id', ['options' => $instituteTypes]);
            echo $this->Form->control('name');
            echo $this->Form->control('city_id', ['options' => $cities]);
            echo $this->Form->control('institute_sector');
            echo $this->Form->control('address');
            echo $this->Form->control('applicantcontact_id', ['options' => $applicantcontacts]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

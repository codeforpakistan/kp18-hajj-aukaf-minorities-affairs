<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Qualification $qualification
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Qualifications'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualification Levels'), ['controller' => 'QualificationLevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Qualification Level'), ['controller' => 'QualificationLevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Disciplines'), ['controller' => 'Disciplines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Discipline'), ['controller' => 'Disciplines', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Institutes'), ['controller' => 'Institutes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Institute'), ['controller' => 'Institutes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Degree Awardings'), ['controller' => 'DegreeAwardings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Degree Awarding'), ['controller' => 'DegreeAwardings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="qualifications form large-9 medium-8 columns content">
    <?= $this->Form->create($qualification) ?>
    <fieldset>
        <legend><?= __('Add Qualification') ?></legend>
        <?php
            echo $this->Form->control('applicant_id', ['options' => $applicants]);
            echo $this->Form->control('qualification_level_id', ['options' => $qualificationLevels]);
            echo $this->Form->control('discipline_id', ['options' => $disciplines]);
            echo $this->Form->control('institute_id', ['options' => $institutes]);
            echo $this->Form->control('degree_awarding_id', ['options' => $degreeAwardings]);
            echo $this->Form->control('education_system');
            echo $this->Form->control('grading_system');
            echo $this->Form->control('total_cgpa');
            echo $this->Form->control('obtained_cgpa');
            echo $this->Form->control('total_marks');
            echo $this->Form->control('obtained_marks');
            echo $this->Form->control('percentage');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

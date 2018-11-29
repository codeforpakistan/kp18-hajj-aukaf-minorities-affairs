<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Qualification $qualification
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Qualification'), ['action' => 'edit', $qualification->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Qualification'), ['action' => 'delete', $qualification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $qualification->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Qualifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Qualification'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Qualification Levels'), ['controller' => 'QualificationLevels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Qualification Level'), ['controller' => 'QualificationLevels', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Disciplines'), ['controller' => 'Disciplines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Discipline'), ['controller' => 'Disciplines', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Institutes'), ['controller' => 'Institutes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Institute'), ['controller' => 'Institutes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Degree Awardings'), ['controller' => 'DegreeAwardings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Degree Awarding'), ['controller' => 'DegreeAwardings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="qualifications view large-9 medium-8 columns content">
    <h3><?= h($qualification->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Applicant') ?></th>
            <td><?= $qualification->has('applicant') ? $this->Html->link($qualification->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $qualification->applicant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Qualification Level') ?></th>
            <td><?= $qualification->has('qualification_level') ? $this->Html->link($qualification->qualification_level->name, ['controller' => 'QualificationLevels', 'action' => 'view', $qualification->qualification_level->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discipline') ?></th>
            <td><?= $qualification->has('discipline') ? $this->Html->link($qualification->discipline->id, ['controller' => 'Disciplines', 'action' => 'view', $qualification->discipline->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institute') ?></th>
            <td><?= $qualification->has('institute') ? $this->Html->link($qualification->institute->name, ['controller' => 'Institutes', 'action' => 'view', $qualification->institute->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Degree Awarding') ?></th>
            <td><?= $qualification->has('degree_awarding') ? $this->Html->link($qualification->degree_awarding->name, ['controller' => 'DegreeAwardings', 'action' => 'view', $qualification->degree_awarding->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Education System') ?></th>
            <td><?= h($qualification->education_system) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grading System') ?></th>
            <td><?= h($qualification->grading_system) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($qualification->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Cgpa') ?></th>
            <td><?= $this->Number->format($qualification->total_cgpa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Obtained Cgpa') ?></th>
            <td><?= $this->Number->format($qualification->obtained_cgpa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Marks') ?></th>
            <td><?= $this->Number->format($qualification->total_marks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Obtained Marks') ?></th>
            <td><?= $this->Number->format($qualification->obtained_marks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Percentage') ?></th>
            <td><?= $this->Number->format($qualification->percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($qualification->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($qualification->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($qualification->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($qualification->modified) ?></td>
        </tr>
    </table>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QualificationLevel $qualificationLevel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Qualification Level'), ['action' => 'edit', $qualificationLevel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Qualification Level'), ['action' => 'delete', $qualificationLevel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $qualificationLevel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Qualification Levels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Qualification Level'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Disciplines'), ['controller' => 'Disciplines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Discipline'), ['controller' => 'Disciplines', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Qualifications'), ['controller' => 'Qualifications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Qualification'), ['controller' => 'Qualifications', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="qualificationLevels view large-9 medium-8 columns content">
    <h3><?= h($qualificationLevel->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($qualificationLevel->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= $this->Number->format($qualificationLevel->name) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Disciplines') ?></h4>
        <?php if (!empty($qualificationLevel->disciplines)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Qualification Level Id') ?></th>
                <th scope="col"><?= __('Discipline') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($qualificationLevel->disciplines as $disciplines): ?>
            <tr>
                <td><?= h($disciplines->id) ?></td>
                <td><?= h($disciplines->qualification_level_id) ?></td>
                <td><?= h($disciplines->discipline) ?></td>
                <td><?= h($disciplines->created) ?></td>
                <td><?= h($disciplines->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Disciplines', 'action' => 'view', $disciplines->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Disciplines', 'action' => 'edit', $disciplines->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Disciplines', 'action' => 'delete', $disciplines->id], ['confirm' => __('Are you sure you want to delete # {0}?', $disciplines->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Qualifications') ?></h4>
        <?php if (!empty($qualificationLevel->qualifications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Applicant Id') ?></th>
                <th scope="col"><?= __('Qualification Level Id') ?></th>
                <th scope="col"><?= __('Discipline Id') ?></th>
                <th scope="col"><?= __('Institute Id') ?></th>
                <th scope="col"><?= __('Degree Awarding Id') ?></th>
                <th scope="col"><?= __('Education System') ?></th>
                <th scope="col"><?= __('Grading System') ?></th>
                <th scope="col"><?= __('Total Cgpa') ?></th>
                <th scope="col"><?= __('Obtained Cgpa') ?></th>
                <th scope="col"><?= __('Total Marks') ?></th>
                <th scope="col"><?= __('Obtained Marks') ?></th>
                <th scope="col"><?= __('Percentage') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($qualificationLevel->qualifications as $qualifications): ?>
            <tr>
                <td><?= h($qualifications->id) ?></td>
                <td><?= h($qualifications->applicant_id) ?></td>
                <td><?= h($qualifications->qualification_level_id) ?></td>
                <td><?= h($qualifications->discipline_id) ?></td>
                <td><?= h($qualifications->institute_id) ?></td>
                <td><?= h($qualifications->degree_awarding_id) ?></td>
                <td><?= h($qualifications->education_system) ?></td>
                <td><?= h($qualifications->grading_system) ?></td>
                <td><?= h($qualifications->total_cgpa) ?></td>
                <td><?= h($qualifications->obtained_cgpa) ?></td>
                <td><?= h($qualifications->total_marks) ?></td>
                <td><?= h($qualifications->obtained_marks) ?></td>
                <td><?= h($qualifications->percentage) ?></td>
                <td><?= h($qualifications->created_by) ?></td>
                <td><?= h($qualifications->modified_by) ?></td>
                <td><?= h($qualifications->created) ?></td>
                <td><?= h($qualifications->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Qualifications', 'action' => 'view', $qualifications->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Qualifications', 'action' => 'edit', $qualifications->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Qualifications', 'action' => 'delete', $qualifications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $qualifications->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Qualification[]|\Cake\Collection\CollectionInterface $qualifications
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Qualification'), ['action' => 'add']) ?></li>
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
<div class="qualifications index large-9 medium-8 columns content">
    <h3><?= __('Qualifications') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qualification_level_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('discipline_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('institute_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('degree_awarding_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('education_system') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grading_system') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_cgpa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('obtained_cgpa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_marks') ?></th>
                <th scope="col"><?= $this->Paginator->sort('obtained_marks') ?></th>
                <th scope="col"><?= $this->Paginator->sort('percentage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($qualifications as $qualification): ?>
            <tr>
                <td><?= $this->Number->format($qualification->id) ?></td>
                <td><?= $qualification->has('applicant') ? $this->Html->link($qualification->applicant->name, ['controller' => 'Applicants', 'action' => 'view', $qualification->applicant->id]) : '' ?></td>
                <td><?= $qualification->has('qualification_level') ? $this->Html->link($qualification->qualification_level->name, ['controller' => 'QualificationLevels', 'action' => 'view', $qualification->qualification_level->id]) : '' ?></td>
                <td><?= $qualification->has('discipline') ? $this->Html->link($qualification->discipline->id, ['controller' => 'Disciplines', 'action' => 'view', $qualification->discipline->id]) : '' ?></td>
                <td><?= $qualification->has('institute') ? $this->Html->link($qualification->institute->name, ['controller' => 'Institutes', 'action' => 'view', $qualification->institute->id]) : '' ?></td>
                <td><?= $qualification->has('degree_awarding') ? $this->Html->link($qualification->degree_awarding->name, ['controller' => 'DegreeAwardings', 'action' => 'view', $qualification->degree_awarding->id]) : '' ?></td>
                <td><?= h($qualification->education_system) ?></td>
                <td><?= h($qualification->grading_system) ?></td>
                <td><?= $this->Number->format($qualification->total_cgpa) ?></td>
                <td><?= $this->Number->format($qualification->obtained_cgpa) ?></td>
                <td><?= $this->Number->format($qualification->total_marks) ?></td>
                <td><?= $this->Number->format($qualification->obtained_marks) ?></td>
                <td><?= $this->Number->format($qualification->percentage) ?></td>
                <td><?= $this->Number->format($qualification->created_by) ?></td>
                <td><?= $this->Number->format($qualification->modified_by) ?></td>
                <td><?= h($qualification->created) ?></td>
                <td><?= h($qualification->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $qualification->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $qualification->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $qualification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $qualification->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

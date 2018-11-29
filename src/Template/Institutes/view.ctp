<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Institute $institute
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Institute'), ['action' => 'edit', $institute->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Institute'), ['action' => 'delete', $institute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $institute->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Institutes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Institute'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Institute Types'), ['controller' => 'InstituteTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Institute Type'), ['controller' => 'InstituteTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicantcontacts'), ['controller' => 'Applicantcontacts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicantcontact'), ['controller' => 'Applicantcontacts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Qualifications'), ['controller' => 'Qualifications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Qualification'), ['controller' => 'Qualifications', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="institutes view large-9 medium-8 columns content">
    <h3><?= h($institute->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Institute Type') ?></th>
            <td><?= $institute->has('institute_type') ? $this->Html->link($institute->institute_type->id, ['controller' => 'InstituteTypes', 'action' => 'view', $institute->institute_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($institute->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $institute->has('city') ? $this->Html->link($institute->city->name, ['controller' => 'Cities', 'action' => 'view', $institute->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institute Sector') ?></th>
            <td><?= h($institute->institute_sector) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($institute->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Applicantcontact') ?></th>
            <td><?= $institute->has('applicantcontact') ? $this->Html->link($institute->applicantcontact->id, ['controller' => 'Applicantcontacts', 'action' => 'view', $institute->applicantcontact->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($institute->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($institute->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($institute->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Qualifications') ?></h4>
        <?php if (!empty($institute->qualifications)): ?>
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
            <?php foreach ($institute->qualifications as $qualifications): ?>
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

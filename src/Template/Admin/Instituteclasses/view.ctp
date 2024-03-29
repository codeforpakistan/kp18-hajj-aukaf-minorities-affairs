<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instituteclass $instituteclass
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Instituteclass'), ['action' => 'edit', $instituteclass->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Instituteclass'), ['action' => 'delete', $instituteclass->id], ['confirm' => __('Are you sure you want to delete # {0}?', $instituteclass->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Instituteclasses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Instituteclass'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List School Classes'), ['controller' => 'SchoolClasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School Class'), ['controller' => 'SchoolClasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Institutes'), ['controller' => 'Institutes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Institute'), ['controller' => 'Institutes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="instituteclasses view large-9 medium-8 columns content">
    <h3><?= h($instituteclass->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('School Class') ?></th>
            <td><?= $instituteclass->has('school_class') ? $this->Html->link($instituteclass->school_class->id, ['controller' => 'SchoolClasses', 'action' => 'view', $instituteclass->school_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institute') ?></th>
            <td><?= $instituteclass->has('institute') ? $this->Html->link($instituteclass->institute->name, ['controller' => 'Institutes', 'action' => 'view', $instituteclass->institute->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class No') ?></th>
            <td><?= h($instituteclass->class_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Students') ?></th>
            <td><?= h($instituteclass->total_students) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minority Students') ?></th>
            <td><?= h($instituteclass->minority_students) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Needy Students') ?></th>
            <td><?= h($instituteclass->needy_students) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Textbook Cost') ?></th>
            <td><?= h($instituteclass->textbook_cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Boys Uniform') ?></th>
            <td><?= h($instituteclass->boys_uniform) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Girls Uniform') ?></th>
            <td><?= h($instituteclass->girls_uniform) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($instituteclass->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($instituteclass->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($instituteclass->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($instituteclass->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $instituteclass->deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Applicants') ?></h4>
        <?php if (!empty($instituteclass->applicants)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Instituteclass Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Father Name') ?></th>
                <th scope="col"><?= __('Husband Name') ?></th>
                <th scope="col"><?= __('Religion Id') ?></th>
                <th scope="col"><?= __('Cnic') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('Domicile') ?></th>
                <th scope="col"><?= __('Maritalstatus Id') ?></th>
                <th scope="col"><?= __('Groom Or Bride Name') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($instituteclass->applicants as $applicants): ?>
            <tr>
                <td><?= h($applicants->id) ?></td>
                <td><?= h($applicants->user_id) ?></td>
                <td><?= h($applicants->instituteclass_id) ?></td>
                <td><?= h($applicants->name) ?></td>
                <td><?= h($applicants->father_name) ?></td>
                <td><?= h($applicants->husband_name) ?></td>
                <td><?= h($applicants->religion_id) ?></td>
                <td><?= h($applicants->cnic) ?></td>
                <td><?= h($applicants->gender) ?></td>
                <td><?= h($applicants->domicile) ?></td>
                <td><?= h($applicants->maritalstatus_id) ?></td>
                <td><?= h($applicants->groom_or_bride_name) ?></td>
                <td><?= h($applicants->image) ?></td>
                <td><?= h($applicants->created) ?></td>
                <td><?= h($applicants->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Applicants', 'action' => 'view', $applicants->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Applicants', 'action' => 'edit', $applicants->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applicants', 'action' => 'delete', $applicants->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicants->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

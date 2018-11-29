<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Apply $apply
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $apply->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $apply->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Applies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'FundCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fund Category'), ['controller' => 'FundCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applies form large-9 medium-8 columns content">
    <?= $this->Form->create($apply) ?>
    <fieldset>
        <legend><?= __('Edit Apply') ?></legend>
        <?php
            echo $this->Form->control('applicant_id', ['options' => $applicants]);
            echo $this->Form->control('fund_category_id', ['options' => $fundCategories]);
            echo $this->Form->control('sub_category_id', ['options' => $subCategories, 'empty' => true]);
            echo $this->Form->control('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

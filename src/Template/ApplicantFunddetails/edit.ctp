<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicantFunddetail $applicantFunddetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicantFunddetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicantFunddetail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Applicant Funddetails'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'FundCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fund Category'), ['controller' => 'FundCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantFunddetails form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantFunddetail) ?>
    <fieldset>
        <legend><?= __('Edit Applicant Funddetail') ?></legend>
        <?php
            echo $this->Form->control('applicant_id', ['options' => $applicants]);
            echo $this->Form->control('fund_category_id', ['options' => $fundCategories, 'empty' => true]);
            echo $this->Form->control('sub_category_id', ['options' => $subCategories]);
            echo $this->Form->control('amount_recived');
            echo $this->Form->control('payment_date');
            echo $this->Form->control('check_number');
            echo $this->Form->control('appling_date', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

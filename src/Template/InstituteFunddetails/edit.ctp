<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InstituteFunddetail $instituteFunddetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $instituteFunddetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $instituteFunddetail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Institute Funddetails'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Funds'), ['controller' => 'Funds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fund'), ['controller' => 'Funds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="instituteFunddetails form large-9 medium-8 columns content">
    <?= $this->Form->create($instituteFunddetail) ?>
    <fieldset>
        <legend><?= __('Edit Institute Funddetail') ?></legend>
        <?php
            echo $this->Form->control('applicant_id', ['options' => $applicants]);
            echo $this->Form->control('fund_id', ['options' => $funds]);
            echo $this->Form->control('amount_recived');
            echo $this->Form->control('payment_date');
            echo $this->Form->control('appling_date');
            echo $this->Form->control('selected');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

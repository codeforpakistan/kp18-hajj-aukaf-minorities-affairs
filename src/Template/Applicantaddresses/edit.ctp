<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicantaddress $applicantaddress
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicantaddress->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicantaddress->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Applicantaddresses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['controller' => 'Applicants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantaddresses form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantaddress) ?>
    <fieldset>
        <legend><?= __('Edit Applicantaddress') ?></legend>
        <?php
            echo $this->Form->control('applicant_id', ['options' => $applicants]);
            echo $this->Form->control('current_address');
            echo $this->Form->control('permenent_address');
            echo $this->Form->control('city');
            echo $this->Form->control('postal_address');
            echo $this->Form->control('zip_code');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Applicant'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="applicant form large-9 medium-8 columns content">
    <?= $this->Form->create($applicant) ?>
    <fieldset>
        <legend><?= __('Add Applicant') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('fname');
            echo $this->Form->control('cnic');
            echo $this->Form->control('religon_id');
            echo $this->Form->control('date_of_birth');
            echo $this->Form->control('current_address');
            echo $this->Form->control('permanent_address');
            echo $this->Form->control('zipcode');
            echo $this->Form->control('email');
            echo $this->Form->control('telephone_number');
            echo $this->Form->control('mobile_number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicant->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Applicants'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="applicants form large-9 medium-8 columns content">
    <?= $this->Form->create($applicant) ?>
    <fieldset>
        <legend><?= __('Edit Applicant') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('fname');
            echo $this->Form->control('cnic');
            echo $this->Form->control('date of birth');
            echo $this->Form->control('current address');
            echo $this->Form->control('permanent address');
            echo $this->Form->control('zipcode');
            echo $this->Form->control('email');
            echo $this->Form->control('telephone number');
            echo $this->Form->control('mobile number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

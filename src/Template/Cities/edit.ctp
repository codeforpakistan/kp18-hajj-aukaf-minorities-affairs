<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $city->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicantaddresses'), ['controller' => 'Applicantaddresses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicantaddress'), ['controller' => 'Applicantaddresses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Institutes'), ['controller' => 'Institutes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Institute'), ['controller' => 'Institutes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cities form large-9 medium-8 columns content">
    <?= $this->Form->create($city) ?>
    <fieldset>
        <legend><?= __('Edit City') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('latitude');
            echo $this->Form->control('longitude');
            echo $this->Form->control('provence');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

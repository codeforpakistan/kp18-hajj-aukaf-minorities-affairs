<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FundCategory $fundCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $fundCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $fundCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applies'), ['controller' => 'Applies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Apply'), ['controller' => 'Applies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Funds'), ['controller' => 'Funds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fund'), ['controller' => 'Funds', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Provided Funds'), ['controller' => 'ProvidedFunds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Provided Fund'), ['controller' => 'ProvidedFunds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fundCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($fundCategory) ?>
    <fieldset>
        <legend><?= __('Edit Fund Category') ?></legend>
        <?php
            echo $this->Form->control('type_of_fund');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

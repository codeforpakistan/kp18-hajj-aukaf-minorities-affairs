<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IsApplicable $isApplicable
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Is Applicable'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['controller' => 'SubCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sub Category'), ['controller' => 'SubCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="isApplicable form large-9 medium-8 columns content">
    <?= $this->Form->create($isApplicable) ?>
    <fieldset>
        <legend><?= __('Add Is Applicable') ?></legend>
        <?php
            echo $this->Form->control('sub_category_id', ['options' => $subCategories]);
            echo $this->Form->control('maritalstatus_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

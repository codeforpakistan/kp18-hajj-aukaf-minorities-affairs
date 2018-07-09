<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Table2 $table2
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $table2->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $table2->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Table2'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="table2 form large-9 medium-8 columns content">
    <?= $this->Form->create($table2) ?>
    <fieldset>
        <legend><?= __('Edit Table2') ?></legend>
        <?php
            echo $this->Form->control('fname');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubCategory $subCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sub Category'), ['action' => 'edit', $subCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sub Category'), ['action' => 'delete', $subCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sub Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'FundCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fund Category'), ['controller' => 'FundCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applies'), ['controller' => 'Applies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Apply'), ['controller' => 'Applies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Funds'), ['controller' => 'Funds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fund'), ['controller' => 'Funds', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Provided Funds'), ['controller' => 'ProvidedFunds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Provided Fund'), ['controller' => 'ProvidedFunds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subCategories view large-9 medium-8 columns content">
    <h3><?= h($subCategory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fund Category') ?></th>
            <td><?= $subCategory->has('fund_category') ? $this->Html->link($subCategory->fund_category->id, ['controller' => 'FundCategories', 'action' => 'view', $subCategory->fund_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Of Fund') ?></th>
            <td><?= h($subCategory->type_of_fund) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($subCategory->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subCategory->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Applies') ?></h4>
        <?php if (!empty($subCategory->applies)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Applicant Id') ?></th>
                <th scope="col"><?= __('Fund Category Id') ?></th>
                <th scope="col"><?= __('Sub Category Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subCategory->applies as $applies): ?>
            <tr>
                <td><?= h($applies->id) ?></td>
                <td><?= h($applies->applicant_id) ?></td>
                <td><?= h($applies->fund_category_id) ?></td>
                <td><?= h($applies->sub_category_id) ?></td>
                <td><?= h($applies->date) ?></td>
                <td><?= h($applies->created) ?></td>
                <td><?= h($applies->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Applies', 'action' => 'view', $applies->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Applies', 'action' => 'edit', $applies->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applies', 'action' => 'delete', $applies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applies->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Funds') ?></h4>
        <?php if (!empty($subCategory->funds)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fund Category Id') ?></th>
                <th scope="col"><?= __('Sub Category Id') ?></th>
                <th scope="col"><?= __('Total Amount') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subCategory->funds as $funds): ?>
            <tr>
                <td><?= h($funds->id) ?></td>
                <td><?= h($funds->fund_category_id) ?></td>
                <td><?= h($funds->sub_category_id) ?></td>
                <td><?= h($funds->total_amount) ?></td>
                <td><?= h($funds->created) ?></td>
                <td><?= h($funds->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Funds', 'action' => 'view', $funds->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Funds', 'action' => 'edit', $funds->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Funds', 'action' => 'delete', $funds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $funds->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Provided Funds') ?></h4>
        <?php if (!empty($subCategory->provided_funds)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Applicant Id') ?></th>
                <th scope="col"><?= __('Fund Category Id') ?></th>
                <th scope="col"><?= __('Sub Category Id') ?></th>
                <th scope="col"><?= __('Amount Recived') ?></th>
                <th scope="col"><?= __('Payment Date') ?></th>
                <th scope="col"><?= __('Check Number') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subCategory->provided_funds as $providedFunds): ?>
            <tr>
                <td><?= h($providedFunds->id) ?></td>
                <td><?= h($providedFunds->applicant_id) ?></td>
                <td><?= h($providedFunds->fund_category_id) ?></td>
                <td><?= h($providedFunds->sub_category_id) ?></td>
                <td><?= h($providedFunds->amount_recived) ?></td>
                <td><?= h($providedFunds->payment_date) ?></td>
                <td><?= h($providedFunds->check_number) ?></td>
                <td><?= h($providedFunds->created) ?></td>
                <td><?= h($providedFunds->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ProvidedFunds', 'action' => 'view', $providedFunds->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ProvidedFunds', 'action' => 'edit', $providedFunds->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProvidedFunds', 'action' => 'delete', $providedFunds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $providedFunds->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit City'), ['action' => 'edit', $city->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete City'), ['action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicantaddresses'), ['controller' => 'Applicantaddresses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicantaddress'), ['controller' => 'Applicantaddresses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Institutes'), ['controller' => 'Institutes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Institute'), ['controller' => 'Institutes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cities view large-9 medium-8 columns content">
    <h3><?= h($city->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($city->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= h($city->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= h($city->longitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Provence') ?></th>
            <td><?= h($city->provence) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($city->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Applicantaddresses') ?></h4>
        <?php if (!empty($city->applicantaddresses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Applicant Id') ?></th>
                <th scope="col"><?= __('Current Address') ?></th>
                <th scope="col"><?= __('Permenent Address') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Postal Address') ?></th>
                <th scope="col"><?= __('Zip Code') ?></th>
                <th scope="col"><?= __('Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($city->applicantaddresses as $applicantaddresses): ?>
            <tr>
                <td><?= h($applicantaddresses->id) ?></td>
                <td><?= h($applicantaddresses->applicant_id) ?></td>
                <td><?= h($applicantaddresses->current_address) ?></td>
                <td><?= h($applicantaddresses->permenent_address) ?></td>
                <td><?= h($applicantaddresses->city_id) ?></td>
                <td><?= h($applicantaddresses->postal_address) ?></td>
                <td><?= h($applicantaddresses->zip_code) ?></td>
                <td><?= h($applicantaddresses->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Applicantaddresses', 'action' => 'view', $applicantaddresses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Applicantaddresses', 'action' => 'edit', $applicantaddresses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applicantaddresses', 'action' => 'delete', $applicantaddresses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantaddresses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Institutes') ?></h4>
        <?php if (!empty($city->institutes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Institute Type Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Institute Sector') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Applicantcontact Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($city->institutes as $institutes): ?>
            <tr>
                <td><?= h($institutes->id) ?></td>
                <td><?= h($institutes->institute_type_id) ?></td>
                <td><?= h($institutes->name) ?></td>
                <td><?= h($institutes->city_id) ?></td>
                <td><?= h($institutes->institute_sector) ?></td>
                <td><?= h($institutes->address) ?></td>
                <td><?= h($institutes->applicantcontact_id) ?></td>
                <td><?= h($institutes->created) ?></td>
                <td><?= h($institutes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Institutes', 'action' => 'view', $institutes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Institutes', 'action' => 'edit', $institutes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Institutes', 'action' => 'delete', $institutes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $institutes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicant'), ['action' => 'edit', $applicant->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicant'), ['action' => 'delete', $applicant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicant->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Religions'), ['controller' => 'Religions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Religion'), ['controller' => 'Religions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicant Attachments'), ['controller' => 'ApplicantAttachments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant Attachment'), ['controller' => 'ApplicantAttachments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicant Household Details'), ['controller' => 'ApplicantHouseholdDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant Household Detail'), ['controller' => 'ApplicantHouseholdDetails', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicantaddresses'), ['controller' => 'Applicantaddresses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicantaddress'), ['controller' => 'Applicantaddresses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicantcontacts'), ['controller' => 'Applicantcontacts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicantcontact'), ['controller' => 'Applicantcontacts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicantincomes'), ['controller' => 'Applicantincomes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicantincome'), ['controller' => 'Applicantincomes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applicantprofessions'), ['controller' => 'Applicantprofessions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicantprofession'), ['controller' => 'Applicantprofessions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applies'), ['controller' => 'Applies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Apply'), ['controller' => 'Applies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Provided Funds'), ['controller' => 'ProvidedFunds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Provided Fund'), ['controller' => 'ProvidedFunds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicants view large-9 medium-8 columns content">
    <h3><?= h($applicant->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($applicant->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Father Or Husband Name') ?></th>
            <td><?= h($applicant->father_or_husband_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Religion') ?></th>
            <td><?= $applicant->has('religion') ? $this->Html->link($applicant->religion->id, ['controller' => 'Religions', 'action' => 'view', $applicant->religion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cnic') ?></th>
            <td><?= h($applicant->cnic) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Groom Or Bride Name') ?></th>
            <td><?= h($applicant->groom_or_bride_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicant->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($applicant->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($applicant->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Applicant Attachments') ?></h4>
        <?php if (!empty($applicant->applicant_attachments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Applicant Id') ?></th>
                <th scope="col"><?= __('Attachments') ?></th>
                <th scope="col"><?= __('Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($applicant->applicant_attachments as $applicantAttachments): ?>
            <tr>
                <td><?= h($applicantAttachments->id) ?></td>
                <td><?= h($applicantAttachments->applicant_id) ?></td>
                <td><?= h($applicantAttachments->attachments) ?></td>
                <td><?= h($applicantAttachments->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ApplicantAttachments', 'action' => 'view', $applicantAttachments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ApplicantAttachments', 'action' => 'edit', $applicantAttachments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ApplicantAttachments', 'action' => 'delete', $applicantAttachments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantAttachments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Applicant Household Details') ?></h4>
        <?php if (!empty($applicant->applicant_household_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Applicant Id') ?></th>
                <th scope="col"><?= __('Dependent Family Members') ?></th>
                <th scope="col"><?= __('Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($applicant->applicant_household_details as $applicantHouseholdDetails): ?>
            <tr>
                <td><?= h($applicantHouseholdDetails->id) ?></td>
                <td><?= h($applicantHouseholdDetails->applicant_id) ?></td>
                <td><?= h($applicantHouseholdDetails->dependent_family_members) ?></td>
                <td><?= h($applicantHouseholdDetails->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ApplicantHouseholdDetails', 'action' => 'view', $applicantHouseholdDetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ApplicantHouseholdDetails', 'action' => 'edit', $applicantHouseholdDetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ApplicantHouseholdDetails', 'action' => 'delete', $applicantHouseholdDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantHouseholdDetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Applicantaddresses') ?></h4>
        <?php if (!empty($applicant->applicantaddresses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Applicant Id') ?></th>
                <th scope="col"><?= __('Current Address') ?></th>
                <th scope="col"><?= __('Permenent Address') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Postal Address') ?></th>
                <th scope="col"><?= __('Zip Code') ?></th>
                <th scope="col"><?= __('Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($applicant->applicantaddresses as $applicantaddresses): ?>
            <tr>
                <td><?= h($applicantaddresses->id) ?></td>
                <td><?= h($applicantaddresses->applicant_id) ?></td>
                <td><?= h($applicantaddresses->current_address) ?></td>
                <td><?= h($applicantaddresses->permenent_address) ?></td>
                <td><?= h($applicantaddresses->city) ?></td>
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
        <h4><?= __('Related Applicantcontacts') ?></h4>
        <?php if (!empty($applicant->applicantcontacts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Applicant Id') ?></th>
                <th scope="col"><?= __('Mob Number') ?></th>
                <th scope="col"><?= __('Tel Number') ?></th>
                <th scope="col"><?= __('Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($applicant->applicantcontacts as $applicantcontacts): ?>
            <tr>
                <td><?= h($applicantcontacts->id) ?></td>
                <td><?= h($applicantcontacts->applicant_id) ?></td>
                <td><?= h($applicantcontacts->mob_number) ?></td>
                <td><?= h($applicantcontacts->tel_number) ?></td>
                <td><?= h($applicantcontacts->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Applicantcontacts', 'action' => 'view', $applicantcontacts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Applicantcontacts', 'action' => 'edit', $applicantcontacts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applicantcontacts', 'action' => 'delete', $applicantcontacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantcontacts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Applicantincomes') ?></h4>
        <?php if (!empty($applicant->applicantincomes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Applicant Id') ?></th>
                <th scope="col"><?= __('Monthly Income') ?></th>
                <th scope="col"><?= __('Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($applicant->applicantincomes as $applicantincomes): ?>
            <tr>
                <td><?= h($applicantincomes->id) ?></td>
                <td><?= h($applicantincomes->applicant_id) ?></td>
                <td><?= h($applicantincomes->monthly_income) ?></td>
                <td><?= h($applicantincomes->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Applicantincomes', 'action' => 'view', $applicantincomes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Applicantincomes', 'action' => 'edit', $applicantincomes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applicantincomes', 'action' => 'delete', $applicantincomes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantincomes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Applicantprofessions') ?></h4>
        <?php if (!empty($applicant->applicantprofessions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Applicant Id') ?></th>
                <th scope="col"><?= __('Profession') ?></th>
                <th scope="col"><?= __('Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($applicant->applicantprofessions as $applicantprofessions): ?>
            <tr>
                <td><?= h($applicantprofessions->id) ?></td>
                <td><?= h($applicantprofessions->applicant_id) ?></td>
                <td><?= h($applicantprofessions->profession) ?></td>
                <td><?= h($applicantprofessions->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Applicantprofessions', 'action' => 'view', $applicantprofessions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Applicantprofessions', 'action' => 'edit', $applicantprofessions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applicantprofessions', 'action' => 'delete', $applicantprofessions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantprofessions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Applies') ?></h4>
        <?php if (!empty($applicant->applies)): ?>
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
            <?php foreach ($applicant->applies as $applies): ?>
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
        <h4><?= __('Related Provided Funds') ?></h4>
        <?php if (!empty($applicant->provided_funds)): ?>
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
            <?php foreach ($applicant->provided_funds as $providedFunds): ?>
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

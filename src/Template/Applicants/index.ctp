<<<<<<< HEAD
<option value="">Select District</option>
<option value="">Abbottabad</option>
<option value="">Bannu</option>
<option value="">Charsada</option>
<option value="">Chitral</option>
<option value="">D I Khan</option>
<option value="">Diamer</option>-
<option value="">Dir</option>
<option value="">Haripur</option>
<option value="">Hazara</option>-
<option value="">Kachi</option>-
<option value="">Karak</option>
<option value="">Kohat</option>
<option value="">Hangu</option>
<option value="">Kohistan</option>-
<option value="">Lakki Marwat</option>
<option value="">Malakand</option>
<option value="">Mansehra</option>
<option value="">Batagram</option>-
<option value="">Mardan</option>
<option value="">Nowshehra</option>
<option value="">Peshawar</option>
<option value="">RISALPUR</option>-
<option value="">Swabi</option>
<option value="">Swat</option>-
<option value="">Shangla</option>-
<option value="">Buner</option>-
<option value="">Tank</option>
=======
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant[]|\Cake\Collection\CollectionInterface $applicants
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicant'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicants index large-9 medium-8 columns content">
    <h3><?= __('Applicants') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cnic') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date of birth') ?></th>
                <th scope="col"><?= $this->Paginator->sort('current address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('permanent address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zipcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('telephone number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicants as $applicant): ?>
            <tr>
                <td><?= $this->Number->format($applicant->id) ?></td>
                <td><?= h($applicant->name) ?></td>
                <td><?= h($applicant->fname) ?></td>
                <td><?= h($applicant->cnic) ?></td>
                <td><?= h($applicant->date of birth) ?></td>
                <td><?= h($applicant->current address) ?></td>
                <td><?= h($applicant->permanent address) ?></td>
                <td><?= h($applicant->zipcode) ?></td>
                <td><?= h($applicant->email) ?></td>
                <td><?= h($applicant->telephone number) ?></td>
                <td><?= h($applicant->mobile number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicant->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicant->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicant->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
>>>>>>> parent of 5c021008... code cleaned

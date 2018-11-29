<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fund[]|\Cake\Collection\CollectionInterface $funds
 */
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Funds

            </h2>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= __('View Funds') ?>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href='<?= $this->request->webroot . 'admin/Funds/add'; ?>'>Add Funds</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('fund_category_id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('sub_category_id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('fund_name') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('amount_remaining') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('receiving_date') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('last_date') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('fund_for_year') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('institute_students', 'Students per institute') ?></th>

                                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('fund_category_id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('sub_category_id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('fund_name') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('amount_remaining') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('receiving_date') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('last_date') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('fund_for_year') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('institute_students') ?></th>

                                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($funds as $fund): ?>
                                        <tr>
                                            <td><?= $this->Number->format($fund->id) ?></td>
                                            <td><?= $fund->has('fund_category') ? $this->Html->link($fund->fund_category->type_of_fund, ['controller' => 'FundCategories', 'action' => 'view', $fund->fund_category->id]) : '' ?></td>
                                            <td><?= $fund->has('sub_category') ? $this->Html->link($fund->sub_category->type_of_fund, ['controller' => 'SubCategories', 'action' => 'view', $fund->sub_category->id]) : '' ?></td>
                                            <td><?= h($fund->fund_name) ?></td>
                                            <td><?= h($fund->total_amount) ?></td>
                                            <td><?= h($fund->amount_remaining) ?></td>
                                            <td><?= h($fund->receiving_date) ?></td>
                                            <td><?= h($fund->last_date) ?></td>
                                            <td><?= h($fund->fund_for_year) ?></td>
                                            <td><?= h($fund->institute_students) ?></td>

                                            <td><?= $this->Number->format($fund->active) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), ['action' => 'view', $fund->id], array('escape' => false)) ?>
                                                <?= $this->Html->link(__('<i class="glyphicon glyphicon-edit"></i>'), ['action' => 'edit', $fund->id], array('escape' => false)) ?>
                                                <?= $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), ['action' => 'delete', $fund->id], array('escape' => false), ['confirm' => __('Are you sure you want to delete # {0}?', $fund->id)]) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>



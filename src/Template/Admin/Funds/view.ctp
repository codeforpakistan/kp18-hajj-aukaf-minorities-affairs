<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fund $fund
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
                                        <li><a href='<?= $this->request->webroot . 'admin/Funds'; ?>'>View Funds</a></li>
                                       
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                   <h3><?= h($fund->id) ?></h3>
                                           
                                    <tr>
                                        <th scope="row"><?= __('Fund Category') ?></th>
                                        <td><?= $fund->has('fund_category') ? $this->Html->link($fund->fund_category->type_of_fund, ['controller' => 'FundCategories', 'action' => 'view', $fund->fund_category->id]) : '' ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Sub Category') ?></th>
                                        <td><?= $fund->has('sub_category') ? $this->Html->link($fund->sub_category->type_of_fund, ['controller' => 'SubCategories', 'action' => 'view', $fund->sub_category->id]) : '' ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Fund Name') ?></th>
                                        <td><?= h($fund->fund_name) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Total Amount') ?></th>
                                        <td><?= h($fund->total_amount) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Id') ?></th>
                                        <td><?= $this->Number->format($fund->id) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Amount Remaining') ?></th>
                                        <td><?= h($fund->Amount_remaining) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Last Date') ?></th>
                                        <td><?= h($fund->last_date) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Fund For Year') ?></th>
                                        <td><?= h($fund->fund_for_year) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Receiving Date') ?></th>
                                        <td><?= h($fund->receiving_date) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Status') ?></th>
                                        <td><?= $this->Number->format($fund->status) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Created') ?></th>
                                        <td><?= h($fund->created) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Modified') ?></th>
                                        <td><?= h($fund->modified) ?></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>






<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubCategory $subCategory
 */
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                   Fund Sub Categories
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= __('View Fund Sub Categories') ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/sub_categories/add'; ?>'>Add Sub Categories</a></li>
                                        <li><a href='<?= $this->request->webroot . 'admin/sub_categories'; ?>'>View Sub Categories</a></li>
                                       
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                   <h3><?= h($subCategory->id) ?></h3>
                                           
                                     <tr>
                                        <th scope="row"><?= __('Fund Category') ?></th>
                                        <td><?= $subCategory->has('fund_category') ? $this->Html->link($subCategory->fund_category->type_of_fund, ['controller' => 'FundCategories', 'action' => 'view', $subCategory->fund_category->id]) : '' ?></td>
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
                                        <th scope="row"><?= __('Status') ?></th>
                                        <td><?= h($subCategory->status) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Id') ?></th>
                                        <td><?= $this->Number->format($subCategory->id) ?></td>
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






<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubCategory[]|\Cake\Collection\CollectionInterface $subCategories
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
                                            <th scope="col"><?= $this->Paginator->sort('type_of_fund') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('fund_category_id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('type_of_fund') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                          <?php foreach ($subCategories as $subCategory): ?>
                                            <tr>
                                                <td><?= $this->Number->format($subCategory->id) ?></td>
                                                <td><?= $subCategory->has('fund_category') ? $this->Html->link($subCategory->fund_category->type_of_fund, ['controller' => 'FundCategories', 'action' => 'view', $subCategory->fund_category->id]) : '' ?></td>
                                                <td><?= h($subCategory->type_of_fund) ?></td>
                                                <td><?= h($subCategory->description) ?></td>
                                                <td><?= h($subCategory->status) ?></td>
                                                <td class="actions">
                                                    <?= $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), ['action' => 'view', $subCategory->id],array('escape' => false)) ?>
                                                    <?= $this->Html->link(__('<i class="glyphicon glyphicon-edit"></i>'), ['action' => 'edit', $subCategory->id],array('escape' => false)) ?>
                                                    <?= $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), ['action' => 'delete', $subCategory->id],array('escape' => false), ['confirm' => __('Are you sure you want to delete # {0}?', $subCategory->id)]) ?>
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



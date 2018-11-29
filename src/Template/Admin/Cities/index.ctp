<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City[]|\Cake\Collection\CollectionInterface $cities
 */
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Districts
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= __('View Districts') ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/Cities/add'; ?>'>Add Districts</a></li>
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
                                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('latitude') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('longitude') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('provence') ?></th>
                                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            
                                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                                <th scope="col"><?= $this->Paginator->sort('latitude') ?></th>
                                                <th scope="col"><?= $this->Paginator->sort('longitude') ?></th>
                                                <th scope="col"><?= $this->Paginator->sort('provence') ?></th>
                                                <th scope="col" class="actions"><?= __('Actions') ?></th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                          <?php foreach ($cities as $city): ?>
                                        <tr>
                                                    <td><?= $this->Number->format($city->id) ?></td>
                                                    <td><?= h($city->name) ?></td>
                                                    <td><?= h($city->latitude) ?></td>
                                                    <td><?= h($city->longitude) ?></td>
                                                    <td><?= h($city->provence) ?></td>
                                                    <td class="actions">
                                                        <?= $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), ['action' => 'view', $city->id],array('escape' => false)) ?>
                                                        <?= $this->Html->link(__('<i class="glyphicon glyphicon-edit"></i>'), ['action' => 'edit', $city->id],array('escape' => false)) ?>
                                                        <?= $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), ['action' => 'delete', $city->id],array('escape' => false), ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]) ?>
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





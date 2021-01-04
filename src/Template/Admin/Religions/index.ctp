<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Religion[]|\Cake\Collection\CollectionInterface $religions
 */
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Religions
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= __('View Religions') ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/Religions/add'; ?>'>Add Religions</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <tr>
                                                <th><?= $this->Paginator->sort('id') ?></th>
                                                <th><?= $this->Paginator->sort('religion_name') ?></th>
                                                <th  class="actions"><?= __('Actions') ?></th>
            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            
                                                <th><?= $this->Paginator->sort('id') ?></th>
                                                <th><?= $this->Paginator->sort('religion_name') ?></th>
                                                <th class="actions"><?= __('Actions') ?></th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                          <?php foreach ($religions as $religion): ?>
                                        <tr>
                                                    <td><?= $this->Number->format($religion->id) ?></td>
                                                    <td><?= h($religion->religion_name) ?></td>
                                                    <td class="actions">
                                                        <?= $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), ['action' => 'view', $religion->id],array('escape' => false)) ?>
                                                        <?= $this->Html->link(__('<i class="glyphicon glyphicon-edit"></i>'), ['action' => 'edit', $religion->id],array('escape' => false)) ?>
                                                        <?= $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), ['action' => 'delete', $religion->id],array('escape' => false), ['confirm' => __('Are you sure you want to delete # {0}?', $religion->id)]) ?>
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




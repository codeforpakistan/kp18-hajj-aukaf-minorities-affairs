<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Institute[]|\Cake\Collection\CollectionInterface $institutes
 */
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                     Institutes
                    
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= __('View Institutes') ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/Institutes/add'; ?>'>Add Institutes</a></li>
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
                                            <th scope="col"><?= $this->Paginator->sort('institute_type_id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('institute_sector') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                                             <th scope="col" class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('institute_type_id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('institute_sector') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                                             <th scope="col" class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($institutes as $institute): ?>
                                        <tr>
                                            <td><?= $this->Number->format($institute->id) ?></td>
                                            <td><?= $institute->has('institute_type') ? $this->Html->link($institute->institute_type->type, ['controller' => 'InstituteTypes', 'action' => 'view', $institute->institute_type->id]) : '' ?></td>
                                            <td><?= h($institute->name) ?></td>
                                            <td><?= $institute->has('city') ? $this->Html->link($institute->city->name, ['controller' => 'Cities', 'action' => 'view', $institute->city->id]) : '' ?></td>
                                            <td><?= h($institute->institute_sector) ?></td>
                                            <td><?= h($institute->address) ?></td>
                                             <td class="actions">
                                                <?= $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), ['action' => 'view', $institute->id],array('escape' => false)) ?>
                                                <?= $this->Html->link(__('<i class="glyphicon glyphicon-edit"></i>'), ['action' => 'edit', $institute->id],array('escape' => false)) ?>
                                                <?= $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), ['action' => 'delete', $institute->id],array('escape' => false), ['confirm' => __('Are you sure you want to delete # {0}?', $institute->id)]) ?>
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




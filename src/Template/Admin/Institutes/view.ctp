<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Institute $institute
 */
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Institute Types
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              View Institute Types  
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/InstituteTypes/add'; ?>'>Add Institute Types</a></li>
                                        <li><a href='<?= $this->request->webroot . 'admin/InstituteTypes'; ?>'>View Institute Types</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                               <h3><?= h($institute->name) ?></h3> 
                               <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <tr>
                                        <th scope="row"><?= __('Institute Type') ?></th>
                                        <td><?= $institute->has('institute_type') ? $this->Html->link($institute->institute_type->type, ['controller' => 'InstituteTypes', 'action' => 'view', $institute->institute_type->id]) : '' ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Name') ?></th>
                                        <td><?= h($institute->name) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('City') ?></th>
                                        <td><?= $institute->has('city') ? $this->Html->link($institute->city->name, ['controller' => 'Cities', 'action' => 'view', $institute->city->id]) : '' ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Institute Sector') ?></th>
                                        <td><?= h($institute->institute_sector) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Address') ?></th>
                                        <td><?= h($institute->address) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Id') ?></th>
                                        <td><?= $this->Number->format($institute->id) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Created') ?></th>
                                        <td><?= h($institute->created) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Modified') ?></th>
                                        <td><?= h($institute->modified) ?></td>
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






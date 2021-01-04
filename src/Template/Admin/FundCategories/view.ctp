<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $fundCategory
 */
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                  Fund Categories
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              View Fund Categories
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/fund_categories/add'; ?>'>Add Fund Categories</a></li>
                                        <li><a href='<?= $this->request->webroot . 'admin/fund_categories'; ?>'>View Fund Categories</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                   <h3> <?= h($fundCategory->id) ?></h3>

                                     <tr>
                                        <th scope="row"><?= __('Type Of Fund') ?></th>
                                        <td><?= h($fundCategory->type_of_fund) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Description') ?></th>
                                        <td><?= h($fundCategory->description) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Id') ?></th>
                                        <td><?= $this->Number->format($fundCategory->id) ?></td>
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




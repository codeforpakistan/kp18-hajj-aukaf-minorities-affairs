<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InstituteType $instituteType
 */
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Institute Type
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= __('View Institute Types') ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/instituteTypes/add'; ?>'>Add Institute Type</a></li>
                                        <li><a href='<?= $this->request->webroot . 'admin/instituteTypes'; ?>'>View Institute Type</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                   <h3><?= h($instituteType->id) ?></h3>
                                           
                                    <tr>
                                        <th scope="row"><?= __('Type') ?></th>
                                        <td><?= h($instituteType->type) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Id') ?></th>
                                        <td><?= $this->Number->format($instituteType->id) ?></td>
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



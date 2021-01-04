<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
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
                                        <li><a href='<?= $this->request->webroot . 'admin/Cities'; ?>'>View Districts</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                   <h3><?= h($city->name) ?></h3>
                                           
                                    <tr>
                                    <th scope="row"><?= __('Name') ?></th>
                                    <td><?= h($city->name) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Latitude') ?></th>
                                    <td><?= h($city->latitude) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Longitude') ?></th>
                                    <td><?= h($city->longitude) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Provence') ?></th>
                                    <td><?= h($city->provence) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Id') ?></th>
                                    <td><?= $this->Number->format($city->id) ?></td>
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



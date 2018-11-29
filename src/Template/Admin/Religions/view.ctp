<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Religion $religion
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
                                        <li><a href='<?= $this->request->webroot . 'admin/Religions'; ?>'>View Religions</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                   <h3><?= h($religion->id) ?></h3>
                                           
                                    <tr>
                                    <th scope="row"><?= __('Rligion Name') ?></th>
                                    <td><?= h($religion->religion_name) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Id') ?></th>
                                    <td><?= $this->Number->format($religion->id) ?></td>
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



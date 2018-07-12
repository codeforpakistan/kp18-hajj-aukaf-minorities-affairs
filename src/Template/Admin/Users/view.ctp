<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Users
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= __('View Users') ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/Users/add'; ?>'>Add Users</a></li>
                                        <li><a href='<?= $this->request->webroot . 'admin/Users'; ?>'>View Users</a></li>
                                       
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                   <h3><?= h($user->id) ?></h3>
                                           
                                    <tr>
                                    <th scope="row"><?= __('Role') ?></th>
                                    <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Username') ?></th>
                                    <td><?= h($user->username) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Phone') ?></th>
                                    <td><?= h($user->phone) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Address') ?></th>
                                    <td><?= h($user->address) ?></td>
                                </tr>

                                <tr>
                                    <th scope="row"><?= __('Email') ?></th>
                                    <td><?= h($user->email) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Photo') ?></th>
                                    <td><?= h($user->photo) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Id') ?></th>
                                    <td><?= $this->Number->format($user->id) ?></td>
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





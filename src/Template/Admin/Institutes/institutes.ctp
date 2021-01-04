<?php
use Cake\Datasource\ConnectionManager;
$conn = ConnectionManager::get('default');
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
                                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('reg_num', 'Registration Number') ?></th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Affiliation</th>
                                        <th>Contact Number</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">City</th>
                                        <th scope="col">total students</th>

                                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ($institutes as $institute):
                                        $count_inserted_students = $conn->execute('SELECT COUNT(*) as total FROM `institute_funddetails` as ifd JOIN applicants as a ON ifd.applicant_id= a.id JOIN instituteclasses as i ON a.instituteclass_id= i.id WHERE i.institute_id=' . $institute['id'] . ' AND ifd.fund_id=' . $this->request->params['pass'][0]);
                                        $results = $count_inserted_students->fetchAll('assoc');
                                        ?>
                                        <tr>
                                            <td><?= h($institute['institute_name']); ?></td>
                                            <td><?= $institute['reg_num'] ?></td>
                                            <td><?= $institute['email'] ?></td>
                                            <td><?= $institute['photo_of_affiliation'] ?></td>
                                            <td><?= $institute['contact_number'] ?></td>
                                            <td><?= $institute['address'] ?></td>
                                            <td><?= $institute['city_name']; ?></td>
                                            <td style="color:green"><?= $results[0]['total'] ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('Classes'), ['controller' => 'Instituteclasses', 'action' => 'index', $institute['id'], $this->request->params['pass'][0]], array('class' => 'btn btn-primary btn-sm', 'escape' => false)) ?>
                                                <!--< $this->Html->link(__(''), ['action' => 'edit', $institute->id], array('escape' => false)) ?>-->
                                               <!--< $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), ['action' => 'delete', $institute->id],array('escape' => false), ['confirm' => __('Are you sure you want to delete # {0}?', $institute->id)]) ?>-->
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




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
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Edit Users</h2>
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
                        <?= $this->Form->create($user, ['id' => 'form_validation', 'type' => 'file']) ?>

                        <div class="form-group form-float">

                            <div class="form-line">
                                <?php echo $this->Form->control('role_id', ['empty' => 'Select Role', 'class' => 'form-control show-tick', 'label' => false,'required']); ?>

                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('name', ['class' => 'form-control','required']); ?>
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('phone', ['class' => 'form-control','required']); ?>
                                <label class="form-label">Phone No</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('address', ['class' => 'form-control','required']); ?>
                                <label class="form-label">Address</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <?php echo $this->Form->password('password', ['class' => 'form-control', 'value' => '', 'label' => false]); ?>
                                <label class="form-label">Password</label>
                            </div>

                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => false,'required']); ?>
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                        <?php if (file_exists(WWW_ROOT . 'img' . DS . 'applicants' . DS . $user->photo) && $user->photo) { ?>
                            <div class="form-group form-float">
                                <div class="form">
                                    <img width="100" src="<?php echo $this->request->webroot . 'img/applicants/' . $user->photo; ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group form-float">
                            <div class="form">
                                <label class="form-label">Profile Photo</label>
                                <?php echo $this->Form->control('photo', ['secure' => false, 'type' => 'file', 'multiple' => false, 'label' => false]); ?>

                            </div>
                        </div>


                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->


    </div>
</section>




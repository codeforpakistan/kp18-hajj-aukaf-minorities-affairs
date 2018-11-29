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
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Religions</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/Religions'; ?>'>View Religion</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <?= $this->Form->create($religion,['id'=>'form_validation']) ?>
                            
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('religion_name',['class'=>'form-control']);?>
                                       <label class="form-label">Religion Name</label>
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






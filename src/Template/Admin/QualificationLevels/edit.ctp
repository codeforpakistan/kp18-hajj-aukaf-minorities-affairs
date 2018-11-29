<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QualificationLevel $qualificationLevel
 */
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Qualification Level
                </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Qualification Level</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/qualification_levels'; ?>'>View Qualification Level</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <?= $this->Form->create($qualificationLevel,['id'=>'form_validation']) ?>
                            
                            
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('name',['class'=>'form-control']);?>
                                       <label class="form-label">Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                   
                                    <div class="form-line">
                                        <?php echo $this->Form->control('institute_type_id', ['empty' => 'Select Institute Type','options' ,'class'=>'form-control show-tick','label'=>false]);?>
                                       
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







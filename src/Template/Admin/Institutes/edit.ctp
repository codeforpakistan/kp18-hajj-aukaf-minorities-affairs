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
                     Institutes
                </h2>
            </div>
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Institute</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/institutes'; ?>'>View Institutes</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="body">
                            <?= $this->Form->create($institute,['id'=>'form_validation','type' => 'file']) ?>
                                
                               <div class="form-group form-float">
                                   
                                    <div class="form-line">
                                        <?php echo $this->Form->control('institute_type_id', ['empty' => 'Institute Type','$instituteTypes' ,'class'=>'form-control show-tick','label'=>false]);?>
                                       
                                    </div>
                                </div>
                            
                                <div class="form-group form-float">
                                    <div class="form-line">
                                       <?php echo $this->Form->text('name',['class'=>'form-control']);?>
                                       <label class="form-label">Institute Name</label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                   
                                    <div class="form-line">
                                        <?php echo $this->Form->control('city_id', ['empty' => 'Cities','$cities' ,'class'=>'form-control show-tick','label'=>false]);?>
                                       
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                       <?php echo $this->Form->text('institute_sector',['class'=>'form-control']);?>
                                       <label class="form-label">Institute Sector</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                       <?php echo $this->Form->text('address',['class'=>'form-control']);?>
                                       <label class="form-label">Address</label>
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
    



<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Institutes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Institute Types'), ['controller' => 'InstituteTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Institute Type'), ['controller' => 'InstituteTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualifications'), ['controller' => 'Qualifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Qualification'), ['controller' => 'Qualifications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="institutes form large-9 medium-8 columns content">
    <?= $this->Form->create($institute) ?>
    <fieldset>
        <legend><?= __('Add Institute') ?></legend>
        <?php
            echo $this->Form->control('institute_type_id', ['options' => $instituteTypes]);
            echo $this->Form->control('name');
            echo $this->Form->control('city_id', ['options' => $cities]);
            echo $this->Form->control('institute_sector');
            echo $this->Form->control('address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubCategory $subCategory
 */
?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Fund Sub Category
                </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Fund Sub Category</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href='<?= $this->request->webroot . 'admin/sub_categories'; ?>'>View Fund Sub Category</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <?= $this->Form->create($subCategory,['id'=>'form_validation']) ?>
                             <div class="form-group form-float">
                                   
                                    <div class="form-line">
                                        <?php echo $this->Form->control('fund_category_id', ['empty' => 'Select Fund Category','options' => $fundCategories ,'class'=>'form-control show-tick','label'=>false]);?>
                                       
                                    </div>
                                </div>
                            
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('type_of_fund',['class'=>'form-control']);?>
                                       <label class="form-label">Sub Category Name</label>
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->text('description',['class'=>'form-control']);?>
                                       <label class="form-label">Description</label>
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <?php echo $this->Form->checkbox('status',['class'=>'filled-in','checked'=>'checked','required'=>'','id'=>'remember_me']);?>
                                       <label for="remember_me">Status</label>
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









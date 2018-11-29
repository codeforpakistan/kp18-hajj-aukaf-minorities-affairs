<div id="content">
    <div class="container">
        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?= $this->request->webroot; ?>Institutes/add">Profile</a>
                </li>
                <li class="current">
                    <a href="<?= $this->request->webroot . 'Instituteclasses/index/' . $this->request->params['pass'][1]; ?>" title="">List of classes</a>
                </li>
                <li class="current">
                    <a href="#" title="">Edit class</a>
                </li>
            </ul>

        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <?= $this->Form->create($instituteclass, ['class' => 'form-horizontal']) ?>

                <div class="col-md-12">
                    <div class="widget">
                        <div class="widget-header">
                            <br/>
                            <h4 style="font-size: 16px !important;">Add Class & Provide Information Regarding Minority Students(Class Wise)</h4>
                        </div>
                        <div class="widget-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $this->Flash->render() ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Select Class<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('school_class_id', ['label' => false, 'class' => 'form-control', 'empty' => 'Select Class', 'options' => $schoolclasses, 'required']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Total Students<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('total_students', ['placeholder' => 'Total No. of Students', 'label' => false, 'class' => 'form-control', 'required']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Minority Students<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('minority_students', ['id' => 'minority_students', 'placeholder' => 'Total No. of Minority Students', 'label' => false, 'class' => 'form-control', 'required']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Deserving Minority Students<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('needy_students', ['id' => 'needy_students', 'label' => false, 'class' => 'form-control', 'readonly', 'required']); ?>
                                            <span class="help-block">No. of Needy & Deserving Minority Students(up to 30 % only)</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Cost of textbooks<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('textbook_cost', ['placeholder' => 'Cost of textbooks including notebooks (per set)', 'label' => false, 'class' => 'form-control', 'required']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Cost of uniform for Boys<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('boys_uniform', ['placeholder' => 'Cost of uniform for Boys (per set)', 'label' => false, 'class' => 'form-control', 'required']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Cost of uniform for Girls<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('girls_uniform', ['placeholder' => 'Cost of uniform for Girls (per set)', 'label' => false, 'class' => 'form-control', 'required']); ?>
                                        </div>
                                    </div>
                                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary pull-right']); ?>
                                </div>
                            </div> 
                            <!-- /.row -->
                        </div> <!-- /.widget-content -->
                    </div> <!-- /.widget -->
                </div> <!-- /.col-md-12 -->
                <?php echo $this->Form->end(); ?>
            </div>
        </div> <!-- /.row -->
        <!-- /Page Content -->
    </div>
    <!-- /.container -->

</div>
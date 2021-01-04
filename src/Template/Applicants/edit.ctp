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
                    <a href="<?= $this->request->webroot . 'Instituteclasses/index/' . $this->request->params['pass'][2]; ?>" title="">List of classes</a>
                </li>
                <li class="current">
                    <a href="<?= $this->request->webroot . 'Applicants/addapplicant/' . $this->request->params['pass'][1].'/'.$this->request->params['pass'][2]; ?>" title="">Students</a>
                </li>
                <li class="current">
                    <a href="#" title="">Edit Students</a>
                </li>

            </ul>

        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <?= $this->Form->create($applicant, ['class' => 'form-horizontal', 'id' => 'education_form']) ?>
                <div class="col-md-12">
                    <div class="widget">
                        <div class="widget-header">
                            <h4>General Information</h4>
                        </div>
                        <div class="widget-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Full name<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('Applicants.name', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Father Name<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('Applicants.father_name', ['label' => false, 'class' => 'form-control', 'required']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Father CNIC<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('Applicants.cnic', ['label' => false, 'class' => 'form-control', 'data-mask' => '99999-9999999-9', 'required']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Domicile</label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('Applicants.domicile', ['id' => 'domicile', 'label' => false, 'options' => $cities, 'class' => 'select2-select-00 col-md-12 full-width-fix']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Religion<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('Applicants.religion_id', ['label' => false, 'class' => 'form-control', 'empty' => 'Select Religion', 'options' => $religions, 'required']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Gender<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php
                                            echo $this->Form->control('Applicants.gender', ['type' => 'radio', 'class' => 'uniform', 'label' => false, 'options' => array('male' => 'Male', 'female' => 'Female', 'other' => 'Other'),
                                                'templates' => [
                                                    'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                    'inputContainer' => '{{content}}'
                                                ], 'required']);
                                            ?>
                                        </div>
                                    </div>

                                </div>

                            </div> 
                            <!-- /.row -->
                        </div> <!-- /.widget-content -->
                    </div> <!-- /.widget -->
                </div> <!-- /.col-md-12 -->
                <div class="col-md-12 form-vertical no-margin">
                    <div class="widget">
                        <div class="widget-header">
                            <h4>Contact Details</h4>
                        </div>

                        <div class="widget-content">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Contact number<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('Applicantcontacts.mob_number', ['label' => false, 'class' => 'form-control', 'value' => $applicant->applicantcontacts[0]->mob_number, 'required']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Address<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('Applicantaddresses.current_address', ['label' => false, 'class' => 'form-control', 'value' => $applicant->applicantaddresses[0]->current_address, 'required']); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">District<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('Applicantaddresses.city_id', ['label' => false, 'id' => 'city_dropdown', 'class' => 'select2-select-00 col-md-12 full-width-fix', 'value' => $applicant->applicantaddresses[0]->city_id, 'required']);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.row -->
                        </div> <!-- /.widget-content -->
                    </div> <!-- /.widget -->
                    <div class="form-actions">
                        <?= $this->Form->button(__('Save Account'), ['class' => 'btn btn-sm btn-primary pull-right']); ?>
                    </div>
                </div>

                <?php echo $this->Form->end(); ?>

            </div>
        </div> <!-- /.row -->
        <!-- /Page Content -->
    </div>
    <!-- /.container -->

</div>
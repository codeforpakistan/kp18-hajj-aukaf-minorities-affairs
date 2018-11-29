<?php
//debug();exit();
?>
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
                    <a href="#" title="">Students</a>
                </li>
            </ul>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12" style="padding:0 25px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="widget-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $this->Flash->render(); ?>
                                    </div>
                                    <br/>
                                    <h4 style="font-weight: bold;">List Of Minority Students Of Class <span style="text-transform: uppercase;"><?= $class->school_class->class_number; ?></span></h4>
                                    <br/>
                                    <table id="student_table" class="table table-responsive table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <!--<th>S.No</th>-->
                                                <th>Name</th>
                                                <th>Father Name</th>
                                                <th>Father CNIC</th>
                                                <th>Domicile</th>
                                                <th>Religion</th>
                                                <th>Gender</th>
                                                <th>Contact Number</th>
                                                <th>Address</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($class_applicants as $key => $instituteclass):
                                                ?>
                                                <tr id="class_row<?php echo$key ?>">
                                                    <td>
                                                        <?php echo $instituteclass->name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass->father_name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass->cnic; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $cities[$instituteclass->domicile]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass->religion->religion_name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass->gender; ?>
                                                    </td>
                                                    <td><?php
                                                        echo $instituteclass->applicantcontacts[0]->mob_number;
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        echo $instituteclass->applicantaddresses[0]->current_address;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?= $this->Html->link(__('<i class="icon-edit"></i>&nbsp;Edit'), ['action' => 'edit', $instituteclass->id, $this->request->params['pass'][0], $this->request->params['pass'][1]], ['escape' => false, 'class' => 'btn btn-primary btn-sm']) ?>
                                                        <?= $this->Form->postLink(__('<i class="icon-trash"></i> &nbsp;Delete'), ['action' => 'delete', $instituteclass->id, $this->request->params['pass'][0], $this->request->params['pass'][1]], ['escape' => false, 'class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete # {0}?', $instituteclass->id)]) ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <a href="#" class="btn btn-sm btn-success pull-right" id="addapplicant" onclick="reset_qualification_form()">Add Applicant</a>
                                </div> 
                                <!-- /.row -->
                            </div> <!-- /.widget-content -->
                        </div> <!-- /.widget -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.tab-content -->
                <!--</div>-->
                <!--END TABS-->
            </div>
        </div> <!-- /.row -->

        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <?= $this->Form->create($applicant, ['class' => 'form-horizontal', 'id' => 'education_form', 'type' => 'file', 'style' => 'display:none']) ?>
                <div class="col-md-12">
                    <div class="widget">
                        <div class="widget-header">
                            <h4>General Information</h4>
                        </div>
                        <div class="widget-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <!--                                    <div class="form-group">
                                                                            <label class="col-md-4 control-label">Fund<span class="required"> *</span></label>
                                                                            <div class="col-md-8">
                                    <?php // echo $this->Form->control('InstituteFunddetails.fund_id', ['label' => false, 'class' => 'form-control','options'=>$funds ,'required']); ?>
                                                                            </div>
                                                                        </div>-->

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
                                            <?php echo $this->Form->control('Applicantcontacts.mob_number', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Address<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('Applicantaddresses.current_address', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">District<span class="required"> *</span></label>
                                        <div class="col-md-8">
                                            <?php echo $this->Form->control('Applicantaddresses.city_id', ['label' => false, 'id' => 'city_dropdown', 'class' => 'select2-select-00 col-md-12 full-width-fix', 'required']);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.row -->
                        </div> <!-- /.widget-content -->
                    </div> <!-- /.widget -->
                    <div class="form-actions">

                        <a href="#" class="btn btn-sm btn-primary pull-right" id="canceladdapplicant" onclick="reset_qualification_form()">cancel</a>

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
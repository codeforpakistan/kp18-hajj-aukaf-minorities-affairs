
<div id="content">
    <div class="container">

        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
                <li class="current">
                    <a href="#" title="">My Profile</a>
                </li>
            </ul>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <!-- Tabs-->
                <!--<div class="tabbable tabbable-custom tabbable-full-width">-->
                <div class="row">
                    <div class="col-md-12">
                        <?= $this->Flash->render() ?>
                    </div>
                    <!--=== Edit Account ===-->
                    <!--<div class="tab-pane active" id="personal_info">-->
                    <!--<form class="form-horizontal" action="#">-->
                    <?= $this->Form->create($institute, ['class' => 'form-horizontal', 'type' => 'file']) ?>

                    <div class="col-md-12">
                        <div class="widget">
                            <div class="widget-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="widget-header">
                                            <h4>General Information</h4>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Institute name<span class="required"> *</span></label>
                                            <div class="col-md-8">
                                                <?php echo $this->Form->control('name', ['id' => 'institute_name', 'label' => false, 'class' => 'form-control', 'required']); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Registration Number<span class="required"> *</span></label>
                                            <div class="col-md-8">
                                                <?php echo $this->Form->control('reg_num', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Affiliated With Board</label>
                                            <div class="col-md-8">
                                                <?php
                                                echo $this->Form->control('affiliated_with_board', ['id' => 'affiliated_with_board', 'type' => 'checkbox', 'class' => 'uniform', 'style' => 'margin-top: 8px;', 'label' => false,
                                                    'templates' => [
                                                        'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                        'inputContainer' => '{{content}}'
                                                ]]);
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($institute->photo_of_affiliation) && file_exists(WWW_ROOT . 'img' . DS . 'institute_affiliations' . DS . $institute->photo_of_affiliation)) {
                                            ?>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Existing Image</label>
                                                <div class="col-md-8">

                                                    <img src="<?php echo $this->request->webroot . "img/institute_affiliations/" . $institute->photo_of_affiliation ?>" style="width:100px">

                                                </div>
                                            </div>
                                        <?php } ?>   
                                        <div class="form-group" id="div_photo_of_affiliation">
                                            <label class="col-md-4 control-label">Please Enclose copy</label>
                                            <div class="col-md-8">
                                                <?php
                                                echo $this->Form->control('photo_of_affiliation', ['id' => 'photo_of_affiliation', 'type' => 'file', 'label' => false]);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Institute Sector</label>
                                            <div class="col-md-8">
                                                <?php
                                                echo $this->Form->control('institute_sector', ['type' => 'radio', 'options' => ['pri' => 'Private', 'pub' => 'Public'], 'label' => false,
                                                    'templates' => [
                                                        'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                                        'inputContainer' => '{{content}}'
                                                    ], 'required']);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="widget-header">
                                            <h4>Contact Information</h4>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Address<span class="required"> *</span></label>
                                            <div class="col-md-8">
                                                <?php echo $this->Form->control('address', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Contact number<span class="required"> *</span></label>
                                            <div class="col-md-8">
                                                <?php echo $this->Form->control('contact_number', ['label' => false, 'class' => 'form-control', 'required']); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">District<span class="required"> *</span></label>
                                            <div class="col-md-8">
                                                <?php
                                                echo $this->Form->control('city_id', ['id' => 'city_dropdown', 'secure' => false, 'empty' => true, 'label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'options' => $cities, 'required']);
                                                ?>
                                            </div>
                                        </div>

                                    </div>




                                </div> 
                                <!-- /.row -->
                            </div> <!-- /.widget-content -->
                        </div> <!-- /.widget -->

                        <div class="widget">

                            <div class="widget-content">
                                <div class="row">
                                    <h4 style="font-weight: bold;">Information Regarding Minority Students(Class Wise) Please give details of the students, class wise, up-to Class 10th</h4>
                                    <hr/>
                                    <table id="student_table" class="table table-responsive table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <!--<th>S.No</th>-->
                                                <th>Class</th>
                                                <th>Total No. of Students</th>
                                                <th>Total No. of Minority Students</th>
                                                <th>No. of Needy & Deserving Minority Students(up to 30 % only)</th>
                                                <th>Cost of textbooks including notebooks <strong>(per set)</strong></th>
                                                <th>Cost of uniform for Boys (per set)</th>
                                                <th>Cost of uniform for Girls (per set)</th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($institute->instituteclasses as $key => $instituteclass):
                                                ?>
                                                <tr id="class_row<?php echo$key ?>">
                                                    <td>
                                                        <?php echo $this->Form->control('instituteclasses.class_no[]', ['label' => false, 'value' => $instituteclass->class_no, 'class' => 'form-control', 'required']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $this->Form->control('instituteclasses.total_students[]', ['label' => false, 'value' => $instituteclass->total_students, 'class' => 'form-control', 'required']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $this->Form->control('instituteclasses.minority_students[]', ['label' => false, 'value' => $instituteclass->minority_students, 'class' => 'form-control', 'required']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $this->Form->control('instituteclasses.needy_students[]', ['label' => false, 'value' => $instituteclass->needy_students, 'class' => 'form-control', 'required']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $this->Form->control('instituteclasses.textbook_cost[]', ['label' => false, 'value' => $instituteclass->textbook_cost, 'class' => 'form-control', 'required']); ?>
                                                    </td>
                                                    <td><?php
                                                        echo $this->Form->control('instituteclasses.boys_uniform[]', ['label' => false, 'value' => $instituteclass->boys_uniform, 'class' => 'form-control', 'required']);
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        echo $this->Form->control('instituteclasses.girls_uniform[]', ['label' => false, 'value' => $instituteclass->girls_uniform, 'class' => 'form-control', 'required']);
                                                        ?>
                                                    </td>
                                                    <td><a href="#" class="btn btn-danger btn-xs s_number" onclick="remove_row(<?php echo$key ?>)">Remove</a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="col-md-12">
                                        <a class="btn btn-success btn-sm pull-right" href="#" id="add_more">Add More</a>
                                    </div>
                                </div> 
                                <!-- /.row -->
                            </div> <!-- /.widget-content -->
                        </div> <!-- /.widget -->
                        <div class="form-actions">
                            <?= $this->Form->button(__('ADD/UPDATE Detail'), ['class' => 'btn btn-primary pull-right']); ?>
                        </div>
                    </div> <!-- /.col-md-12 -->

                    <?php echo $this->Form->end(); ?>
                    <!--</form>-->
                    <!--</div>-->
                    <!-- /Edit Account -->
                </div> <!-- /.tab-content -->
                <!--</div>-->
                <!--END TABS-->
            </div>
        </div> <!-- /.row -->
        <!-- /Page Content -->
    </div>
    <!-- /.container -->

</div>
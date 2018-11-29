
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

                        <!--<div class="form-actions">-->
                        <?= $this->Form->button(__('ADD/UPDATE Detail'), ['class' => 'btn btn-primary pull-right']); ?>
                        <!--</div>-->
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
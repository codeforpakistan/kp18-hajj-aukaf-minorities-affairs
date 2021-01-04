<div class="tab-pane <?= $education_active ?>" id="education">
    <div class="col-md-12">
        <div class="widget-content">
            <table id="qualification_details" class="table table-striped table-bordered table-hover datatable">
                <thead>
                    <tr>
                        <th class="checkbox-column">
                            &nbsp;
                        </th>
                        <th>Year of Passing</th>
                        <th>Qualification Level</th>
                        <th class="hidden-xs">Discipline</th>
                        <th class="hidden-xs">Institute</th>
                        <th class="hidden-xs">Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($applicant->qualifications)) {

                        foreach ($applicant->qualifications as $display_q):
                            ?>
                            <tr>
                                <td class="checkbox-column">
                                    <input id="checkbox_<?= $display_q->id ?>" onclick="uncheck_fields(<?= $display_q->id ?>)" type="checkbox" class="uniform">
                                </td>
                                <td><?php echo!empty($display_q->passing_date) ? date('d-M-Y', strtotime($display_q->passing_date)) : '<span style="color:green">In progress</span>' ?></td>
                                <td><?= $display_q->qualification_level['name'] ?></td>
                                <td class="hidden-xs"><?= $display_q->discipline['discipline'] ?></td>
                                <td class="hidden-xs"><?= $display_q->institute['name'] ?></td>
                                <td class="hidden-xs"><?= !empty($display_q->percentage) ? $display_q->percentage . '%' : 'Not given'; ?></td>
                            </tr>
                            <?php
                        endforeach;
                    }else {
                        ?> 
                        <tr>
                            <td colspan="5">No Qualification inserted yet</td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
        <a id="clicktoadd"><i class="icon-plus-sign"></i> Click to add</a>
        <br/><br/><br/>
    </div>
    <!--<form class="form-horizontal" action="#">-->
    <?= $this->Form->create($qualification, ['class' => 'form-horizontal', 'id' => 'education_form', 'style' => 'display:none;']); ?>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="widget-header">
                            <h4>Qualification detail</h4>
                        </div>
                        <?php
                        $this->Form->unlockField('Qualifications.id');
                        echo $this->Form->hidden('Qualifications.id', ['secure' => false, 'id' => 'qualification_id']);
                        ?>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Qualification level<span class="required"> *</span></label>
                            <div class="col-md-8">
                                <?php
                                echo $this->Form->control('Qualifications.qualification_level_id', ['id' => 'qualification_level', 'label' => false, 'class' => 'form-control', 'empty' => true, 'options' => $qualificationLevels, 'required']);
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Completed</label>
                            <div class="col-md-8">
                                <?php
                                echo $this->Form->control('Qualifications.completed', ['id' => 'completed', 'type' => 'checkbox', 'class' => 'uniform', 'style' => 'margin-top: 8px;', 'label' => false,
                                    'templates' => [
                                        'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                        'inputContainer' => '{{content}}'
                                ]]);
                                ?>
                            </div>
                        </div>
                        <div class="form-group" style="display:none;" id="div_passing_date">
                            <label class="col-md-4 control-label">Date of completion</label>
                            <div class="col-md-8">
                                <?php
                                echo $this->Form->control('Qualifications.passing_date', ['id' => 'passing_date', 'type' => 'text', 'data-mask' => '2099-99-99', 'label' => false, 'class' => 'form-control']);
                                ?>
                                <span class="help-block">yyyy-mm-dd</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Education System</label>
                            <div class="col-md-8">
                                <?php
                                echo $this->Form->control('Qualifications.education_system', ['type' => 'radio', 'class' => 'uniform', 'options' => ['annual' => 'Annual', 'semester' => 'Semester', 'term' => 'Term'], 'label' => false,
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
                            <h4>Academic Performance Details</h4>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Grading System</label>
                            <div class="col-md-8">
                                <?php
                                echo $this->Form->control('Qualifications.grading_system', ['id' => 'grading_system', 'type' => 'radio', 'class' => 'uniform', 'options' => ['cgpa' => 'CGPA', 'marks' => 'Marks'], 'label' => false,
                                    'templates' => [
                                        'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                        'inputContainer' => '{{content}}'
                                    ], 'required']);
                                ?>
                            </div>
                        </div>
                        <div id="cgpa_fields" style="display:none;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Total CGPA</label>
                                <div class="col-md-8">
                                    <?php
                                    echo $this->Form->control('Qualifications.total_cgpa', ['id' => 'total_cgpa', 'class' => 'form-control', 'empty' => true, 'options' => ['4' => '4', '5' => '5'], 'label' => false]);
                                    ?>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Obtained CGPA</label>
                                <div class="col-md-8">
                                    <?php
                                    echo $this->Form->control('Qualifications.obtained_cgpa', ['id' => 'obtained_cgpa', 'type' => 'text', 'class' => 'form-control', 'data-mask' => '9.99', 'label' => false]);
                                    ?> 
                                    <span id="obtained_cgpa_error"></span>
                                </div>
                            </div>
                        </div>
                        <div id="marks_fields">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Total Marks</label>
                                <div class="col-md-8">
                                    <?php
                                    echo $this->Form->control('Qualifications.total_marks', ['id' => 'total_marks', 'type' => 'text', 'class' => 'form-control', 'label' => false, 'required']);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Obtained Marks</label>
                                <div class="col-md-8">
                                    <?php
                                    echo $this->Form->control('Qualifications.obtained_marks', ['id' => 'obtained_marks', 'type' => 'text', 'class' => 'form-control', 'label' => false, 'required']);
                                    ?>
                                    <span id="obtained_marks_error"></span>
                                </div>
                            </div>
                        </div>
                        <div id="percentage_div" style="display: none;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Percentage</label>
                                <div class="col-md-8">
                                    <?php
                                    echo $this->Form->control('Qualifications.percentage', ['id' => 'percentage', 'class' => 'form-control', 'type' => 'text', 'data-mask' => '99.99', 'label' => false]);
                                    ?>
                                    <span id="percentage_error"></span>
                                </div>
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
                <h4>Institute Details</h4>
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-md-6">
                        <div id="school_fields">
                            <div class="form-group">
                                <label class="col-md-4 control-label">City<span class="required"> *</span></label>
                                <div class="col-md-8">
                                    <?php
                                    $this->Form->unlockField('Institutes.id');
                                    echo $this->Form->hidden('Institutes.id', ['id' => 'i_id']);
                                    $this->Form->unlockField('Institutes.city_id');
                                    echo $this->Form->control('Institutes.city_id', ['id' => 'city_dropdown', 'secure' => false, 'empty' => true, 'label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'options' => $cities, 'required']);
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Select Board<span class="required"> *</span></label>
                                <div class="col-md-8">
                                    <?php echo $this->Form->control('Qualifications.degree_awarding_id', ['id' => 'degree_awarding_id', 'label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'empty' => true, 'options' => $degreeAwardings, 'required']);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">School/College<span class="required"> *</span></label>
                                <div class="col-md-8">
                                    <?php echo $this->Form->control('Institutes.name', ['id' => 'institue_name', 'label' => false, 'class' => 'form-control', 'required']);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Institute Sector</label>
                                <div class="col-md-8">
                                    <?php
                                    echo $this->Form->control('Institutes.institute_sector', ['type' => 'radio', 'class' => 'uniform', 'options' => ['pri' => 'Private', 'pub' => 'Public'], 'label' => false,
                                        'templates' => [
                                            'nestingLabel' => '{{hidden}}<label class="radio-inline"><div class=""><span>{{input}}</span></div>{{text}}</label>',
                                            'inputContainer' => '{{content}}'
                                        ], 'required']);
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Discipline <span class="required"> *</span></label>
                                <div class="col-md-8">
                                    <?php echo $this->Form->control('Qualifications.discipline_id', ['id' => 'discipline', 'label' => false, 'class' => 'form-control', 'empty' => 'Select Discipline', 'options' => array(), 'required']);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="university_fields" style="display: none">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Select University <span class="required"> *</span></label>
                                <div class="col-md-8">
                                    <?php echo $this->Form->control('Qualifications.institute_id', ['id' => 'institute_id', 'label' => false, 'class' => 'select2-select-00 col-md-12 full-width-fix', 'empty' => true, 'options' => $institutes]);
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Discipline <span class="required"> *</span></label>
                                <div class="col-md-8">
                                    <?php
                                    $this->Form->unlockField('Disciplines.id');
                                    echo $this->Form->hidden('Disciplines.id', ['id' => 'discipline_id']);
                                    echo $this->Form->control('Disciplines.discipline', ['id' => 'discipline_field', 'label' => false, 'class' => 'form-control', 'required']);
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                    </div>
                </div> <!-- /.row -->

            </div> <!-- /.widget-content -->
        </div> <!-- /.widget -->
        <div class="form-actions">
            <a id="canceladd" class="btn btn-primary pull-right">Cancel</a>
            <?= $this->Form->button(__('ADD/UPDATE TO LIST'), ['name' => 'qualification', 'class' => 'btn btn-primary pull-right']); ?>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>
    <!--</form>-->
</div>
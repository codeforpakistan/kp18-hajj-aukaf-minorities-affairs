<!-- === qualification Setup ===-->
<div class="tab-pane" id="tab5">
    <h3 style="" class="block padding-bottom-10px">Please provide detail of recently passed class</h3>
    <div class="row">
        <div class="col-md-6">                                              
            <h4 class="custom_head">Qualification Details</h4>
            <div class="form-group">
                <label class="col-md-4 control-label">Qualification level<span class="required"> *</span></label>
                <div class="col-md-8">
                    {!! Form::select('Qualification[qualification_level_id]', $qualificationLevels, null, [
                        'id' => 'qualification_level',
                        'class' => 'form-control',
                        'label' => false,
                        'placeholder' => 'Select Qualification Level',
                        'required',
                    ]) !!}
                </div>
            </div>
            {{-- <div class="form-group">
                <label class="col-md-4 control-label">Completed</label>
                <div class="col-md-8">
                    {!! Form::checkbox('Qualification[completed]', '1', isset($subCategory) ? null : true , [
                        'class' => 'uniform',
                        'id' => 'completed',
                        'style' => 'margin-top: 8px;',
                        'label' => false,
                    ]) !!}
                </div>
            </div> --}}
            <div class="form-group">
                <label class="col-md-4 control-label">Education System</label>
                <div class="col-md-8">
                    {!! Form::select('Qualification[education_system]', ['annual' => 'Annual', 'semester' => 'Semester', 'term' => 'Term'], null, [
                        'class' => 'form-control',
                        'label' => false,
                        'placeholder' => 'Select Education System',
                        'required',
                    ]) !!}
                </div>
            </div>
            <div class="form-group" id="div_passedclass" style="display:none">
                <label id="label_passedclass" class="col-md-4 control-label">Recently passed class</label>
                <div class="col-md-8">
                    {!! Form::text('Qualification[recent_class]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'id' => 'recent_class',
                        'required'
                    ]) !!}
                </div>
            </div>
            <div class="form-group" id="div_passing_date" style="display:none">
                <label class="col-md-4 control-label">Date of completion</label>
                <div class="col-md-8">
                    {!! Form::date('Qualification[passing_date]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'id' => 'passing_date',
                        'required'
                    ]) !!}
                    {{-- <span class="help-block">yyyy-mm-dd</span> --}}
                </div>
            </div>
            <div class="form-group" id="div_currentclass" style="display:none">
                <label id="label_currentclass" class="col-md-4 control-label">Current class</label>
                <div class="col-md-8">
                    {!! Form::text('Qualification[current_class]', null, [
                        'label' => false,
                        'class' => 'form-control',
                        'id' => 'current_class',
                        'required'
                    ]) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h4  class="custom_head">Academic performance details of recently passed exam</h4>
            <div class="form-group">
                <label class="col-md-4 control-label">Grading System</label>
                <div class="col-md-8">
                    {!! Form::select('Qualification[grading_system]', ['cgpa' => 'CGPA', 'marks' => 'Marks'], null, [
                        'class' => 'form-control',
                        'id' => 'grading_system',
                        'label' => false,
                        'placeholder' => 'Select Education System',
                        'required',
                    ]) !!}
                </div>
            </div>
            <div id="cgpa_fields" style="display:none;">
                <div class="form-group">
                    <label class="col-md-4 control-label">Total CGPA</label>
                    <div class="col-md-8">
                        {!! Form::select('Qualification[total_cgpa]', ['4' => '4', '5' => '5'], null, [
                            'class' => 'form-control',
                            'id' => 'total_cgpa',
                            'label' => false,
                            'placeholder' => 'Select Total CGPA',
                            'required',
                        ]) !!}

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Obtained CGPA</label>
                    <div class="col-md-8">
                        {!! Form::number('Qualification[obtained_cgpa]', null, [
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'obtained_cgpa',
                            'step' => '0.01',
                            'required'
                        ]) !!}
                        <span id="obtained_cgpa_error"></span>
                    </div>
                </div>
            </div>
            <div id="marks_fields">
                <div class="form-group">
                    <label class="col-md-4 control-label">Total Marks</label>
                    <div class="col-md-8">
                        {!! Form::text('Qualification[total_marks]', null, [
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'total_marks',
                            'required'
                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Obtained Marks</label>
                    <div class="col-md-8">
                        {!! Form::text('Qualification[obtained_marks]', null, [
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'obtained_marks',
                            'required'
                        ]) !!}
                        <span id="obtained_marks_error"></span>
                    </div>
                </div>
            </div>
            <div id="percentage_div" style="display: none;">
                <div class="form-group">
                    <label class="col-md-4 control-label">Percentage</label>
                    <div class="col-md-8">
                        {!! Form::number('Qualification[percentage]', null, [
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'percentage',
                            'step' => '0.01',
                            'max' => '100.00',
                            'required'
                        ]) !!}
                        <span id="percentage_error"></span>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-6">
            <h4  class="custom_head">Institute Details</h4>
            <div id="school_fields">
                <div class="form-group">
                    <label class="col-md-4 control-label">City<span class="required"> *</span></label>
                    <div class="col-md-8">
                        {!! Form::select('Institute[city_id]', $cities, null, [
                            'class' => 'form-control',
                            'label' => false,
                            'id' => 'q_city_dropdown',
                            'placeholder' => 'Select City',
                            'required',
                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Select Board<span class="required"> *</span></label>
                    <div class="col-md-8">
                        {!! Form::select('Qualification[degree_awarding_id]', $degreeAwardings, null, [
                            'class' => 'form-control',
                            'id' => 'degree_awarding_id',
                            'label' => false,
                            'id' => 'city_dropdown',
                            'placeholder' => 'Select Degree Awarding Authority',
                            'required',
                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">School/College<span class="required"> *</span></label>
                    <div class="col-md-8">
                        {!! Form::text('Institute[name]', null, [
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'institue_name',
                            'required'
                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Institute Sector</label>
                    <div class="col-md-8">
                        {!! Form::select('Institute[institute_sector]', ['pri' => 'Private', 'pub' => 'Public'], null, [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Select Sector',
                            'required',
                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Discipline <span class="required"> *</span></label>
                    <div class="col-md-8">
                        {!! Form::select('Qualification[discipline_id]', [], null, [
                            'class' => 'form-control',
                            'id' => 'discipline',
                            'label' => false,
                            'placeholder' => 'Select Discipline',
                            'required',
                        ]) !!}
                    </div>
                </div>
            </div>
            <div id="university_fields" style="display: none">
                <div class="form-group">
                    <label class="col-md-4 control-label">Select University <span class="required"> *</span></label>
                    <div class="col-md-8">
                        {!! Form::select('Qualification[institute_id]', $institutes, null, [
                            'class' => 'form-control',
                            'id' => 'institute_id',
                            'label' => false,
                            'placeholder' => 'Select University',
                            'required',
                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Discipline <span class="required"> *</span></label>
                    <div class="col-md-8">
                        {!! Form::select('Discipline[discipline]', [], null, [
                            'class' => 'form-control',
                            'id' => 'discipline_field',
                            'label' => false,
                            'placeholder' => 'Select Discipline',
                            'required',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.row -->
</div>
<!-- /qualification Setup 
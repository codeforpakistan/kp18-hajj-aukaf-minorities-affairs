{!! Form::open(['route' => 'admin.reports.general-report', 'method' => "GET"]) !!}
    <div class="row">
        <div class="form-line col-lg-3">
            {!! Form::select('year', $years, request()->has('year') ? request()->input('year') : null, [
                'class' => 'form-control show-tick',
                'id' => 'year',
                'label' => false,
                'required',
            ]) !!}
            <small class="myspan">Select year</small>
        </div>
        <div class="form-line col-lg-3">
            {!! Form::select('fund', $fundsList, request()->has('fund') ? request()->input('fund') : null, [
                'class' => 'form-control show-tick',
                'id' => 'fund',
                'label' => false,
                'required',
            ]) !!}
            <small class="myspan">Select fund</small>
        </div>
        <div class="form-line col-lg-3">
            {!! Form::select('applicant_status', ['all' => 'All','selected' => 'Selected','notselected' => 'Not Selected', 'distributed' => 'Distributed'], request()->has('applicant_status') ? request()->input('applicant_status') : null, [
                'class' => 'form-control show-tick',
                'id' => 'applicant_status',
                'label' => false,
                'required',
            ]) !!}
            <small class="myspan">Select applicant's status</small>
        </div>
        <div class="form-line col-lg-3">
            {!! Form::select('city', $citiesList, request()->has('city') ? request()->input('city') : null, [
                'class' => 'form-control show-tick',
                'id' => 'city',
                'label' => false,
                'placeholder' => 'All Districts',
            ]) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-line col-lg-3">
            {!! Form::select('religion', $religionsList, request()->has('religion') ? request()->input('religion') : null, [
                'class' => 'form-control show-tick sub_categ',
                'id' => 'religion',
                'label' => false,
                'placeholder' => 'All Religions',
            ]) !!}
        </div>
        <div class="form-line col-lg-3">
            {!! Form::text('cnic', old('cnic'), [
                'id' => 'cnic', 
                'label' => false, 
                'class' => 'form-control', 
                'pattern' => "[0-9]{5}-[0-9]{7}-[0-9]{1}", 
                'data-mask' => '99999-9999999-9', 
                'data-inputmask-clearincomplete' => true
                ])
            !!}

            <span id="cnic_error" class="help-block">CNIC format (xxxxx-xxxxxxx-x)</span>

        </div>
        <div class="form-line col-lg-3">
            {!! Form::text('token', request()->input('token') ?? null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Search by Token number',
                'label' => false,
            ]) !!}
        </div>
        <div class="form-line col-lg-3">
            <div class="form-group">
                <label class="radio-inline">
                    {!! Form::radio('gender', 'male', (request()->input('gender') == 'male') ? true : false ) !!}
                    Male
                </label>
                <label class="radio-inline">
                    {!! Form::radio('gender', 'female', (request()->input('gender') == 'female') ? true : false) !!}
                    Female
                </label>
                <label class="radio-inline">
                    {!! Form::radio('gender', 'both', (in_array(request()->input('gender'),['male','female'])) ? false : true) !!} Both
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-line col-lg-3">
            {!! Form::select('user', $userList, request()->has('user') ? request()->input('user') : null, [
                'class' => 'form-control show-tick sub_categ',
                'id' => 'user',
                'label' => false,
                'placeholder' => 'All Users'
            ]) !!}
            <small class="myspan">Select to view record inserted by user</small>
        </div>
        <div class="form-line col-lg-3">
            <input type="date" class="form-control" name="from_date" value="{{ request()->input('from_date') }}">
            <small class="myspan">From Date</small>
        </div>
        <div class="form-line col-lg-3">
            <input type="date" class="form-control" name="to_date" value="{{ request()->input('to_date') }}">
            <small class="myspan">To Date</small>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-lg-12">
            <label class="text-muted">Select fields to include in table</label>
        </div>
    </div>
    <div class="row">
        @php
            $checkedOpts = 0;
        @endphp
        @foreach($options as $key => $option)
            @php
                if(isset($_GET[$key]))
                {
                    $checkedOpts++;
                }
            @endphp
            <div class="col-lg-2 m-0">
                <div class="checkbox">
                    <label>
                      <input type="checkbox" class="option" name="{{ $key }}" {{isset($_GET[$key]) ? 'checked' : ''}} id="{{ $key }}"> {{$option}}
                    </label>
                  </div>
            </div>
        @endforeach
        <div class="col-lg-3 m-0">
            <div class="checkbox">
                <label>
                  <input type="checkbox" class="option" {{ $checkedOpts === count($options) ? 'checked' : '' }} id="check_all"> Check All
                </label>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="form-line col-lg-3">
            <button class="btn btn-primary waves-effect" type="submit" id="submit">Submit</button>
        </div>
    </div>
{!! Form::close() !!}
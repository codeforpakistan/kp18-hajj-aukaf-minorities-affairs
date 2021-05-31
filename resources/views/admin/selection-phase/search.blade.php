{!! Form::open(['route' => 'admin.selection-phase.distribution', 'method' => "GET"]) !!}
    <div class="row">
        <div class="form-line col-lg-6">
            {!! Form::select('fund', $fundsList, request()->has('fund') ? request()->input('fund') : null, [
                'class' => 'form-control show-tick',
                'id' => 'fund',
                'label' => false,
                'placeholder' => 'Select Fund',
                'required',
            ]) !!}
        </div>
        <div class="form-line col-lg-6">
            {!! Form::select('city', $citiesList, request()->has('city') ? request()->input('city') : null, [
                'class' => 'form-control show-tick',
                'id' => 'city',
                'label' => false,
                'placeholder' => 'Select District',
            ]) !!}
        </div>
        <div class="form-line col-lg-6">
            {!! Form::select('religion', $religionsList, request()->has('religion') ? request()->input('religion') : null, [
                'class' => 'form-control show-tick sub_categ',
                'id' => 'religion',
                'label' => false,
                'placeholder' => 'Select Religion',
            ]) !!}
        </div>
        <div class="form-line col-lg-3">
            {!! Form::select('member_operator', ['<' => 'Less than','>' => 'Greater than', '=' => 'Equal'], request()->has('member_operator') ? request()->input('member_operator') : null, [
                'class' => 'form-control show-tick sub_categ',
                'id' => 'member_operator',
                'label' => false,
                'placeholder' => 'Select Operator',
            ]) !!}
        </div>
        <div class="form-line col-lg-3">
            {!! Form::text('family_members', request()->has('family_members') ? request()->input('family_members') : null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Family Members',
                'label' => false,
            ]) !!}
        </div>
        <div class="form-line col-lg-3">
            {!! Form::select('salary_operator', ['<' => 'Less than','>' => 'Greater than', '=' => 'Equal'], request()->has('salary_operator') ? request()->input('salary_operator') : null, [
                'class' => 'form-control show-tick sub_categ',
                'id' => 'salary_operator',
                'label' => false,
                'placeholder' => 'Select Operator',
            ]) !!}
        </div>
        <div class="form-line col-lg-3">
            {!! Form::text('salary', request()->has('salary') ? request()->input('salary') : null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Salary',
                'label' => false,
            ]) !!}
        </div>
        <div class="form-line col-lg-6">
            {!! Form::text('limit', request()->has('limit') ? request()->input('limit') : null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Limit',
                'label' => false,
            ]) !!}
        </div>
        <div class="form-line col-lg-6">
            <button class="btn btn-primary waves-effect" type="submit" id="submit">Filter</button>
            <a href="{{ route('admin.selection-phase.distribution') }}" class="btn btn-warning waves-effect">Reset Filters</a>
        </div>
    </div>
{!! Form::close() !!}
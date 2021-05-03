{!! Form::open(['route' => 'admin.applicants.index', 'method' => "GET"]) !!}
    <div class="row">
        <div class="form-line col-lg-6">
            {!! Form::select('fund', $fundsList, request()->has('fund') ? request()->input('fund') : null, [
                'class' => 'form-control show-tick',
                'id' => 'fund',
                'label' => false,
                'placeholder' => 'Select Grant',
                'required',
            ]) !!}
        </div>
        <div class="form-line col-lg-6">
            {!! Form::select('city', $citiesList, request()->has('city') ? request()->input('city') : null, [
                'class' => 'form-control show-tick',
                'id' => 'city',
                'label' => false,
                'placeholder' => 'All Districts',
            ]) !!}
        </div>
        <div class="form-line col-lg-6">
            {!! Form::select('religion', $religionsList, request()->has('religion') ? request()->input('religion') : null, [
                'class' => 'form-control show-tick sub_categ',
                'id' => 'religion',
                'label' => false,
                'placeholder' => 'All Religions',
            ]) !!}
        </div>
        <div class="form-line col-lg-6">
            {!! Form::text('token', request()->has('token') ? request()->input('token') : null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Search by Token number',
                'label' => false,
            ]) !!}
        </div>
        <div class="form-line col-lg-6">
            <button class="btn btn-primary waves-effect" type="submit" id="submit">Filter</button>
            <a href="{{ route('admin.applicants.index') }}" class="btn btn-warning waves-effect">Reset Filters</a>
        </div>
    </div>
{!! Form::close() !!}
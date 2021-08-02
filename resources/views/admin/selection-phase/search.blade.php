{{-- {!! Form::open(['route' => 'admin.selection-phase.distribution', 'method' => "GET",'id' =>'filter-app']) !!} --}}
<div class="row">
    <div class="form-line col-lg-3">
        {!! Form::select('fund', $fundsList, null, [
            'class' => 'form-control show-tick sub_categ',
            'id' => 'fund',
            'label' => false,
            'placeholder' => 'Select Fund',
            'v-model'=>'form.fund'
        ]) !!}
    </div>
    <div class="form-line col-lg-3">
        {!! Form::select('religion', $religionsList, null, [
            'class' => 'form-control show-tick sub_categ',
            'id' => 'religion',
            'label' => false,
            'placeholder' => 'Select Religion',
            'v-model'=>'form.religion'
        ]) !!}
    </div>
    <div class="form-line col-lg-3">
        {!! Form::select('city', $citiesList, null, [
            'class' => 'form-control show-tick',
            'id' => 'city',
            'label' => false,
            'placeholder' => 'Select District',
            'v-model'=>'form.city'
        ]) !!}
    </div>
    @if($limitField ?? false)
        <div class="form-line col-lg-3">
            {!! Form::text('limit', null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Limit',
                'label' => false,
                'v-model'=>'form.limit'
            ]) !!}
        </div>
    @endif
    @if($tokenField ?? false)
        <div class="form-line col-lg-3">
            {!! Form::text('token', null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Token',
                'label' => false,
                'v-model'=>'form.token'
            ]) !!}
        </div>
    @endif
    @if($cnicOrName ?? false)
        <div class="form-line col-lg-3">
            {!! Form::text('cnicOrName', null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Search by Cnic, Name',
                'label' => false,
                'v-model'=>'form.cnicOrName'
            ]) !!}
        </div>
    @endif
</div>
<div class="row">
    <div class="form-line col-lg-6">
        <button class="btn btn-primary waves-effect mr-2" @click="filter">Submit</button>
    </div>
</div>

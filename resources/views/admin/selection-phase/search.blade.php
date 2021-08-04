{{-- {!! Form::open(['route' => 'admin.selection-phase.distribution', 'method' => "GET",'id' =>'filter-app']) !!} --}}
<div class="row">
    <div class="col-lg-3">
        <select2 required id="fund" :value="{{ request()->query('fund','0') }}" @input="fundCityReligionChange">
            <option value="0" selected disabled>Select Fund</option>
            @foreach($fundsList as $idd => $namee)
                <option value="{{ $idd }}">{{$namee}}</option>
            @endforeach
        </select2>
    </div>
    <div class="col-lg-3">
        <select2 id="religion" :value="{{ request()->query('religion','0') }}" @input="fundCityReligionChange">
            <option value="0" selected disabled>Select Religion</option>
            @foreach($religionsList as $religionn_id => $religionn_name)
                <option value="{{ $religionn_id }}">{{$religionn_name}}</option>
            @endforeach
        </select2>
    </div>
    <div class="col-lg-3">
        <select2 id="city" :value="{{ request()->query('city_id','0') }}" @input="fundCityReligionChange">
            <option value="0" selected disabled>Select Districts</option>
            @foreach($citiesList as $cityy_id => $cityy_name)
                <option value="{{ $cityy_id }}">{{$cityy_name}}</option>
            @endforeach
        </select2>
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

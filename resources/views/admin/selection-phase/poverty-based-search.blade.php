{{-- {!! Form::open(['route' => 'admin.selection-phase.distribution', 'method' => "GET",'id' =>'filter-app']) !!} --}}
<div id="filter-app" v-cloak>
    <div class="row">
        <div class="col-lg-4">
            <select2 required v-model="fund" id="selectFund" :value="{{ request()->query('fund','0') }}" @input="fundCityReligionChange">
                <option value="0" selected disabled data-gs="0">Select Fund</option>
                @foreach($fundsList as $item)
                    <option value="{{ $item['id'] }}" data-gs="{{$item['grant_or_scholarship']}}">{{$item['fund_name']}}</option>
                @endforeach
            </select2>
        </div>
        <div class="col-lg-4">
            <select2 id="selectCity" :value="{{ request()->query('city_id','0') }}" @input="fundCityReligionChange">
                <option value="0" selected disabled>Select Districts</option>
                @foreach($citiesList as $cityy_id => $cityy_name)
                    <option value="{{ $cityy_id }}">{{$cityy_name}}</option>
                @endforeach
            </select2>
        </div>
        <div class="col-lg-4">
            <select2 v-model="form.religion" id="selectReligion" :value="{{ request()->query('religion','0') }}" @input="fundCityReligionChange">
                <option value="0" selected disabled>Select Religion</option>
                @foreach($religionsList as $religionn_id => $religionn_name)
                    <option value="{{ $religionn_id }}">{{$religionn_name}}</option>
                @endforeach
            </select2>
        </div>
        <div v-if="!grantOrSholarship" class="form-line col-lg-4">
            {!! Form::text('family_members', null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Family Members',
                'label' => false,
                'v-model'=>'form.family_members',
            ]) !!}
        </div>
        <div v-if="!grantOrSholarship" class="form-line col-lg-2">
            {!! Form::select('member_operator', ['<' => 'Less than','>' => 'Greater than', '=' => 'Equal'], request()->has('member_operator') ? request()->input('member_operator') : null, [
                'class' => 'form-control show-tick sub_categ',
                'id' => 'member_operator',
                'label' => false,
                'placeholder' => 'Select Operator',
                'v-model'=>'form.member_operator',
            ]) !!}
        </div>
        <div v-if="!grantOrSholarship" class="form-line col-lg-4">
            {!! Form::text('salary', null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Salary',
                'label' => false,
                'v-model'=>'form.salary'
            ]) !!}
        </div>
        <div class="form-line col-lg-2" v-if="!grantOrSholarship">
            {!! Form::select('salary_operator', ['<' => 'Less than','>' => 'Greater than', '=' => 'Equal'], request()->has('salary_operator') ? request()->input('salary_operator') : null, [
                'class' => 'form-control show-tick sub_categ',
                'id' => 'salary_operator',
                'label' => false,
                'v-model'=>'form.salary_operator',
                'placeholder' => 'Select Operator',
            ]) !!}
        </div>
        <div class="form-line col-lg-4" v-if="grantOrSholarship">
            {!! Form::text('percentage', null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Minimum Percentage',
                'label' => false,
                'v-model'=>'form.percentage'
            ]) !!}
        </div>
        <div class="form-line col-lg-4">
            {!! Form::text('limit', null, [
                'class' => 'form-control show-tick show sub_categ',
                'placeholder' => 'Limit',
                'label' => false,
                'v-model'=>'form.limit'
            ]) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-line col-lg-6">
            <button class="btn btn-primary waves-effect mr-2" @click="filter">Filter</button>
            <a href="{{ route('admin.selection-phase.poverty-based') }}" class="btn btn-warning waves-effect" style="margin-left:10px">Reset Filters</a>
        </div>
    </div>
</div>
{{-- {!! Form::close() !!} --}}
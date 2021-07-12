@extends('admin.layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit District
                                <a href='{{ route('admin.districts.index') }}' class="btn btn-default pull-right">List Districts</a>
                            </h2>
                        </div>
                        <div class="body">
                            {!! Form::model($district, ['route' => ['admin.districts.update', [$district->id]], 'method' => 'PUT', 'files' => 'true', 'id' => 'form-validate']) !!}
                                @include('admin.districts.form')
                                <button class="btn btn-primary waves-effect" type="submit">Update</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>
@endsection
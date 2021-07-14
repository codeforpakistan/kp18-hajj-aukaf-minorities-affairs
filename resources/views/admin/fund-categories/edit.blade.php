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
                                Edit Fund Category ({{ $fundCategory->type_of_fund }})
                                <a href='{{ route('admin.fund-categories.index') }}' class="btn btn-primary pull-right">List Fund Categories</a>
                            </h2>
                        </div>
                        <div class="body">
                            {!! Form::model($fundCategory, ['route' => ['admin.fund-categories.update', [$fundCategory->id]], 'method' => 'PUT', 'files' => 'true', 'id' => 'form-validate']) !!}
                                @include('admin.fund-categories.form')
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
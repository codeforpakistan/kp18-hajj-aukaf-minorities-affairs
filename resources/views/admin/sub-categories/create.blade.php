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
                                New Fund Sub Category
                                <a href='{{ route('admin.sub-categories.index') }}' class="btn btn-default pull-right">List Fund Sub Categories</a>
                            </h2>
                        </div>
                        <div class="body">
                            {!! Form::open(['route' => 'admin.sub-categories.store', 'method' => 'POST', 'files' => 'true', 'id' => 'form-validate']) !!}
                                @include('admin.sub-categories.form')
                                <button class="btn btn-primary waves-effect" type="submit">Save</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>
@endsection
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
                                New Institute
                                <a href='{{ route('admin.institutes.index') }}' class="btn btn-default pull-right">List Institutes</a>
                            </h2>
                        </div>
                        <div class="body">
                            {!! Form::open(['route' => 'admin.institutes.store', 'method' => 'POST', 'files' => 'true', 'id' => 'form-validate']) !!}
                                @include('admin.institutes.form')
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
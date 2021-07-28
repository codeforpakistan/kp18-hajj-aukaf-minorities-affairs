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
                                Edit Fund Sub Category ({{ $subCategory->type }})
                                <a href='{{ route('admin.sub-categories.index') }}' class="btn btn-primary pull-right">List Fund Sub Categories</a>
                            </h2>
                        </div>
                        <div class="body">
                            {!! Form::model($subCategory, ['route' => ['admin.sub-categories.update', [$subCategory->id]], 'method' => 'PUT', 'files' => 'true', 'id' => 'form-validate']) !!}
                                @include('admin.sub-categories.form',['editForm' => true])
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
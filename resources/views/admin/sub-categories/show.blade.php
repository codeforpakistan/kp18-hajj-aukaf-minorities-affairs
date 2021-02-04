@extends('admin.layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            	Fund Sub Category ({{ $subCategory->type }})
                            	<div class="btn-group pull-right" role="group">
                            		<a href='{{ route('admin.sub-categories.index') }}' class="btn btn-default">List Fund Sub Categories</a>
                            		<a href='{{ route('admin.sub-categories.create') }}' class="btn btn-default">New Fund Sub Category</a>
                            	</div>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable">
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $subCategory->id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fund Category Name</th>
                                        <td><a href="{{ route('admin.fund-categories.show', [$subCategory->fund_category_id]) }}">{{ $subCategory->fundCategory->type_of_fund }}</a></td>
                                    </tr>
                                    <tr>
                                    	<th scope="row">Fund Sub Category Name</th>
                                        <td>{{ $subCategory->type }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Description</th>
                                        <td>{{ $subCategory->description }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
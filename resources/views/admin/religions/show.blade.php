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
                            	Fund Category ({{ $fundCategory->type_of_fund }})
                            	<div class="btn-group pull-right" role="group">
                            		<a href='{{ route('admin.fund-categories.index') }}' class="btn btn-default">List Fund Categories</a>
                            		<a href='{{ route('admin.fund-categories.create') }}' class="btn btn-default">New Fund Category</a>
                            	</div>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable">
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $fundCategory->id }}</td>
                                    </tr>
                                    <tr>
                                    	<th scope="row">Fund Category Name</th>
                                        <td>{{ $fundCategory->type_of_fund }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Description</th>
                                        <td>{{ $fundCategory->description }}</td>
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
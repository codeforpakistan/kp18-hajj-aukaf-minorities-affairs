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
                            	Institute
                            	<div class="btn-group pull-right" role="group">
                            		<a href='{{ route('admin.institutes.index') }}' class="btn btn-default">List Institutes</a>
                            		<a href='{{ route('admin.institutes.create') }}' class="btn btn-default">New Institute</a>
                            	</div>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable">
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $institute->id }}</td>
                                    </tr>
                                    <tr>
                                    	<th scope="row">Institute Type</th>
                                        <td>{{ @$institute->instituteType->type }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">City</th>
                                        <td>{{ @$institute->city->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Institute Sector</th>
                                        <td>{{ $institute->institute_sector }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td>{{ $institute->address }}</td>
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
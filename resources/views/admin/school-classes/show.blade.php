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
                            	School Class
                            	<div class="btn-group pull-right" role="group">
                            		<a href='{{ route('admin.school-classes.index') }}' class="btn btn-default">List School Classs</a>
                            		<a href='{{ route('admin.school-classes.create') }}' class="btn btn-default">New School Class</a>
                            	</div>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable">
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $schoolClass->id }}</td>
                                    </tr>
                                    <tr>
                                    	<th scope="row">Class</th>
                                        <td>{{ $schoolClass->class_number }}</td>
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
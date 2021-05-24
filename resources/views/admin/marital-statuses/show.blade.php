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
                            	Marital Status
                            	<div class="btn-group pull-right" role="group">
                            		<a href='{{ route('admin.marital-statuses.index') }}' class="btn btn-default">List Marital Statuses</a>
                            		<a href='{{ route('admin.marital-statuses.create') }}' class="btn btn-default">New Marital Status</a>
                            	</div>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable">
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $maritalStatus->id }}</td>
                                    </tr>
                                    <tr>
                                    	<th scope="row">Marital Status</th>
                                        <td>{{ $maritalStatus->status }}</td>
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
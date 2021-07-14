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
                            	Role
                            	<div class="btn-group pull-right" role="group">
                            		<a href='{{ route('admin.roles.index') }}' class="btn btn-primary">List Roles</a>
                            		<a href='{{ route('admin.roles.create') }}' class="btn btn-primary">New Role</a>
                            	</div>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable">
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $role->id }}</td>
                                    </tr>
                                    <tr>
                                    	<th scope="row">Role Name</th>
                                        <td>{{ $role->name }}</td>
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
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
                            	Discipline
                            	<div class="btn-group pull-right" role="group">
                            		<a href='{{ route('admin.disciplines.index') }}' class="btn btn-default">List Disciplines</a>
                            		<a href='{{ route('admin.disciplines.create') }}' class="btn btn-default">New Discipline</a>
                            	</div>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable">
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $discipline->id }}</td>
                                    </tr>
                                    <tr>
                                    	<th scope="row">Discipline Name</th>
                                        <td>{{ $discipline->discipline }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Qualification Level</th>
                                        <td>{{ @$discipline->qualificationLevel->name }}</td>
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
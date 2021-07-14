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
                            	Qualification Level
                            	<div class="btn-group pull-right" role="group">
                            		<a href='{{ route('admin.qualification-levels.index') }}' class="btn btn-primary">List Qualification Levels</a>
                            		<a href='{{ route('admin.qualification-levels.create') }}' class="btn btn-primary">New Qualification Level</a>
                            	</div>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable">
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $qualificationLevel->id }}</td>
                                    </tr>
                                    <tr>
                                    	<th scope="row">Qualification Level</th>
                                        <td>{{ $qualificationLevel->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Institute Type</th>
                                        <td>{{ @$qualificationLevel->instituteType->type }}</td>
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
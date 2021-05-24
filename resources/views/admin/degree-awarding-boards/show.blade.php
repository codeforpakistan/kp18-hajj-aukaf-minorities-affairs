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
                            	Degree Awarding Board
                            	<div class="btn-group pull-right" role="group">
                            		<a href='{{ route('admin.degree-awarding-boards.index') }}' class="btn btn-default">List Degree Awardings Boards</a>
                            		<a href='{{ route('admin.degree-awarding-boards.create') }}' class="btn btn-default">New Degree Awarding Board</a>
                            	</div>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable">
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $degreeAwarding->id }}</td>
                                    </tr>
                                    <tr>
                                    	<th scope="row">Degree Awarding Board</th>
                                        <td>{{ $degreeAwarding->name }}</td>
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
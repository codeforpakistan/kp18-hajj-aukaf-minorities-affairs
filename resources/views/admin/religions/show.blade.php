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
                            	Religion
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable table-striped table-hover table-bordered">
                                    <tr>
                                    	<th scope="row">Religion Name</th>
                                        <td>{{ $religion->religion_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $religion->id }}</td>
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
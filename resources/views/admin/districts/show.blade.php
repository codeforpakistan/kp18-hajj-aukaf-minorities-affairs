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
                            	View district
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover js-exportable">
                                    <tr>
                                    	<th scope="row">Name</th>
                                        <td>{{ $city->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Latitude</th>
                                        <td>{{ $city->latitude }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Longitude</th>
                                        <td>{{ $city->longitude }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Province</th>
                                        <td>{{ $city->province }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $city->id }}</td>
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
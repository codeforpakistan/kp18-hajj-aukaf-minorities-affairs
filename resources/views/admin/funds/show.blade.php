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
                                Fund: ({{ $fund->fund_name }})
                                <div class="btn-group pull-right" role="group">
                                    <a href='{{ route('admin.funds.index') }}' class="btn btn-default">List Funds</a>
                                    <a href='{{ route('admin.funds.create') }}' class="btn btn-default">New Fund</a>
                                </div>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table dataTable js-exportable">
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $fund->id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fund Category Name</th>
                                        <td><a href="{{ route('admin.fund-categories.show', [$fund->fund_category_id]) }}">{{ $fund->fundCategory->type_of_fund }}</a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fund Sub Category Name</th>
                                        <td><a href="{{ route('admin.fund-categories.show', [$fund->sub_category_id]) }}">{{ $fund->subCategory->type }}</a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fund Name</th>
                                        <td>{{ $fund->fund_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Amount</th>
                                        <td>{{ $fund->total_amount }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Amount Remaining</th>
                                        <td>{{ $fund->amount_remianing }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Last Date</th>
                                        <td>{{ $fund->last_date }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fund for Year</th>
                                        <td>{{ $fund->fund_for_year }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Receiving date</th>
                                        <td>{{ $fund->receiving_date }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status</th>
                                        <td>
                                            @if ($fund->active == 1)
                                                <span class="label label-success">Active</span>
                                            @else
                                                <span class="label label-danger">Disabled</span>
                                            @endif

                                        </td>
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
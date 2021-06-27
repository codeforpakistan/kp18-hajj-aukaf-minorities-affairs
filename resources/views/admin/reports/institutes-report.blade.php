@extends('admin.layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Institutes Report</h2>
                        </div>
                        <div class="body">
                            {!! Form::open(['route' => 'admin.reports.institutes-report', 'method' => "GET"]) !!}
                                <div class="row">
                                    <div class="form-line col-lg-6">
                                        {!! Form::select('year', $years, request()->has('year') ? request()->input('year') : null, [
                                            'class' => 'form-control show-tick',
                                            'id' => 'year',
                                            'label' => false,
                                            'required',
                                        ]) !!}
                                        <small class="myspan">Select year</small>
                                    </div>
                                    <div class="form-line col-lg-6">
                                        {!! Form::select('fund', $fundsList, request()->has('fund') ? request()->input('fund') : null, [
                                            'class' => 'form-control show-tick',
                                            'id' => 'fund',
                                            'label' => false,
                                            'required',
                                        ]) !!}
                                        <small class="myspan">Select fund</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-line col-lg-3">
                                        <button class="btn btn-primary waves-effect" type="submit" id="submit">Submit</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                            <div class="table-responsive">{!! $dataTable->table() !!}</div></div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
@endsection
@push('css')
    {{-- Datatables bootstrap --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap.min.js"></script>
     
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush
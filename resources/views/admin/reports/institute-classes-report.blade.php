@extends('admin.layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Institutes Classes Report</h2>
                        </div>
                        <div class="body">
                            {!! Form::open(['route' => 'admin.reports.institutes-report', 'method' => "GET"]) !!}
                                <div class="row">
                                    <div class="form-line col-lg-4">
                                        {!! Form::select('year', $years, request()->has('year') ? request()->input('year') : null, [
                                            'class' => 'form-control show-tick',
                                            'id' => 'year',
                                            'label' => false,
                                            'required',
                                        ]) !!}
                                        <small class="myspan">Select year</small>
                                    </div>
                                    <div class="form-line col-lg-4">
                                        {!! Form::select('fund', $fundsList, request()->has('fund') ? request()->input('fund') : null, [
                                            'class' => 'form-control show-tick',
                                            'id' => 'fund',
                                            'label' => false,
                                            'required',
                                            'placeholder' => 'Select Fund',
                                            'onchange' => 'getInstitutes(event)'
                                        ]) !!}
                                        <small class="myspan">Select fund</small>
                                    </div>
                                    <div class="form-line col-lg-4">
                                        {!! Form::select('institute', [], request()->has('institute') ? request()->input('institute') : null, [
                                            'class' => 'form-control show-tick',
                                            'id' => 'institutes',
                                            'label' => false,
                                            'required',
                                            'placeholder' => 'Select Institute'
                                        ]) !!}
                                        <small class="myspan">Select Institute</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-line col-lg-3">
                                        <button class="btn btn-primary waves-effect" type="submit" id="submit">Submit</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                            <div class="table-responsive">{{-- {!! $dataTable->table() !!} --}}</div>
                        </div>
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
    <script type="text/javascript">
        let url = '{{route('admin.funds.institutes-by-fund',['fund_id' => ':fund_id'])}}';
        function getInstitutes(e){
            let fund_id = $("#fund").val();
            axios({
                url : url.replace(':fund_id',fund_id)
            }).then((response) => {
                $("#institutes").html(``);
                let options = '<option value="" disabled selected style="display:none">Select Institute</option>';
                for(let institute of response.data.data)
                {
                    options += `<option value=${institute.id}>${institute.name}</option>`
                }
                $("#institutes").html(options);
            })
        }
    </script>
@endpush
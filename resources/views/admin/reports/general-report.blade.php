@extends('admin.layouts.app')
@php
    $options = [
        'created_by' => 'Created By (operator)',
        'updated_by' => 'Modified By (operator)',
        'income' => 'Income',
        'family_members' => 'Family Members',
        'current_address' => 'Current Address',
        'permanent_address' => 'Permanent Address',
        'postal_address' => 'Postal Address',
        'amount_recived' => 'Amount Recieved',
        'cheque_no' => 'Cheque No',
        'applying_date' => 'Applying Date',
        'payment_date' => 'Payment Date',
        'signature' => 'Signature',
        'remarks' => 'Remarks'
    ];
@endphp
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>General Report</h2>
                        </div>
                        <div class="body">
                            <div class="search-form">
                                @include('admin.reports.general-search',['options' => $options])
                            </div>
                            @if($fund)
                                {!! $dataTable->table() !!}
                            @endif
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
    <link rel="stylesheet" href="{{asset('css/materialize.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap.min.js"></script>
     
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('client/plugins/bootstrap-inputmask/jquery.inputmask.min.js') }}"></script>
    @if($fund)
        {!! $dataTable->scripts() !!}
    @endif
    <script type="text/javascript">
        let options = @json($options);
        let keys = Object.keys(options);
        let checkedOpts = 0;
        $(window).load(function(){
            $( "#generalreportdatatable-table" ).wrap('<div style="width:100%;overflow-x:auto"></div>')
            $('#generalreportdatatable-table th').css({'min-width' : '150px'});
            $('#generalreportdatatable-table td').css({'min-width' : '150px'});
        });
        $(document).on('click','.option',function(e){
            if($(e.target).prop('id') === 'check_all')
            {
                checkedOpts = $(e.target).is(":checked") ? keys.length : 0;
                for( let key of keys){
                    $(`#${key}`).prop('checked',$(e.target).is(":checked"));
                }
            }
            else
            {
                if(! $(e.target).is(":checked"))
                {
                    checkedOpts--;
                }
                else{
                    checkedOpts++;
                }
                $('#check_all').prop('checked',checkedOpts === keys.length);   
            }
        });
    </script>
@endpush
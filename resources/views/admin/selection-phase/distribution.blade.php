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
                                Poverty based selection
                            </h2>
                        </div>
                        <div class="body">
                            <div class="search-form">
                                @include('admin.selection-phase.search')
                            </div>
                            <div class="table-responsive">{!! $dataTable->table() !!}</div>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script>
        @if(session()->has('create-success'))
            $(window).load(function(){
                swal("Poof! The record has been created!", {
                    icon: "success",
                });
            });
        @endif
        @if(session()->has('create-failed'))
            $(window).load(function(){
                swal("Oh noes!! Could not create the record!", {
                    icon: "error",
                });
            });
        @endif
        @if(session()->has('edit-success'))
            $(window).load(function(){
                swal("Poof! The record has been updated!", {
                    icon: "success",
                });
            });
        @endif
        @if(session()->has('edit-failed'))
            $(window).load(function(){
                swal("Oh noes!! Could not update the record!", {
                    icon: "error",
                });
            });
        @endif
        @if(session()->has('delete-success'))
            $(window).load(function(){
                swal("Poof! The record has been deleted!", {
                    icon: "success",
                });
            });
        @endif
        @if(session()->has('delete-failed'))
            $(window).load(function(){
                swal("Oh noes!! Could not delete the record!", {
                    icon: "error",
                });
            });
        @endif
    </script>
@endpush
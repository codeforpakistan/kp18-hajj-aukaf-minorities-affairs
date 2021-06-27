@extends('admin.layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Region / Religion Report</h2>
                        </div>
                        <div class="body">
                            {!! Form::open(['route' => 'admin.reports.region-religion-report', 'method' => "GET"]) !!}
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
                                        ]) !!}
                                        <small class="myspan">Select fund</small>
                                    </div>
                                    <div class="form-line col-lg-4">
                                        {!! Form::select('applicant_status', ['all' => 'All','selected' => 'Selected','notselected' => 'Not Selected', 'distributed' => 'Distributed'], request()->has('applicant_status') ? request()->input('applicant_status') : null, [
                                            'class' => 'form-control show-tick',
                                            'id' => 'applicant_status',
                                            'label' => false,
                                            'required',
                                        ]) !!}
                                        <small class="myspan">Select applicant's status</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-line col-lg-3">
                                        <button class="btn btn-primary waves-effect" type="submit" id="submit">Submit</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        @if(count($data))
                            <div class="header">
                                <h2>Gender Report</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Gender</th>
                                            <th>Applicants</th>
                                            <th>Percentage</th>
                                            <th>Remarks</th>
                                        </thead>
                                        <tbody>
                                            @foreach($data['genderWise'] as $gender)
                                                <tr>
                                                    <td>{{ucfirst($gender['gender'])}}</td>
                                                    <td>{{$gender['total']}}</td>
                                                    <td>{{round($gender['total']  / $data['totalApplicants'] * 100,2)}}%</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="text-right">Total</td>
                                                <td>{{$data['totalApplicants']}}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="header">
                                <h2>Religion Report</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Religion Name</th>
                                            <th>No's Applicants</th>
                                            <th>Percentage</th>
                                            <th>Remarks</th>
                                        </thead>
                                        <tbody>
                                            @foreach($data['religionWise'] as $religion)
                                                <tr>
                                                    <td>{{ucfirst($religion['religion_name'])}}</td>
                                                    <td>{{$religion['total']}}</td>
                                                    <td>{{number_format(round($religion['total']  / $data['totalApplicants'] * 100,2),2)}}%</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="text-right">Total</td>
                                                <td>{{$data['totalApplicants']}}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="header">
                                <h2>District Report</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>District</th>
                                            <th>Religion Wise</th>
                                            <th>Total Applicant</th>
                                            <th>Remarks</th>
                                        </thead>
                                        <tbody>
                                            @foreach($data['districtWise'] as $district)
                                            <tr>
                                                <td>{{ $district->name }}</td>
                                                <td>
                                                    <table class="table table-bordered" style="background: inherit;">
                                                        @foreach($data['religionDistrictWise']->where('city_id',$district->id) as $rdw)
                                                            <tr>
                                                                <th>{{ $rdw->religion_name }}</th>
                                                                <td>{{ $rdw->total }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                                <td>{{$district->total}}</td>
                                                <td></td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td class="text-right" colspan="2">Total</td>
                                                <td>{{ $data['totalApplicants'] }}</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
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
    {{-- {!! $dataTable->scripts() !!} --}}
@endpush
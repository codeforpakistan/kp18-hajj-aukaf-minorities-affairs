<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Date wise Report</title>
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <style type="text/css">
    	* {
    	  -webkit-box-sizing: border-box;
    	  overflow: visible !important;
    	}

    	.page-header{
    		font-size: 16px;
    		color: #377824;
    		font-weight: 600;
    	}
    	.page-header > img{
    		margin-right: 20px;
    	}
    	.page-header > div{
    		padding-top: 18px;
    		font-size: 16pt !important;
    	}
    	h2{
    		font-size: 16pt !important;
    	}
    	.flexrow, .d-flex {
    	  display: -webkit-box;
    	  display: -webkit-flex;
    	  display: flex;
    	}
    	.align-items-center{
    		align-items: center;
    	}
    	.flexrow > .f1{
    		width: 50%;
    	}
    	.flexrow > .f2{
    		width: 50%;
    		text-align: left;
    	}
    	.flexrow > div {
    	  -webkit-box-flex: 1;
    	  -webkit-flex: 1;
    	  flex: 1;
    	  margin-right: 10%;
    	}
    	.flexrow > div:last-child {
    	  margin-right: 0;
    	}

    	thead {
            display: table-header-group;
        }
        tfoot {
            display: table-row-group;
        }
        tr {
            page-break-inside: avoid;
        }

    </style>
</head>
<body>
	<div class="page-header d-flex align-items-center">
		<img src="{{asset('img/logo.png')}}">
		<div>Auqaf, hajj, Religious & Minority Affairs</div>
	</div>
	@if(count($data))
	    <div class="header">
	        <h2>Gender Report</h2>
	    </div>
	    <div class="body">
            <table class="table table-bordered">
                <thead>
                    <th>Gender</th>
                    <th>No. of Applicants</th>
                    <th>Percentage</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                    @foreach($data['genderWise'] as $gender)
                        <tr style="page-break-inside: avoid;">
                            <td>{{ucfirst($gender['gender'])}}</td>
                            <td>{{$gender['total']}}</td>
                            <td>{{round($gender['total']  / $data['totalApplicants'] * 100,2)}}%</td>
                            <td></td>
                        </tr>
                    @endforeach
                    <tr style="page-break-inside: avoid;">
                        <td class="text-right">Total</td>
                        <td>{{$data['totalApplicants']}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
	    </div>
	    <div class="header">
	        <h2>Religion Report</h2>
	    </div>
	    <div class="body">
            <table class="table table-bordered">
                <thead>
                    <th>Religion Name</th>
                    <th>No. of Applicants</th>
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
	    <div class="header">
	        <h2>District Report</h2>
	    </div>
	    <div class="body">
	        <div class="table-responsive">
	            <table class="table table-bordered">
	                <thead>
	                    <th>District</th>
	                    <th>Religion Wise</th>
	                    <th>Total Applicants</th>
	                    <th>Remarks</th>
	                </thead>
	                <tbody>
	                    @foreach($data['districtWise'] as $district)
	                    <tr>
	                        <td>{{ $district->name }}</td>
	                        <td>
	                            {{-- <table class="table table-bordered"> --}}
	                                @foreach($data['religionDistrictWise']->where('city_id',$district->id) as $rdw)
	                                    <div class="flexrow">
	                                        <div class="f1">{{ $rdw->religion_name }}</div>
	                                        <div class="f2">{{ $rdw->total }}</div>
	                                    </div>
	                                @endforeach
	                            {{-- </table> --}}
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
</body>
</html>
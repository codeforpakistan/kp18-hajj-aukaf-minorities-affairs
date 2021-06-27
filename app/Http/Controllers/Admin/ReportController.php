<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\GeneralReportDataTable;
use App\DataTables\InstituteReportDataTable;
use App\Http\Controllers\Controller;
use App\Models\ApplicantFundDetail;
use App\Models\City;
use App\Models\Fund;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
    {
        public function generalReport(GeneralReportDataTable $dataTable)
        {
            $years = Fund::where(['active' => 1])->pluck('fund_for_year', 'fund_for_year');
            $fundsList = Fund::where(['active' => 1])->pluck('fund_name', 'id');
            $citiesList = City::orderBy('name', 'ASC')->pluck('name', 'id');
            $userList = User::orderBy('name', 'ASC')->pluck('name', 'id');
            $religionsList = Religion::orderBy('religion_name', 'ASC')->pluck('religion_name', 'id');

            $fund = Fund::find(request()->fund);
            
            $data = [
                'years' => $years,
                'fundsList' => $fundsList,
                'citiesList'    => $citiesList,
                'religionsList' => $religionsList,
                'userList' => $userList,
                'fund' => $fund
            ];
            
            if($fund)
            {
            	return $dataTable->render('admin.reports.general-report',$data);
            }
            else
            {
                return view('admin.reports.general-report',$data);
            }
        }

        public function institutesReport(InstituteReportDataTable $dataTable)
        {
            $years = Fund::where(['active' => 1])->pluck('fund_for_year', 'fund_for_year');
            $fundsList = Fund::where(['active' => 1])->pluck('fund_name', 'id');
            return $dataTable->render('admin.reports.institutes-report',[
                'years' => $years,
                'fundsList' => $fundsList,
            ]);
        }

        public function institutesClassesReport(Request $request)
        {
        	return view('admin.reports.institutes-classes-report');
        }

        public function institutesStudentsReport(Request $request)
        {
        	return view('admin.reports.institutes-students-report');
        }

        public function regionReligionReport(Request $request)
        {
            $data = [];
            if(request()->fund)
            {
                $data = $this->regionReligionData();
            }
            $years = Fund::where(['active' => 1])->pluck('fund_for_year', 'fund_for_year');
            $fundsList = Fund::where(['active' => 1])->pluck('fund_name', 'id');
            
        	return view('admin.reports.region-religion-report',[
                'years' => $years,
                'fundsList' => $fundsList,
                'data' => $data,
            ]);
        }

        public function regionReligionData()
        {
            $sql = ApplicantFundDetail::join('applicants','applicants.id','=','applicant_fund_details.applicant_id')
                                ->join('religions','religions.id','=','applicants.religion_id')
                                ->join('applicant_addresses','applicant_addresses.applicant_id','=','applicants.id')
                                ->join('cities','applicant_addresses.city_id','=','cities.id')
                                ->where('applicant_fund_details.fund_id',request()->fund);

            if (request()->applicant_status == 'selected') {
                $sql->where('applicant_fund_details.selected',1)
                ->whereNotNull('applicant_fund_details.amount_recived')
                ->where('applicant_fund_details.distributed',0);
            }
            
            if (request()->applicant_status == 'notselected') {
                $sql->where('applicant_fund_details.selected',0)
                ->whereNull('applicant_fund_details.amount_recived')
                ->where('applicant_fund_details.distributed',0);
            }
            
            if (request()->applicant_status == 'distributed') {
                $sql->where('applicant_fund_details.distributed',1);
            }
            // total applicants count
            $totalApplicantsQuery = clone $sql;
            $totalApplicants = $totalApplicantsQuery->count();
            // district wise
            $districtWiseQuery = clone $sql;
            $districtWiseQuery->select('cities.id','cities.name',\DB::raw('COUNT(applicant_fund_details.fund_id) as total'));
            $districtWiseQuery->groupBy('applicant_addresses.city_id')->orderByDesc('total');
            
            $genderWiseQuery = clone $sql;
            $genderWiseQuery->select('applicants.gender',\DB::raw('COUNT(applicant_fund_details.fund_id) as total'));
            $genderWiseQuery->groupBy('applicants.gender')->orderByDesc('total');
            
            $religionWiseQuery = clone $sql;
            $religionWiseQuery->select('religions.religion_name',\DB::raw('COUNT(applicant_fund_details.fund_id) as total'));
            $religionWiseQuery->groupBy('religions.religion_name')->orderByDesc('total');

            $religionDistrictWiseQuery = clone $sql;
            $religionDistrictWiseQuery->select('religions.religion_name','applicant_addresses.city_id',\DB::raw('COUNT(applicants.religion_id) as total'));
            $religionDistrictWiseQuery->groupBy('applicants.religion_id')->groupBy('applicant_addresses.city_id');

            return [
                'totalApplicants' => $totalApplicants,
                'districtWise' => $districtWiseQuery->get(),   
                'genderWise' => $genderWiseQuery->get(),   
                'religionWise' => $religionWiseQuery->get(),   
                'religionDistrictWise' => $religionDistrictWiseQuery->get(),   
            ];
        }

        public function dateWiseSummary(Request $request)
        {
        	return view('admin.reports.date-wise-summary-report');
        }
}

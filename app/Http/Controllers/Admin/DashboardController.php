<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ApplicantFundDetail;
use App\Helpers\ExceptionHelper;
use App\Models\City;
use App\Models\Discipline;
use App\Models\Fund;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
                
            $funds = DB::table('applicants as app')
                ->join('applicant_fund_details as det', 'app.id', '=', 'det.applicant_id')
                ->join('funds as ap',                   'ap.id',  '=', 'det.fund_id')
                ->join('religions as re',               're.id',  '=', 'app.religion_id')
                ->select(DB::raw('COUNT(religion_id), COUNT(det.applicant_id) as ap, fund_name, religion_id, religion_name'))
                ->where('active', 1)
                ->groupBy('fund_name')
                ->orderBy('ap', 'DESC')
                ->get();

            $ceety = DB::table('applicants as app')
                ->join('applicant_fund_details as det',  'app.id',                '=', 'det.applicant_id')
                ->join('funds as ap',                    'ap.id',                 '=', 'det.fund_id')
                ->join('religions as re',                're.id',                 '=', 'app.religion_id')
                ->join('applicant_addresses as address', 'address.applicant_id',  '=', 'app.id')
                ->join('cities',                         'cities.id',             '=', 'address.city_id')
                ->select(DB::raw('latitude, longitude, cities.name as city'))
                ->where('active', 1)
                ->groupBy('city')
                ->get();

            $religion = DB::table('religions')->get();

            $query_funds = DB::table('applicants as app')
                ->join('applicant_fund_details as det',  'app.id',                '=', 'det.applicant_id')
                ->join('funds as ap',                    'ap.id',                 '=', 'det.fund_id')
                ->join('religions as re',                're.id',                 '=', 'app.religion_id')
                ->join('applicant_addresses as address', 'address.applicant_id',  '=', 'app.id')
                ->join('cities',                         'cities.id',             '=', 'address.city_id')
                ->select(DB::raw('ap.fund_name, count(app.id) as fundcount'))
                ->groupBy('fund_name')
                ->get();

            $query_fund1s = DB::table('applicants as app')
                ->join('applicant_fund_details as det',  'app.id',                '=', 'det.applicant_id')
                ->join('funds as ap',                    'ap.id',                 '=', 'det.fund_id')
                ->join('religions as re',                're.id',                 '=', 'app.religion_id')
                ->join('applicant_addresses as address', 'address.applicant_id',  '=', 'app.id')
                ->join('cities',                         'cities.id',             '=', 'address.city_id')
                ->select(DB::raw('ap.fund_for_year'))
                ->groupBy('fund_for_year')
                ->get();

            $total_funds = DB::table('applicants as app')
                ->join('applicant_fund_details as det',  'app.id',                '=', 'det.applicant_id')
                ->join('funds as ap',                    'ap.id',                 '=', 'det.fund_id')
                ->join('religions as re',                're.id',                 '=', 'app.religion_id')
                ->join('applicant_addresses as address', 'address.applicant_id',  '=', 'app.id')
                ->join('cities',                         'cities.id',             '=', 'address.city_id')
                ->select(DB::raw('COUNT(app.id) as count'))
                ->groupBy('fund_for_year')
                ->get();

            $city = City::pluck('name', 'id');

            $fundsList = Fund::groupBy('fund_for_year')->pluck('fund_for_year', 'fund_for_year');

            return view('admin.dashboard.index', [
                'city' => $city,
                'funds' => $funds,
                'fundslist' => $fundsList,
                'ceety' => $ceety,
                'religion' => $religion,
                'query_funds' => $query_funds,
                'query_fund1s' => $query_fund1s,
                'total_funds' => $total_funds,
            ]);
        } catch (\Exception $e) {
            return ExceptionHelper::customError($e);
        }
    }

    /**
     * Returns a json response listing of the resource.
     *
     * @return \Illuminate\Http\Response\Json
     */
    public function services(Request $request) {
        try {
            if ( $request->has('deselect') ) {
                $applicantFundDetail = ApplicantFundDetail::find($request->id);
                $applicantFundDetail->selected = 0;
                $applicantFundDetail->amount_recived = null;
                if ($applicantFundDetail->save()) {
                    $success = $applicantFundDetail->id;
                } else {
                    $success = 0;
                }
                return response()->json($success);
            }
            if ( $request->has('cheque_no') ) {
                $applicantFundDetail = ApplicantFundDetail::find($request->id);
                $applicantFundDetail->distributed = $request->cheque_no;
                $applicantFundDetail->payment_date = date('Y-m-d');
                if ($applicantFundDetail->save()) {
                    $success = date('M-d-Y', strtotime($applicantFundDetail->payment_date));
                } else {
                    $success = 0;
                }
                return response()->json($success);
            }
            if (isset($_GET['fund_subcategory'])) {
                $fund = Fund::with('subCategory')->find($request->fund_subcategory);
                return response()->json(($fund && $fund->subCategory ? $fund->subCategory->id : 0));
            }
            return response()->json(0);
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }
    }

    /**
     * Returns a json response listing of the resource.
     *
     * @return \Illuminate\Http\Response\Json
     */
    public function fundsAnalysis($id = null) {
        try{
            $ceety = DB::table('applicants as app')
                ->join('applicant_fund_details as det',  'app.id',                '=', 'det.applicant_id')
                ->join('funds as ap',                    'ap.id',                 '=', 'det.fund_id')
                ->join('religions as re',                're.id',                 '=', 'app.religion_id')
                ->join('applicant_addresses as address', 'address.applicant_id',  '=', 'app.id')
                ->join('cities',                         'cities.id',             '=', 'address.city_id')
                ->select(DB::raw('*'))
                ->get();
            return response()->json($ceety->toArray());
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }
    }

    /**
     * Returns a json response listing of the resource.
     *
     * @return \Illuminate\Http\Response\Json
     */
    public function district(Request $request, $id = null, $id1 = null) {
        try{
            $dist = $request->value;
            $dist1 = $request->value1;
            
            $ceety = DB::table('applicants as app')
                ->join('applicant_fund_details as det',  'app.id',                '=', 'det.applicant_id')
                ->join('funds as ap',                    'ap.id',                 '=', 'det.fund_id')
                ->join('religions as re',                're.id',                 '=', 'app.religion_id')
                ->join('applicant_addresses as address', 'address.applicant_id',  '=', 'app.id')
                ->join('cities',                         'cities.id',             '=', 'address.city_id')
                ->select(DB::raw('COUNT(religion_id), COUNT(det.applicant_id) As ap, fund_name, religion_id, religion_name'))
                ->where('fund_name', $dist1)
                ->where('city_id', $dist)
                ->where('active', 1)
                ->groupBy('fund_name')
                ->get();

            $ceety2 = DB::table('applicants as app')
                ->join('applicant_fund_details as det', 'app.id', '=','det.applicant_id')
                ->join('funds as ap', 'ap.id', '=', 'det.fund_id')
                ->join('religions as re', 're.id', '=', 'app.religion_id')
                ->join('applicant_addresses as address', 'address.applicant_id',  '=', 'app.id')
                ->select(DB::raw('religion_name, count(religion_id) as re ,color as co'))
                ->where('active', 1)
                ->where('address.city_id', $dist)
                ->where('fund_name', $dist1)
                ->groupBy('religion_id')
                ->get();

            $records = [
                'district_wise' => $ceety->toArray(),
                'religion_wise' => $ceety2->toArray()
            ];
            return response()->json($records);
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }
    }

    /**
     * Returns a json response listing of the resource.
     *
     * @return \Illuminate\Http\Response\Json
     */
    public function fundsList(Request $request, $id = null) {
        try{
            if ( $request->has('fund_id') ) {
                $institutes = DB::table('institutes as i')
                    ->join('institute_classes', 'institute_classes.institute_id', '=', 'i.id')
                    ->join('applicants as a', 'a.institute_class_id',  '=', 'institute_classes.id')
                    ->join('institute_fund_details as ifd', 'ifd.applicant_id', '=','a.id')
                    ->select(DB::raw('DISTINCT i.id, i.name as institute_name'))
                    ->where('ifd.fund_id', $request->fund_id)
                    ->get();
                return response()->json($institutes);
            }
            if ( $request->has('fundofinstitute') ) {
                $funds = Fund::with(['fundCategory', 'subCategory' => function ($query){
                    $query->where('sub_categories.id', 3);
                }])->where('fund_for_year', $request->fundofinstitute)->get();
                return response()->json($funds);
            }
            if ( $request->has('value') ) {
                $funds = Fund::with(['fundCategory', 'subCategory'])->where('fund_for_year', $request->value)->get();
                return response()->json($funds);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }
    }

    /**
     * Returns a json response listing of the resource.
     *
     * @return \Illuminate\Http\Response\Json
     */
    public function dashboardMap(Request $request, $id = null) {
        try
        {
            $ceety = DB::table('applicants as app')
                ->join('applicant_fund_details as det',  'app.id',                '=', 'det.applicant_id')
                ->join('funds as ap',                    'ap.id',                 '=', 'det.fund_id')
                ->join('religions as re',                're.id',                 '=', 'app.religion_id')
                ->join('applicant_addresses as address', 'address.applicant_id',  '=', 'app.id')
                ->join('cities',                         'cities.id',             '=', 'address.city_id')
                ->select(DB::raw('latitude, longitude'))
                ->where('fund_name', $request->value)
                ->where('active', 1)
                ->get();
            return response()->json($ceety);
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }
    }
}

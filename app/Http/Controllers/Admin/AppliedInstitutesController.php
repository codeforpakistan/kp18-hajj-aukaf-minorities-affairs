<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AppliedInstitutesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Institute;
use Illuminate\Http\Request;

class AppliedInstitutesController extends Controller
{
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function funds(AppliedInstitutesDataTable $dataTable)
    {
        return $dataTable->render('admin.applied-institutes.index');
    }

	public function funds2(Request $request)
	{
		// $page = $request->input('page', 1);
		// $pagesize = $request->input('pagesize', 10);
		
		// $records = Institute::join('users as u','u.id','=','institutes.user_id')
		// ->join('cities','cities.id','=','institutes.city_id')
		// ->join('institute_classes','institutes.id','=','institute_classes.institute_id')
		// ->join('applicants','applicants.institute_class_id','=','institute_classes.id')
		// ->join('institute_fund_details','institute_fund_details.applicant_id','=','applicants.id')
		// ->where('institute_fund_details.fund_id',$request->fund_id)
  //       // ->limit($pagesize)
  //       // ->offset(($page-1)*$pagesize)
  //       ->get();
		
	}
}
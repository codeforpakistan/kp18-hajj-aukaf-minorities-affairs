<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institute;

class AppliedInstitutesController extends Controller
{
	public function institutes(Request $request)
	{
		$records = Institute::join('users','user.id','=','institutes.user_id')
		->join('cities','cities.id','=','institutes.city_id')
		->join('institute_classes','institute_classes.id','=','institutes.institute_class_id')
		->join('applicants','applicants.institute_class_id','=','institute_classes.id')
		->join('institute_fund_details','institute_fund_details.applicant_id','=','applicants.id')
		->where('institute_fund_details.fund_id',$request->fund_id);
		
		dd($records);
	}
}
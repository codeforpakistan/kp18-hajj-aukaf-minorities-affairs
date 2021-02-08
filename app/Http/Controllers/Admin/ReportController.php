<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generalReport(Request $request)
    {
    	return view('admin.reports.general-report');
    }

    public function institutesReport(Request $request)
    {
    	return view('admin.reports.institutes-report');
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
    	return view('admin.reports.region-religion-report');
    }

    public function dateWiseSummary(Request $request)
    {
    	return view('admin.reports.date-wise-summary-report');
    }
}

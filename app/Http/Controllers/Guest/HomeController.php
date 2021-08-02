<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fund;
use App\Models\Qualification;
use App\Models\QualificationLevel;
use App\Models\DegreeAwarding;
use App\Models\Institute;
use App\Models\Religion;
use App\Models\Applicant;
use App\Models\Discipline;
use App\Models\MaritalStatus;
use App\Models\City;
use App\Models\ApplicantFundDetail;
use App\Helpers\ExceptionHelper;
use App\Models\SubCategory;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funds = Fund::where('active', '1')
            ->where('last_date', '>=', date('Y-m-d'))
            ->orderBy('last_date', 'DESC')->pluck('fund_name', 'id');
        $last_date = Fund::where('active', '1')
            ->where('last_date', '>=', date('Y-m-d'))
            ->orderBy('last_date', 'DESC')
            ->get();
        return view('welcome', [
            'last_date' => $last_date,
            'funds' => $funds,
        ]);
    }

    /**
     * Form submitted on the Guest/HomeController@index page will be submitted to this page.
     *
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        if ( $request->has('check_status') ) {
            return $this->checkStatus($request);
        } else {
            // if (\Auth::check() && \Auth::user()->hasRole(['Admin', 'Operator'])) {
                return $this->apply($request);
            // } else {
                // return redirect()->back()->with('error', "Please contact the system administrator for application process.");
            // }
        }
    }

    public function getDisciplines(Request $request)
    {
        if ( $request->has('qualification_level') ) {
            $disciplines = Discipline::where('qualification_level_id',$request->qualification_level)->get();
            return response()->json(['disciplines' => $disciplines]);
        }
        return response()->json(['disciplines' => []]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function checkStatus(Request $request)
    {
        $record = ApplicantFundDetail::with(['applicant', 'fund'])
            ->where('fund_id', $request->fund_id)
            ->whereHas('applicant', function ($query) use ($request) {
                $query->where('cnic', 'LIKE', $request->cnic);
            })
            ->first();
        if ($record) {
            return redirect()->route('guest.home.print', ['token' => $record->id]);
        } else {
            return redirect()->back()->with('error', "You haven't applied for the required grant.");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function apply(Request $request)
    {
        try{
            // check if fund is expired
            $dateExpired = Fund::where('id', $request->fund_id)->where('last_date', '>=', date('Y-m-d'))->first();
            if ( is_null( $dateExpired ) ) {
                return redirect()->back()->with('error', "The Applications for this fund are closed.");
            }

            $check = ApplicantFundDetail::with(['applicant', 'fund'])
                ->where('fund_id', $request->fund_id)
                ->whereHas('applicant', function ($query) use ($request) {
                    $query->where('cnic', 'LIKE', $request->cnic);
                })
                ->get();

            if ( $check->isEmpty() ) {
                $f_cat = SubCategory::get();
            } else {
                return redirect()->back()->with('error', "You Have already applied for the grant.");
            }

            $funds = Fund::where('active', '1')->orderBy('last_date', 'DESC')->pluck('fund_name', 'id');
            $last_date = Fund::where('active', '1')
                ->where('last_date', '>=', date('Y-m-d'))
                ->orderBy('last_date', 'DESC')
                ->get();
            $qualificationLevels = QualificationLevel::pluck('name', 'id');
            $disciplines = Discipline::pluck('discipline', 'id');
            $degreeAwardings = DegreeAwarding::pluck('name', 'id');
            $institutes = Institute::where('type', 'university')->pluck('name', 'id');
            $religions = Religion::pluck('religion_name', 'id');
            $maritalstatus = MaritalStatus::pluck('status', 'id');
            $cities = City::orderBy('name', 'ASC')->pluck('name', 'id');
            $selectedFund = Fund::find($request->fund_id);
            return view('applicants.apply', [
                'selectedFund' => $selectedFund,
                'funds' => $funds,
                'last_date' => $last_date,
                'qualificationLevels' => $qualificationLevels,
                'degreeAwardings' => $degreeAwardings,
                'institutes' => $institutes,
                'religions' => $religions,
                'maritalstatus' => $maritalstatus,
                'disciplines' => $disciplines,
                'cities' => $cities,
            ]);
        } catch (\Exception $e) {
            return ExceptionHelper::customError($e);
        }
    }

    /**
     * Submit application for an applicant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitApplication(Request $request)
    {
        try {
            $applicantId = NULL;
            \DB::beginTransaction();
            foreach ($request->except(['_token']) as $model => $input) {
                $modelRef = 'App\Models\\' . $model;
                $varName = lcfirst($model);
                if ($model == 'Applicant') {
                    if($model = $modelRef::where('cnic',$input['cnic'])->first())
                    {
                        $applicantId = $model->id;
                        $model->update($input);
                    }
                    else{
                        $$varName = $modelRef::create($input);
                        $applicantId = $$varName->id;
                    }
                }
                if ( ! is_null( $applicantId ) ) {
                    if ($model == 'Qualification') {
                        if (!empty($input['total_marks']) && !empty($input['obtained_marks'])) {
                            $input['percentage'] = round(($input['obtained_marks'] * 100) / $input['total_marks'], 2);
                        }
                        if (!empty($request->Institute['name'])) {
                            $instituteType = \App\Models\QualificationLevel::find($input['qualification_level_id']);
                            $instituteInput = $request->Institute;
                            $instituteInput['institute_type_id'] = $instituteType->institute_type_id;
                            $institute = \App\Models\Institute::create($instituteInput);
                            $input['institute_id'] = $institute->id;
                        }
                        if (!empty($request->Discipline['discipline'])) {
                            $input['discipline_id'] = $request->Discipline['discipline'];
                            // < 3 means for Matric & FSC level
                            if($request->Qualification['qualification_level_id'] < 3)
                            {
                                $input['discipline_id'] = $request->Qualification['discipline_id'];
                            }
                        }
                        $input['applicant_id'] = $applicantId;
                        $$varName = $modelRef::create($input);
                    }
                    if ($model == 'ApplicantContact') {
                        if (!empty($request->ApplicantContact['mob_number'][0])) {
                            foreach ($request->ApplicantContact['mob_number'] as $number){
                                $contactAlreadyExists = 
                                    \App\Models\ApplicantContact::where('applicant_id',$applicantId)
                                                                ->where('mob_number',$number)
                                                                ->exists();
                                if(!$contactAlreadyExists)
                                {
                                    \App\Models\ApplicantContact::create([
                                        'applicant_id' => $applicantId,
                                        'mob_number' => $number,
                                    ]);
                                }
                            }
                        }
                    }
                    if ($model == 'ApplicantProfession') {
                        $applicantProfession = \App\Models\ApplicantProfession::create([
                            'applicant_id' => $applicantId,
                            'profession' => $input['profession'],
                        ]);
                    }
                    if ($model == 'ApplicantHouseholdDetail') {
                        $applicantProfession = \App\Models\ApplicantHouseholdDetail::create([
                            'applicant_id' => $applicantId,
                            'dependent_family_members' => $input['dependent_family_members'],
                        ]);
                    }
                    if ($model == 'ApplicantIncome') {
                        $applicantProfession = \App\Models\ApplicantIncome::create([
                            'applicant_id' => $applicantId,
                            'monthly_income' => $input['monthly_income'],
                        ]);
                    }
                    if ($model == 'ApplicantAddress') {
                        $address = \App\Models\ApplicantAddress::where('applicant_id','=',$applicantId)->latest()->first();
                        $applicantAddressInput = [
                            'applicant_id' => $applicantId,
                            'current_address' => $input['current_address'],
                            'permenent_address' => $input['permenent_address'],
                            'postal_address' => $input['current_address'],
                            'city_id' => $input['city_id'],
                        ];
                        if($address)
                        {
                            $address->update($applicantAddressInput);   
                        }
                        else
                        {
                            \App\Models\ApplicantAddress::create($applicantAddressInput);   
                        }
                    }
                }
            }
            $applicantFundDetailInput = $request->ApplicantFundDetail;
            $applicantFundDetailInput['applicant_id'] = $applicantId;
            $applicantFundDetailInput['appling_date'] = date('Y-m-d');
            $applicantFundDetail = ApplicantFundDetail::create($applicantFundDetailInput);
            \DB::commit();
            \Session::flash('success', 'Application successful. Your token number is ' . $applicantFundDetail->id);
            return redirect()->route('guest.home.index');
        } catch (\Exception $e) {
            \DB::rollback();
            report($e);
            \Session::flash('error', 'Something went wrong on server. Contact the department if the issue persists');
            return redirect()->route('guest.home.index');
        }
    }

    /**
     * Show the print view for the searched or added record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        try{
            if ($request->has('token')) {
                $result = \App\Models\ApplicantFundDetail::find($request->token); 
            } else {
                return redirect()->route('guest.home.index')->with('error', "you can not access this location.");
            }
            if (! $result) {
                return redirect()->route('guest.home.index')->with('error', "no application found for this token.");
            }
            return view('applicants.applicant-print', [
                'result' => $result,
            ]);
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('guest.home.index')->with('error', 'Something went wrong on server. Contact the department if the issue persists');
        }
    }
}

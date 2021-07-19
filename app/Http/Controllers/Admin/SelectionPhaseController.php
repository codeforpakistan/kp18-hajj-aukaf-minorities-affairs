<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SelectionPhasePovertyBasedDataTable;
use App\Http\Controllers\Controller;
use App\Models\ApplicantFundDetail;
use App\Models\City;
use App\Models\Fund;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\Religion;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHelper;

class SelectionPhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function povertyBased(SelectionPhasePovertyBasedDataTable $dataTable)
    {
        try{
            $sql = $dataTable->query((new ApplicantFundDetail));
           
            // dd($sql->get());
            $totalCount = $sql->count();

            if(request()->limit && $totalCount){
                $totalCount = intval(request()->limit) <= $totalCount ? intval(request()->limit) : $totalCount;
            }
           
            $ids = $sql->select(['applicant_fund_details.id as id'])->limit($totalCount)->pluck('id')->toArray();

            $fundsList = Fund::with(['subCategory'])->where('active',1)->get();//pluck('fund_name', 'id');

            $selectableList = [];
            foreach ($fundsList as $fund) {
                if($fund->subCategory)
                {
                    $selectableList[] = [
                        'id' => $fund->id,
                        'fund_name' => $fund->fund_name,
                        'sub_category' => $fund->subCategory->type,
                        'grant_or_scholarship' => $fund->subCategory->type === 'Educational grants' ? 1 : 0, // 1 : grant, 0 : sholarship
                    ];
                }
            }

            $distributedAmount = ApplicantFundDetail::where('fund_id',request()->fund)->sum('amount_recived');

            $fund = Fund::find(request()->fund);
            
            $selectedApplicants = 
            ApplicantFundDetail::
            where([
                ['fund_id','=',request()->fund], 
                ['selected','=',1], 
                ['amount_recived', '!=', null]
            ])
            ->count();

            $citiesList = City::orderBy('name', 'ASC')->pluck('name', 'id');
            $religionsList = Religion::orderBy('religion_name', 'ASC')->pluck('religion_name', 'id');

            return $dataTable->render('admin.selection-phase.poverty-based',[
                'fundsList'     => $selectableList,
                'citiesList'    => $citiesList,
                'religionsList' => $religionsList,
                'fund' => $fund,
                'distributedAmount' => $distributedAmount,
                'selectedApplicants' => $selectedApplicants,
                'totalCount' => $totalCount,
                'ids' => $ids,
            ]);
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            return ExceptionHelper::customError($e);
        }
    }

    public function submitSelection()
    {
        try {
            $amountPerHead = request()->amount_per_head;
            $ids = request()->ids;
            
            if(intval($amountPerHead)){
                ApplicantFundDetail::whereIn('id',$ids)
                                    ->update([
                                        'selected' => 1,
                                        'amount_recived' => $amountPerHead
                                    ]);
                return response()->json(['message' => 'Applicants are selected successfully'],200);
            }else{

                return response()->json(['error' => 'Amount per head should be greater that zero'],500);

            }
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {

            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        
        }

    }

    public function balloting()
    {
        try{
            $fundsList = Fund::where('active',1)->pluck('fund_name', 'id');
            $citiesList = City::orderBy('name', 'ASC')->pluck('name', 'id');
            $religionsList = Religion::orderBy('religion_name', 'ASC')->pluck('religion_name', 'id');

            return view('admin.selection-phase.balloting',[
                'fundsList' => $fundsList,
                'citiesList'    => $citiesList,
                'religionsList' => $religionsList,
            ]);
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }
    }

    public function getApplicantsForBalloting()
    {
        try {
            
            $distributedAmount = ApplicantFundDetail::where('fund_id',request()->fund)->sum('amount_recived');
            $fund = Fund::find(request()->fund);
            $selectedApplicants = 
            ApplicantFundDetail::
            where([
                ['fund_id','=',request()->fund], 
                ['selected','=',1], 
                ['amount_recived', '!=', null]
            ])
            ->count();
            
            $sql = $this->ballotingQuery();
            $data = [
                'list' => $sql->get(),
                'fund' => $fund,
                'selectedApplicants' => $selectedApplicants,
                'distributedAmount' => $distributedAmount
            ];
            
            return response()->json($data,200);

        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }
    }

    public function ballotingQuery()
    {
        $distributedAmount = ApplicantFundDetail::where('fund_id',request()->fund)->sum('amount_recived');
        $sql = ApplicantFundDetail::join('applicants','applicants.id','=','applicant_fund_details.applicant_id')
                                    ->join('religions','religions.id','=','applicants.religion_id')
                                    ->leftJoin('applicant_addresses','applicant_addresses.applicant_id','=','applicants.id')
                                    ->leftJoin('cities','cities.id','=','applicant_addresses.city_id')
                                    ->join('funds','funds.id','=','applicant_fund_details.fund_id')
                                    ->leftJoin('applicant_household_details','applicant_household_details.applicant_id','=','applicants.id')
                                    ->leftJoin('applicant_incomes','applicant_incomes.applicant_id','=','applicants.id')
                                    ->where([
                                        ['funds.total_amount', '>', floatval($distributedAmount)],
                                        ['applicant_fund_details.amount_recived', '=', null],
                                        ['applicant_fund_details.selected', '=', 0],
                                        ['applicant_fund_details.fund_id', '=', intval(request()->fund)],
                                    ])
                                    ;
        if(!empty(request()->religion)){
            $sql->where('applicants.religion_id',intval(request()->religion));
        }

        if(!empty(request()->city)){
            $sql->where('applicant_addresses.city_id',intval(request()->city));
        }

        if(!empty(request()->limit)){
            $sql->limit(intval(request()->limit));
        }

        $sql->select([
            'applicant_fund_details.id',
            'applicant_fund_details.appling_date',
            'applicants.name',
            'applicants.father_name',
            'applicants.gender',
            'applicants.cnic',
            'applicant_household_details.dependent_family_members',
            'applicant_incomes.monthly_income',
            'cities.name as city_name',
            'religions.religion_name'
        ]);



        return $sql;
    }

    public function deselect()
    {
        try{
            $fundsList = Fund::where('active',1)->pluck('fund_name', 'id');
            $citiesList = City::orderBy('name', 'ASC')->pluck('name', 'id');
            $religionsList = Religion::orderBy('religion_name', 'ASC')->pluck('religion_name', 'id');
            return view('admin.selection-phase.deselect',[
                'fundsList' => $fundsList,
                'citiesList'    => $citiesList,
                'religionsList' => $religionsList,
            ]);
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            return ExceptionHelper::customError($e);
        }
    }

    /**
     * This query is used for both de-selection and distribute grants
     * @return 
     */
    public function commonQuery()
    {
        $select = [];   
        $sql = ApplicantFundDetail::join('applicants','applicants.id','=','applicant_fund_details.applicant_id')
                                    ->join('religions','religions.id','=','applicants.religion_id')
                                    ->leftJoin('applicant_addresses','applicant_addresses.applicant_id','=','applicants.id')
                                    ->leftJoin('cities','cities.id','=','applicant_addresses.city_id')
                                    ->join('funds','funds.id','=','applicant_fund_details.fund_id')
                                    ->leftJoin('applicant_household_details','applicant_household_details.applicant_id','=','applicants.id')
                                    ->leftJoin('applicant_incomes','applicant_incomes.applicant_id','=','applicants.id')
                                    ->where([
                                        ['applicant_fund_details.amount_recived', '!=', null],
                                        ['applicant_fund_details.selected', '=', 1],
                                        ['applicant_fund_details.distributed', '=', 0],
                                        ['applicant_fund_details.fund_id', '=', intval(request()->fund)],
                                    ]);
        if(!empty(request()->fund)){
            $fund = Fund::with(['subCategory'])->where('id', intval(request()->fund))->first();//pluck('fund_name', 'id');
            if($fund->subCategory->id === 3){
                $sql->join('qualifications',function($q){
                    $q->on('qualifications.applicant_id','applicants.id');
                    $q->join('qualification_levels','qualification_levels.id','qualifications.qualification_level_id');
                    $q->join('disciplines','disciplines.id','qualifications.discipline_id');
                });
                $select = array_merge($select,['qualifications.percentage','qualifications.passing_date','qualifications.recent_class','qualifications.current_class','disciplines.discipline','qualification_levels.name as qualification_name']);
            }
        }

        if(!empty(request()->religion)){
            $sql->where('applicants.religion_id',intval(request()->religion));
        }

        if(!empty(request()->city)){
            $sql->where('applicant_addresses.city_id',intval(request()->city));
        }

        if(!empty(request()->token)){
            $sql->where('applicant_fund_details.id',intval(request()->token));
        }

        if(!empty(request()->cnicOrName)){
            $sql->where(function($query){
                $query->where('applicants.cnic','like','%'.request()->cnicOrName.'%')
                ->orWhere('applicants.name','like','%'.request()->cnicOrName.'%');
            });
        }

        $sql->select(array_merge($select,[
            'applicant_fund_details.id',
            'applicant_fund_details.appling_date',
            'applicant_fund_details.selected',
            'applicant_fund_details.amount_recived',
            'applicant_fund_details.check_number',
            'applicant_fund_details.payment_date',
            'applicant_fund_details.distributed',
            'applicants.name',
            'applicants.father_name',
            'applicants.gender',
            'applicants.cnic',
            'applicant_household_details.dependent_family_members',
            'applicant_incomes.monthly_income',
            'cities.name as city_name',
            'religions.religion_name'
        ]));

        return $sql;
    }

    public function deselectApplicant(){
        
        try {
            $updated = ApplicantFundDetail::where('id',intval(request()->id))
                                ->update([
                                    'selected' => 0,
                                    'amount_recived' => null
                                ]);
            if($updated){
                return response()->json(['message' => 'Applicant has been deselected'],200);
            }
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }
    }

    public function getApplicants()
    {
        try {
            
            $sql = $this->commonQuery();

            $data = [
                'list' => $sql->get(),
            ];
            
            return response()->json($data,200);

        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }
    }

    public function distribution()
    {
        $fundsList = Fund::where('active',1)->pluck('fund_name', 'id');
        $citiesList = City::orderBy('name', 'ASC')->pluck('name', 'id');
        $religionsList = Religion::orderBy('religion_name', 'ASC')->pluck('religion_name', 'id');

        return view('admin.selection-phase.grants',[
            'fundsList' => $fundsList,
            'citiesList' => $citiesList,
            'religionsList' => $religionsList
        ]);
    }

    public function submitDistribution()
    {
        try{

            $updated = ApplicantFundDetail::where('id',intval(request()->id))
                                ->update([
                                    'distributed' => request()->distributed,
                                    'payment_date' => now()
                                ]);
            if($updated){
                return response()->json(['message' => 'Distributed'],200);
            }
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }
    }
}

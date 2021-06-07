<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SelectionPhaseDistributionDataTable;
use App\Http\Controllers\Controller;
use App\Models\ApplicantFundDetail;
use App\Models\City;
use App\Models\Fund;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\Religion;
use Illuminate\Http\Request;

class SelectionPhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function distribution(SelectionPhaseDistributionDataTable $dataTable)
    {
        $sql = $dataTable->query((new ApplicantFundDetail));
       
        $totalCount = $sql->count();

        if(request()->limit && $totalCount){
            $totalCount = intval(request()->limit) <= $totalCount ? intval(request()->limit) : $totalCount;
        }
       
        $ids = $sql->select(['applicant_fund_details.id as id'])->limit($totalCount)->pluck('id')->toArray();

        $fundsList = Fund::with(['subCategory'])->where(['active' => 1])->get();//pluck('fund_name', 'id');

        $selectableList = [];

        foreach ($fundsList as $fund) {
            $selectableList[] = [
                'id' => $fund->id,
                'fund_name' => $fund->fund_name,
                'sub_category' => $fund->subCategory->type,
                'grant_or_scholarshipt' => $fund->subCategory->type === 'Educational grants' ? 1 : 0, // 1 : grant, 0 : sholarship
            ];
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

        return $dataTable->render('admin.selection-phase.distribution',[
            'fundsList'     => $selectableList,
            'citiesList'    => $citiesList,
            'religionsList' => $religionsList,
            'fund' => $fund,
            'distributedAmount' => $distributedAmount,
            'selectedApplicants' => $selectedApplicants,
            'totalCount' => $totalCount,
            'ids' => $ids,
        ]);
    }

    public function submitDistribution()
    {
        return response()->json(['message' => 'Applicants are selected successfully'],200);
        try {
            
            $amountPerHead = request()->amount_per_head;
            $ids = request()->ids;
            
            if(intval($amountPerHead)){
                ApplicantFundDetail::whereIn('id',$ids)
                                    ->update([
                                        'selected' => 1,
                                        'amount_recived' => $amountPerHead
                                    ]);
            }else{

                return response()->json(['error' => 'Amount per head should be greater that zero'],500);

            }
        } catch (\Exception $e) {

            return response()->json(['error' => 'Something went wrong'],500);
        
        }

    }

    public function balloting()
    {
        // $sql = $this->ballotingQuery((new ApplicantFundDetail));
       
        // $totalCount = $sql->count();

        // if(request()->limit && $totalCount){
        //     $totalCount = intval(request()->limit) <= $totalCount ? intval(request()->limit) : $totalCount;
        // }
       
        // $ids = $sql->select(['applicant_fund_details.id as id'])->limit($totalCount)->pluck('id')->toArray();

        $fundsList = Fund::where(['active' => 1])->pluck('fund_name', 'id');
        $citiesList = City::orderBy('name', 'ASC')->pluck('name', 'id');
        $religionsList = Religion::orderBy('religion_name', 'ASC')->pluck('religion_name', 'id');

        // $selectableList = [];

        // foreach ($fundsList as $fund) {
        //     $selectableList[] = [
        //         'id' => $fund->id,
        //         'fund_name' => $fund->fund_name,
        //         'sub_category' => $fund->subCategory->type,
        //         'grant_or_scholarshipt' => $fund->subCategory->type === 'Educational grants' ? 1 : 0, // 1 : grant, 0 : sholarship
        //     ];
        // }
        return view('admin.selection-phase.balloting',[
            'fundsList' => $fundsList,
            'citiesList'    => $citiesList,
            'religionsList' => $religionsList,
        ]);
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

        } catch (\Exception $e) {
            return response()->json(['message'=>'Something went wrong'],500);
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
        if(request()->religion){
            $sql->where('applicants.religion_id',intval(request()->religion));
        }

        if(request()->city){
            $sql->where('applicant_addresses.city_id',intval(request()->city));
        }

        if(request()->limit && intval(request()->limit)){
            $sql->limit(intval(request()->limit));
        }

        $sql->select([
            'applicant_fund_details.id',
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

    public function submitBalloting()
    {
        dd(request()->all());
    }

}

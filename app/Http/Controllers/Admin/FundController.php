<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FundDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\FundRequest;
use App\Models\Fund;
use App\Models\FundCategory;
use App\Models\Institute;
use App\Helpers\ExceptionHelper;
use Illuminate\Validation\ValidationException;
use App\Models\InstituteFundDetail;
use App\Models\SubCategory;
use Illuminate\Http\Request;


class FundController extends Controller
{
    protected $indexRoute = 'admin.funds.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FundDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.funds.index');
        } catch (\Exception $e) {
            return ExceptionHelper::customError($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $fundCategories = FundCategory::pluck('type_of_fund', 'id');
            $subCategories = [];
            return view('admin.funds.create', [
                'fundCategories' => $fundCategories,
                'subCategories'  => $subCategories,
            ]);
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request,[
                'fund_category_id' => 'required',
                'sub_category_id' => 'required',
                'fund_name' => 'required|unique:funds',
                'total_amount' => 'required|numeric',
                'last_date' => 'required',
                'fund_for_year' => 'required',
            ]);
            if($request->sub_category_id == '3')
            {
                $this->validate($request,[
                    'institute_students' => 'required',
                ]);
            }

            $fund = Fund::create($request->only(['fund_category_id', 'sub_category_id', 'fund_name', 'total_amount', 'last_date', 'fund_for_year', 'institute_students']));
            if ($fund->wasRecentlyCreated) {
                \Session::flash('create-success', 'The record has been created!');
                return redirect()->route('admin.funds.index');
            } else {
                \Session::flash('create-failed', 'Could not create the record!');
                return redirect()->route('admin.funds.index');
            }
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $fund = Fund::find($id);
            return view('admin.funds.show', [
                'fund' => $fund,
            ]);
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->route($this->indexRoute);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function institutes(Request $request, $fund_id)
    {
        try{
            $institutes =
            Institute::join('institute_classes','institute_classes.institute_id','=','institutes.id')
            ->join('applicants','applicants.institute_class_id','=','institute_classes.id')
            ->join('institute_fund_details','institute_fund_details.applicant_id','applicants.id')
            ->where('institute_fund_details.fund_id',$fund_id)
            ->select('institutes.id','institutes.name')
            ->get();

            // $institutes =
            // Institute::join('institute_classes','institute_classes.institute_id','=','institutes.id')
            // ->where('institute_classes.fund_id',$fund_id)
            // ->select('institutes.id','institutes.name')
            // ->get();

            return response()->json(['data' => $institutes],200);
        } catch (\Exception $e) {
            return response()->json(['message' => ExceptionHelper::somethingWentWrong($e)],500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $fund = Fund::find($id);
            $fundCategories = FundCategory::pluck('type_of_fund', 'id');
            $subCategories = SubCategory::where('fund_category_id', $fund->fund_category_id)->pluck('type', 'id');
            return view('admin.funds.edit', [
                'fund' => $fund,
                'fundCategories' => $fundCategories,
                'subCategories'  => $subCategories,
            ]);
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->route($this->indexRoute);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try{
            $this->validate($request,[
                'fund_category_id' => 'required',
                'sub_category_id' => 'required',
                'fund_name' => 'unique:funds,fund_name,'.$id,
                'total_amount' => 'required|numeric',
                'last_date' => 'required',
                'fund_for_year' => 'required',
            ]);
            if($request->sub_category_id == '3')
            {
                $this->validate($request,[
                    'institute_students' => 'required',
                ]);
            }

            $fund = Fund::find($id);

            $recordUpdated = $fund->update($request->only(['fund_category_id', 'sub_category_id', 'fund_name', 'total_amount', 'last_date', 'fund_for_year', 'institute_students']));
            if ($recordUpdated) {
                \Session::flash("edit-success",'The record has been updated!');
                return redirect()->route('admin.funds.index');
            } else {
                \Session::flash("edit-failed",'Could not update the record!');
                return redirect()->route('admin.funds.index');
            }
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $fund = Fund::find($id);
            $recordDeleted = $fund->delete();
            if ( ! $recordDeleted ) {
                \Session::flash('delete-failed', 'Could not delete the record');
                return redirect()->back();
            }
            \Session::flash('delete-success', 'The record has been deleted');
            return redirect()->back();
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
        }
    }
}

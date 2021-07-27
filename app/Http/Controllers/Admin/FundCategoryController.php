<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FundCategoryRequest;
use App\DataTables\FundCategoryDataTable;
use App\Helpers\ExceptionHelper;
use Illuminate\Validation\ValidationException;
use App\Models\FundCategory;

class FundCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FundCategoryDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.fund-categories.index');
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
        return view('admin.fund-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FundCategoryRequest $request)
    {
        try{
            $this->validate($request,[
                'type_of_fund' => 'required|unique:fund_categories',
                'description'  => 'required',
            ]);

            $fundCategory = FundCategory::create($request->only(['type_of_fund', 'description']));
            if ($fundCategory->wasRecentlyCreated) {
                \Session::flash('create-success', 'The record has been created!');
                return redirect()->route('admin.fund-categories.index');
            } else {
                \Session::flash('create-failed', 'Could not create the record!');
                return redirect()->route('admin.fund-categories.index');
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
            $fundCategory = FundCategory::find($id);
            return view('admin.fund-categories.show', [
                'fundCategory' => $fundCategory,
            ]);
        } catch (\Exception $e) {
            return ExceptionHelper::customError($e);
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
        try{
            $fundCategory = FundCategory::find($id);
            return view('admin.fund-categories.edit', [
                'fundCategory' => $fundCategory,
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
    public function update(FundCategoryRequest $request, $id)
    {
        try{
            $this->validate($request,[
                'type_of_fund' => 'unique:fund_categories,type_of_fund,'.$id
            ]);
            $fundCategory = FundCategory::find($id);

            $recordUpdated = $fundCategory->update($request->only(['type_of_fund', 'description']));
            if ($recordUpdated) {
                \Session::flash('edit-success', 'The record has been updated!');
                return redirect()->route('admin.fund-categories.index');
            } else {
                \Session::flash('edit-failed', 'Could not update the record!');
                return redirect()->route('admin.fund-categories.index');
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
            $fundCategory = FundCategory::find($id);
            $recordDeleted = $fundCategory->delete();
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

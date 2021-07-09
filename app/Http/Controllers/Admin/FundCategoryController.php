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
                'type_of_fund' => 'unique:fund_categories'
            ]);

            $fundCategory = FundCategory::create($request->only(['type_of_fund', 'description']));
            if ($fundCategory->wasRecentlyCreated) {
                return redirect()->route('admin.fund-categories.index')->with('create-success', 'The record has been created!');
            } else {
                return redirect()->route('admin.fund-categories.index')->with('create-failed', 'Could not create the record!');
            }
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
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
            return redirect()->route($this->indexRoute)->with('error', ExceptionHelper::somethingWentWrong($e));
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
                'type_of_fund' => 'unique:fund_categories,type_of_fund'.$id
            ]);
            $fundCategory = FundCategory::find($id);

            $recordUpdated = $fundCategory->update($request->only(['type_of_fund', 'description']));
            if ($recordUpdated) {
                return redirect()->route('admin.fund-categories.index')->with('edit-success', 'The record has been updated!');
            } else {
                return redirect()->route('admin.fund-categories.index')->with('edit-failed', 'Could not update the record!');
            }
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
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
                return redirect()->back()->with('delete-failed', 'Could not delete the record');
            }
            return redirect()->back()->with('delete-success', 'The record has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }
}

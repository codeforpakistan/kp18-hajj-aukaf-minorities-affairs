<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\DataTables\SubCategoryDataTable;
use App\Models\SubCategory;
use App\Models\FundCategory;
use Illuminate\Validation\ValidationException;
use App\Helpers\ExceptionHelper;

class SubCategoryController extends Controller
{
    protected $indexRoute = 'admin.sub-categories.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.sub-categories.index');
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
        try{
            $fundCategories = FundCategory::pluck('type_of_fund', 'id');
            return view('admin.sub-categories.create', [
                'fundCategories' => $fundCategories,
            ]);
        } catch (\Exception $e) {
            return redirect()->route($this->indexRoute)->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        try{
            $this->validate($request,[
                'type' => 'unique:sub_categories'
            ]);

            $subCategory = SubCategory::create($request->only(['fund_category_id', 'type', 'description', 'status']));
            if ($subCategory->wasRecentlyCreated) {
                return redirect()->route('admin.sub-categories.index')->with('create-success', 'The record has been created!');
            } else {
                return redirect()->route('admin.sub-categories.index')->with('create-failed', 'Could not create the record!');
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
            $subCategory = SubCategory::find($id);
            return view('admin.sub-categories.show', [
                'subCategory' => $subCategory,
            ]);
        } catch (\Exception $e) {
            return redirect()->route($this->indexRoute)->with('error', ExceptionHelper::somethingWentWrong($e));
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
            $subCategory = SubCategory::find($id);
            $fundCategories = FundCategory::pluck('type_of_fund', 'id');
            return view('admin.sub-categories.edit', [
                'subCategory' => $subCategory,
                'fundCategories' => $fundCategories,
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
    public function update(SubCategoryRequest $request, $id)
    {

        try{
            $this->validate($request,[
                'type' => 'unique:sub_categories'
            ]);
            
            $subCategory = SubCategory::find($id);

            $recordUpdated = $subCategory->update($request->only(['fund_category_id', 'type', 'description', 'status']));
            if ($recordUpdated) {
                return redirect()->route('admin.sub-categories.index')->with('edit-success', 'The record has been updated!');
            } else {
                return redirect()->route('admin.sub-categories.index')->with('edit-failed', 'Could not update the record!');
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
            $subCategory = SubCategory::find($id);
            $recordDeleted = $subCategory->delete();
            if ( ! $recordDeleted ) {
                return redirect()->back()->with('delete-failed', 'Could not delete the record');
            }
            return redirect()->back()->with('delete-success', 'The record has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }
}

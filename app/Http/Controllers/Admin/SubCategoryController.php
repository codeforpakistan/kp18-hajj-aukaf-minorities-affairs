<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\SubCategoryDataTable;
use Illuminate\Http\Request;
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
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->route($this->indexRoute);
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
                'type' => 'required|unique:sub_categories',
                'fund_category_id' => 'required',
                'description'      => 'required',
            ]);

            $subCategory = SubCategory::create($request->only(['fund_category_id', 'type', 'description', 'status']));
            if ($subCategory->wasRecentlyCreated) {
                \Session::flash('create-success', 'The record has been created!');
                return redirect()->route('admin.sub-categories.index');
            } else {
                \Session::flash('create-failed', 'Could not create the record!');
                return redirect()->route('admin.sub-categories.index');
            }
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Error $e) {
            return ExceptionHelper::customError($e)->withInput();
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
            $subCategory = SubCategory::find($id);
            return view('admin.sub-categories.show', [
                'subCategory' => $subCategory,
            ]);
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->route($this->indexRoute);
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
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
                'type' => 'required|unique:sub_categories,type,'.$id,
                'fund_category_id' => 'required',
                'description'      => 'required'
            ]);
            
            $subCategory = SubCategory::find($id);

            $recordUpdated = $subCategory->update($request->only(['fund_category_id', 'type', 'description', 'status']));
            if ($recordUpdated) {
                \Session::flash('edit-success', 'The record has been updated!');
                return redirect()->route('admin.sub-categories.index');
            } else {
                \Session::flash('edit-failed', 'Could not update the record!');
                return redirect()->route('admin.sub-categories.index');
            }
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
            $subCategory = SubCategory::find($id);
            $recordDeleted = $subCategory->delete();
            if ( ! $recordDeleted ) {
                \Session::flash('delete-failed', 'Could not delete the record');
                return redirect()->back();
            }
            \Session::flash('delete-success', 'The record has been deleted');
            return redirect()->back();
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
        }
    }
}

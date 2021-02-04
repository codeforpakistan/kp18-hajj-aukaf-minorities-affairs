<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Guest\HomeController@index')->name('guest.home.index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'role:Admin'])
->namespace('Admin')
->prefix('admin')
->name('admin.')
->group( function () {
	/**
	 * Dashboard routes
	 */
	Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
	Route::get('services', 'DashboardController@services')->name('dashboard.services');
	Route::get('funds-analysis', 'DashboardController@fundsAnalysis')->name('dashboard.funds-analysis');
	Route::get('district', 'DashboardController@district')->name('dashboard.district');
	Route::get('religion', 'DashboardController@religion')->name('dashboard.religion');
	Route::get('funds-list', 'DashboardController@fundsList')->name('dashboard.funds-list');
	Route::get('dashboard-map', 'DashboardController@dashboardMap')->name('dashboard.dashboard-map');

	/**
	 * Resource routes for the modules that have common structure
	 */
	Route::resource('applicants', 'ApplicantController');
	Route::resource('degree-awarding-boards', 'DegreeAwardingBoardController');
	Route::resource('disciplines', 'DisciplineController');
	Route::resource('districts', 'DistrictController');
	Route::resource('funds', 'FundController');
	Route::resource('institute-types', 'InstituteTypeController');
	Route::resource('institutes', 'InstituteController');
	Route::resource('marital-statuses', 'MaritalStatusController');
	Route::resource('qualification-levels', 'QualificationLevelController');
	Route::resource('religions', 'ReligionController');
	Route::resource('roles', 'RoleController');
	Route::resource('school-classes', 'SchoolClassController');
	Route::resource('sub-categories', 'SubCategoryController');
	Route::resource('users', 'UserController');
	Route::resource('fund-categories', 'FundCategoryController');
});
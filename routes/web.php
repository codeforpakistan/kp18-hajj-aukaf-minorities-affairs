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
Route::post('/', 'Guest\HomeController@submit')->name('guest.home.submit');
Route::post('/submit-application', 'Guest\HomeController@submitApplication')
    ->name('guest.home.submit-application')
    ->middleware(['auth', 'role:Admin|School|Operator']);
Route::get('/print', 'Guest\HomeController@print')->name('guest.home.print');

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

    /**
     * API Routes that are used to get data from DB through Ajax requests
     */
    Route::get('services', 'DashboardController@services')->name('dashboard.services');
    Route::get('funds-analysis', 'DashboardController@fundsAnalysis')->name('dashboard.funds-analysis');
    Route::get('district', 'DashboardController@district')->name('dashboard.district');
    Route::get('religion', 'DashboardController@religion')->name('dashboard.religion');
    Route::get('funds-list', 'DashboardController@fundsList')->name('dashboard.funds-list');
    Route::get('dashboard-map', 'DashboardController@dashboardMap')->name('dashboard.dashboard-map');
    Route::get('ajax/sub-categories', 'API\AjaxController@subCategories')->name('api.ajax.sub-categories');

    /**
     * Reports
     */
    Route::get('reports/general-report', 'ReportController@generalReport')->name('reports.general-report');
    Route::get('reports/institutes-report', 'ReportController@institutesReport')->name('reports.institutes-report');
    Route::get('reports/institutes-classes-report', 'ReportController@institutesClassesReport')->name('reports.institutes-classes-report');
    Route::get('reports/institutes-students-report', 'ReportController@institutesStudentsReport')->name('reports.institutes-students-report');
    Route::get('reports/region-religion-report', 'ReportController@regionReligionReport')->name('reports.region-religion-report');
    Route::get('reports/date-wise-summary', 'ReportController@dateWiseSummary')->name('reports.date-wise-summary');

    /**
     * Resource routes for the modules that have common structure
     */
    Route::resource('fund-categories', 'FundCategoryController');
    Route::resource('sub-categories', 'SubCategoryController');
    Route::resource('funds', 'FundController');
    Route::resource('applicants', 'ApplicantController');
    Route::resource('degree-awarding-boards', 'DegreeAwardingBoardController');
    Route::resource('disciplines', 'DisciplineController');
    Route::resource('districts', 'DistrictController');
    Route::resource('institute-types', 'InstituteTypeController');
    Route::resource('institutes', 'InstituteController');
    Route::resource('marital-statuses', 'MaritalStatusController');
    Route::resource('qualification-levels', 'QualificationLevelController');
    Route::resource('religions', 'ReligionController');
    Route::resource('roles', 'RoleController');
    Route::resource('school-classes', 'SchoolClassController');
    Route::resource('users', 'UserController');
});
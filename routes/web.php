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

$blockAccessPostAsGetRoutes = [
     // put urls here
     'password/email' => 'password/reset'
];

foreach ($blockAccessPostAsGetRoutes as $link => $to) {
     Route::get($link, function() use($link,$to){
          return redirect($to);
     });
}


Route::get('/', 'Guest\HomeController@index')->name('guest.home.index');
Route::get('qualification/disciplines', 'Guest\HomeController@getDisciplines');
Route::post('/', 'Guest\HomeController@submit')->name('guest.home.submit');
Route::post('/submit-application', 'Guest\HomeController@submitApplication')
    ->name('guest.home.submit-application');
    // ->middleware(['auth', 'role:Admin|School|Operator']);
Route::get('/print', 'Guest\HomeController@print')->name('guest.home.print');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth', 'role:Admin|Operator'])
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
    Route::get('reports/institutes-classes-report', 'ReportController@instituteClassesReport')->name('reports.institutes-classes-report');
    Route::get('reports/institutes-students-report', 'ReportController@institutesStudentsReport')->name('reports.institutes-students-report');
    Route::get('reports/region-religion-report', 'ReportController@regionReligionReport')->name('reports.region-religion-report');
    Route::get('reports/date-wise-summary', 'ReportController@dateWiseSummary')->name('reports.date-wise-summary');
    Route::get('fund/{fund_id}/get-institutes', 'FundController@institutes')->name('funds.institutes-by-fund');

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
    
    Route::get('applied-institutes/funds/{fund_id}', 'AppliedInstitutesController@funds')->name('applied-institutes.funds');
    
    Route::group(['prefix' => 'selection-phase'],function(){
        Route::get('/poverty-based', 'SelectionPhaseController@povertyBased')
             ->name('selection-phase.poverty-based');
        Route::post('/poverty-based/submit', 'SelectionPhaseController@submitSelection')
             ->name('selection-phase.poverty.submit');
        
        Route::get('balloting', 'SelectionPhaseController@balloting')
             ->name('selection-phase.balloting');
        Route::get('balloting/applicants', 'SelectionPhaseController@getApplicantsForBalloting')
             ->name('selection-phase.balloting.applicants');
        Route::post('balloting/submit', 'SelectionPhaseController@submitSelection')
             ->name('selection-phase.balloting.submit');

        Route::get('de-select/applicants','SelectionPhaseController@getApplicants')
             ->name('selection-phase.de-select.get.applicants');
        Route::get('de-select', 'SelectionPhaseController@deselect')
             ->name('selection-phase.de-select');
        Route::get('de-select/applicant', 'SelectionPhaseController@deselectApplicant')
             ->name('selection-phase.de-select.applicant');
        
        Route::get('distribution', 'SelectionPhaseController@distribution')
             ->name('selection-phase.distribution');
        Route::get('distribution/applicants', 'SelectionPhaseController@getApplicants')
             ->name('selection-phase.distribution.applicants');
         Route::post('distribution/submit', 'SelectionPhaseController@submitDistribution')
             ->name('selection-phase.distribution.submit');
    });
    
    Route::resource('marital-statuses', 'MaritalStatusController');
    Route::resource('qualification-levels', 'QualificationLevelController');
    Route::resource('religions', 'ReligionController');
    Route::resource('school-classes', 'SchoolClassController');
    Route::get('change-password', 'UserController@changePassword')->name('users.change.password');
    Route::put('change-password-submit', 'UserController@changePasswordSubmit')->name('users.change.password.submit');
});

Route::middleware(['auth', 'role:Admin'])
->namespace('Admin')
->prefix('admin')
->name('admin.')
->group( function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
});
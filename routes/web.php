<?php
use App\Programme;
use App\CenterFaculty;
use App\Company;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', 'ProgrammeController@func');

/**
 * Route for CBIEV Staff with prefix 'staff'
 * Add route tied to staff prefix into this route group
 */
Route::prefix('staff')->group(function(){

    /**
     * Route for staff dashboard/home  
     */
    Route::get('/', 'CBIEVStaffController@showStaffHome')->name('staff.home');
    Route::get('/home', 'CBIEVStaffController@showStaffHome')->name('staff.home.2');
    Route::get('/home2', 'HomeController@index2')->name('staff.home.2');

    /**
     * Route for staff login 
     */
    Route::get('/login', 'Auth\CBIEVStaff\LoginController@showLoginForm')->name('staff.login');
    Route::post('/login', 'Auth\CBIEVStaff\LoginController@login')->name('staff.login.submit');

    /**
     * Route for staff logout
     */
    Route::get('/logout', 'Auth\CBIEVStaff\LoginController@logout')->name('staff.logout');

    /**
     * Route for staff request reset password 
     */
    Route::post('password/email','Auth\CBIEVStaff\ForgotPasswordController@sendResetLinkEmail')->name('staff.password.email');
    Route::get('password/email','Auth\CBIEVStaff\ForgotPasswordController@showLinkRequestForm')->name('staff.password.request');

    /**
     * Route for staff reset password 
     */
    Route::post('password/reset','Auth\CBIEVStaff\ResetPasswordController@reset')->name('staff.password.update');
    Route::get('password/reset/{token}','Auth\CBIEVStaff\ResetPasswordController@showResetForm')->name('staff.password.reset');

    Route::prefix('registration')->group(function(){
        Route::prefix('project')->group(function(){
            Route::get('/', 'Registration\StaffProjectRegistrationController@showProjectRegistrationList')->name('project.registration.list');
            Route::get('{id}', 'Registration\StaffProjectRegistrationController@showProjectRegistrationDetail')->name('project.registration.detail');
            Route::post('start/approval/{id}/{stage}','ProjectRegistrationStatusTrackingController@startApprovalProcess')->name('project.regisration.approval.start');
        });
        Route::prefix('mentor')->group(function(){
            Route::get('/', 'Registration\StaffProjectRegistrationController@showProjectRegistrationList')->name('project.registration.list');
            Route::get('{id}', 'Registration\StaffProjectRegistrationController@showProjectRegistrationDetail')->name('project.registration.detail');
            Route::post('start/approval/{id}/{stage}','ProjectRegistrationStatusTrackingController@startApprovalProcess')->name('project.regisration.approval.start');
        });
    });
});

Route::prefix('registration')->group(function(){
    Route::prefix('isparkproject')->group(function(){
        Route::get('', 'ProjectRegistrationController@showRegistrationPage')->name('project.registration.show');
        Route::post('', 'ProjectRegistrationController@submitRegistration')->name('project.registration.submit');

        Route::get('login', 'Auth\ProjectRegistration\LoginController@showLoginForm')->name('project.registration.login');
        Route::post('login', 'Auth\ProjectRegistration\LoginController@login')->name('project.registration.login.submit');
        Route::get('logout', 'Auth\ProjectRegistration\LoginController@logout')->name('pr.temp.logout');
        Route::get('home', 'PRTempAccountController@home')->name('pr.temp.home');
        Route::post('home', 'PRTempAccountController@update')->name('pr.temp.registration.update');
        Route::get('updateComplete', 'PRTempAccountController@updateComplete')->name('pr.temp.update.complete');

    });

    Route::prefix('isparkmentor')->group(function(){
        Route::get('', 'MentorRegistrationController@showRegistrationForm')->name('mentor.registration.show');
        Route::post('', 'MentorRegistrationController@saveRegistration')->name('mentor.registration.submit');
    });
    Route::prefix('isparkinvestor')->group(function(){
        Route::get('', 'InvestorRegistrationController@showRegistrationForm')->name('investor.registration.show');
        Route::post('', 'InvestorRegistrationController@saveRegistration')->name('investor.registration.submit');
    });
});

/**
 * Route for iSpark project with prefix 'project'
 * Add route tied to staff prefix into this route group
 */
Route::prefix('get')->group(function(){
        Route::get('/programmes', function(){
            return Programme::all()->pluck('programme_name');
        })->name('get.programme');
        Route::get('/department', function(){
            return CenterFaculty::all()->pluck('name');
        })->name('get.department');
        Route::get('/departmentcode', function(){
            return CenterFaculty::all()->pluck('code');
        })->name('get.department.code');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tomail', 'ProjectRegistrationStatusTrackingController@mailTo');
Route::get('/mentor', function(){
    return view('form.registration.mentor.mentor_registration_form');
});
Route::get('/investor', function(){
    return view('form.registration.investor.investor_registration_form');
});
Route::get('/test', function(){
    $centerFaculty = CenterFaculty::all()-> only('id', 'name', 'code');

    foreach ($centerFaculty as $name => $id) {
        echo $name . ' has id ' . $id . "\r\n";
        echo "<br>";
    }
    return dd($centerFaculty);
});
Route::get('/test2', function(){
    return view('form.registration.investor.investor_registration_form');
});

Route::get('/project/rec/{type}/{recID}','RecommendationController@projectRecommendation')->name('project.recommendation.get');
Route::post('/project/rec/post','RecommendationController@saveRecommendation')->name('project.recommendation.post');

Route::get('/project/rec/manager/{type}/{recID}','RecommendationController@projectRecommendation')->name('project.recommendation.manager.get');
Route::post('/project/rec/manager/post','RecommendationController@saveRecommendation')->name('project.recommendation.manager.post');

Route::get('/project/app/director/{recID}','PRDirectorApprovalController@showApprovalForm')->name('project.approval.get');
Route::post('/project/app/director/post','PRDirectorApprovalController@saveApproval')->name('project.approval.post');
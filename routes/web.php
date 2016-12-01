<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::group(['middleware' => ['web']], function ()
{
    Route::get('/',[ 'as'=> 'home', function () {
        return view('login');
    }]);

    Route::get('/login', [ 'as'=> 'login', function () {
        return view('login');
    }]);

    Route::get('/signup', function (){
        return view('signup');
    })->name('signup');

    Route::post('/signInSubmit', [
        'uses' => 'UserController@userSignIn',
        'as' => 'signInSubmit'
    ]);

    Route::post('/signUpSubmit', [
       'uses' => 'UserController@userSignup',
        'as' => 'signUpSubmit'
    ]);

    Route::get('/dashboard', [
        'uses' => 'CompanyController@getDashboard',
        'as' => 'dashboard',
        'middleware' => 'auth'
    ]);

    Route::get('/logout', [
        'uses' => 'UserController@logout',
        'as' => 'logout'
    ]);

    //Company Controllers

    Route::get('/company', [
        'uses' => 'CompanyController@getCompanyView',
        'as' => 'companyView',
        'middleware' => 'auth'
    ]);

    Route::post('/create_company/{current_page}', [
        'uses' => 'CompanyController@postCreateCompany',
        'as' => 'create.company',
        'middleware' => 'auth'
    ]);

    Route::post('/edit_company', [
        'uses' => 'CompanyController@postEditCompany',
        'as' => 'edit.company',
        'middleware' => 'auth'
    ]);

    Route::get('/delete_company/{company_id}/{current_page}', [
        'uses' => 'CompanyController@getDeleteCompany',
        'as' => 'delete.company',
        'middleware' => 'auth'
    ]);

    //Inventory Controllers

    Route::resource('/inventory', 'InventoryController');


});


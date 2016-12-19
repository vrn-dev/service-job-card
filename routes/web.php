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

    //Route::resource('/inventory', 'InventoryController');
    Route::get('/inventory', [
        'uses' => 'InventoryController@getIndex',
        'as' => 'inventory.index',
        'middleware' => 'auth'
    ]);

    Route::post('inventory/create', [
        'uses' => 'InventoryController@postCreateInventory',
        'as' => 'inventory.store',
        'middleware' => 'auth'
    ]);

    Route::get('/inventory_delete/{inventory_id}', [
        'uses' => 'InventoryController@getInventoryDelete',
        'as' => 'inventory.delete',
        'middleware' => 'auth'
    ]);

    //Ticket Routes
    Route::get('/ticket', [
        'uses' => 'TicketController@getIndex',
        'as' => 'ticket.index',
        'middleware' => 'auth'
    ]);

    Route::get('/ticket_autocomplete', [
        'uses' => 'TicketController@getAutocomplete',
        'as' => 'ticket.autocomplete',
        'middleware' => 'auth'
    ]);

    Route::post('/ticket_json', [
        'uses' => 'TicketController@sendJson',
        'as' => 'ticket.sendJson',
        'middleware' => 'auth'
    ]);

    Route::get('/ticket_getTicketId', [
        'uses' => 'TicketController@ticketIdGen',
        'as' => 'ticket.getTicketId',
        'middleware' => 'auth'
    ]);

    Route::get('/ticket_popTable', [
        'uses' => 'TicketController@popTable',
        'as' => 'ticket.popTable',
        'middleware' => 'auth'
    ]);

    Route::post('/ticket_create', [
        'uses' => 'TicketController@postCreateTicket',
        'as' => 'ticket.create',
        'middleware' => 'auth'
    ]);

    /*Route::post('/ticket/peekmodal', [
        'uses' => 'TicketController@postPeekModal',
        'as' => 'ticket.postPeekModal',
        'middleware' => 'auth'
    ]);*/

    Route::get('/ticket/peekmodal', [
        'uses' => 'TicketController@getPeekModal',
        'as' => 'ticket.getPeekModal',
        'middleware' => 'auth'
    ]);

    Route::get('/ticket/delete', [
        'uses' => 'TicketController@getDeleteTicket',
        'as' => 'ticket.getDeleteTicket',
        'middleware' => 'auth'
    ]);

    //SJC Routes

    Route::get('/sjc/create_form/{ticketId?}', [
        'uses' => 'SjcController@getSjcCreateForm',
        'as' => 'sjc.createForm',
        'middleware' => 'auth'
    ]);

    Route::get('/sjc', [
        'uses' => 'SjcController@getSjcIndex',
        'as' => 'sjc.index',
        'middleware' => 'auth'
    ]);

    Route::post('/sjc/create_sjc', [
        'uses' => 'SjcController@postCreateSjc',
        'as' => 'sjc.createSjc',
        'middleware' => 'auth'
    ]);

    Route::get('/sjc/pop_table', [
        'uses' => 'SjcController@popTable',
        'as' => 'sjc.popTable',
        'middleware' => 'auth'
    ]);

    Route::get('/sjc/job_card', [
        'uses' => 'SjcController@getJobCardIndex',
        'as' => 'sjc.jobCard.index',
        'middleware' => 'auth'
    ]);

    Route::post('/sjc/update_sjc', [
        'uses' => 'SjcController@postSjcUpdate',
        'as' => 'sjc.update',
        'middleware' => 'auth'
    ]);

    Route::get('/sjc/delete', [
        'uses' => 'SjcController@getSjcDelete',
        'as' => 'sjc.delete',
        'middleware' => 'auth'
    ]);

    Route::get('/sjc/fill/{ticketId?}', [
        'uses' => 'SjcController@getFillSjc',
        'as' => 'sjc.fill',
        'middleware' => 'auth'
    ]);

    //Send filled Job Card to Customer, Accounts, Manager
    Route::post('/sjc/fill/send_email', [
        'uses' => 'SjcController@postSendEmail',
        'as' => 'sjc.email',
        'middleware' => 'auth'
    ]);

    //pdf
    Route::get('/sjc/pdf_download/{ticketId?}', [
        'uses' => 'SjcController@getPdfDownload',
        'as' => 'pdf.download',
        'middleware' => 'auth'
    ]);

    //test link
    Route::get('/sjc/test_link', [
        'uses' => 'SjcController@testLink',
        'as' => 'test.link',
        'middleware' => 'auth'
    ]);

});


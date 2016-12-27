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
       'uses' => 'UserController@userSignUp',
        'as' => 'signUpSubmit'
    ]);

    Route::get('/logout', [
        'uses' => 'UserController@logout',
        'as' => 'logout'
    ]);

    Route::group(['middleware' => 'auth'], function (){

        Route::group(['middleware' => 'admin'], function (){

            Route::get('delete', [
                'uses' => 'CompanyController@getDeleteCompany',
                'as' => 'company.delete',
                'prefix' => 'company'
            ]);

            Route::get('delete', [
                'uses' => 'InventoryController@getInventoryDelete',
                'as' => 'inventory.delete',
                'prefix' => 'inventory'
            ]);

            Route::get('delete', [
                'uses' => 'TicketController@getDeleteTicket',
                'as' => 'ticket.delete',
                'prefix' => 'ticket'
            ]);

            //Assign ticket to FAE
            Route::get('create_form', [
                'uses' => 'SjcController@getSjcCreateForm',
                'as' => 'sjc.createForm',
                'prefix' => 'sjc'
            ]);

            //Submit assigned ticket as SJC and update sjc DB
            Route::post('create', [
                'uses' => 'SjcController@postCreateSjc',
                'as' => 'sjc.createSjc',
                'prefix' => 'sjc'
            ]);

            Route::post('update', [
                'uses' => 'SjcController@postSjcUpdate',
                'as' => 'sjc.update',
                'prefix' => 'sjc'
            ]);

            Route::get('delete', [
                'uses' => 'SjcController@getSjcDelete',
                'as' => 'sjc.delete',
                'prefix' => 'sjc'
            ]);

            Route::group(['prefix' => 'admin'], function (){
                Route::get('index',[
                    'uses' => 'AdminController@getIndex',
                    'as' => 'admin.index'
                ]);

                Route::get('popUserTable',[
                    'uses' => 'AdminController@popUserTable',
                    'as' => 'admin.popUserTable'
                ]);

                Route::post('create',[
                    'uses' => 'AdminController@postCreateUser',
                    'as' => 'admin.create'
                ]);

                Route::post('password_reset',[
                    'uses' => 'AdminController@postUserPasswordReset',
                    'as' => 'admin.adminPasswordReset'
                ]);

                Route::post('delete',[
                    'uses' => 'AdminController@postDeleteUser',
                    'as' => 'admin.delete'
                ]);

                Route::post('reset_password',[
                    'uses' => 'AdminController@postAdminResetPassword',
                    'as' => 'admin.resetUserPassword'
                ]);
            });

        });

        Route::get('dashboard', [
            'uses' => 'CompanyController@getDashboard',
            'as' => 'dashboard',
            'prefix' => 'sjc'
        ]);

        //Company Controllers

        Route::group(['prefix' => 'company'], function(){
            Route::get('index', [
                'uses' => 'CompanyController@getIndex',
                'as' => 'company.index',
            ]);

            Route::post('create', [
                'uses' => 'CompanyController@postCreateCompany',
                'as' => 'company.create',
            ]);

            Route::post('edit', [
                'uses' => 'CompanyController@postEditCompany',
                'as' => 'company.edit',
            ]);

            Route::get('popTable', [
                'uses' => 'CompanyController@popTable',
                'as' => 'company.popTable',
            ]);
        });


        //Inventory Controllers

        Route::group(['prefix' => 'inventory'], function (){
            Route::get('index', [
                'uses' => 'InventoryController@getIndex',
                'as' => 'inventory.index',
            ]);

            Route::post('create', [
                'uses' => 'InventoryController@postCreateInventory',
                'as' => 'inventory.create',
            ]);

            Route::get('popTable', [
                'uses' => 'InventoryController@popTable',
                'as' => 'inventory.popTable',
            ]);

            Route::get('popCompanySelect',[
                'uses' => 'InventoryController@popCompanySelect',
                'as' => 'inventory.popCompanySelect'
            ]);
        });

        //Ticket Routes

        Route::group(['prefix' => 'ticket'], function (){
            Route::get('index', [
                'uses' => 'TicketController@getIndex',
                'as' => 'ticket.index',
            ]);

            Route::post('popAsset', [
                'uses' => 'TicketController@popAsset',
                'as' => 'ticket.popAsset',
            ]);

            Route::get('popTicketId', [
                'uses' => 'TicketController@popTicketId',
                'as' => 'ticket.popTicketId',
            ]);

            Route::get('popTable', [
                'uses' => 'TicketController@popTable',
                'as' => 'ticket.popTable',
            ]);

            Route::post('create', [
                'uses' => 'TicketController@postCreateTicket',
                'as' => 'ticket.create',
            ]);

            Route::get('popPeekModal', [
                'uses' => 'TicketController@getPeekModal',
                'as' => 'ticket.popPeekModal',
            ]);
        });

        //SJC Routes
        Route::group(['prefix' => 'sjc'], function (){
            Route::get('index', [
                'uses' => 'SjcController@getSjcIndex',
                'as' => 'sjc.index'
            ]);

            Route::get('pop_table', [
                'uses' => 'SjcController@popTable',
                'as' => 'sjc.popTable',
            ]);

            Route::get('job_card', [
                'uses' => 'SjcController@getJobCardIndex',
                'as' => 'sjc.jobCard.index',
            ]);

            Route::get('fill', [
                'uses' => 'SjcController@getFillSjc',
                'as' => 'sjc.fill',
            ]);

            //Send filled Job Card to Customer, Accounts, Manager
            Route::post('fill/send_email', [
                'uses' => 'SjcController@postSendEmail',
                'as' => 'sjc.email',
            ]);

            //pdf
            Route::get('pdf_download', [
                'uses' => 'SjcController@getPdfDownload',
                'as' => 'pdf.download',
            ]);
        });

        //User Account
        Route::get('user_account', [
            'uses' => 'AdminController@getUserAccountIndex',
            'as' => 'admin.userIndex',
            'prefix' => 'admin'
        ]);

        Route::post('user_changePassword', [
            'uses' => 'AdminController@postUserChangePassword',
            'as' => 'admin.userChangePassword',
            'prefix' => 'admin'
        ]);

        Route::post('user_changeEmail', [
            'uses' => 'AdminController@postUserChangeEmail',
            'as' => 'admin.userChangeEmail',
            'prefix' => 'admin'
        ]);


        //test link
        Route::get('/sjc/test_link', [
            'uses' => 'SjcController@testLink',
            'as' => 'test.link',
        ]);
    });
});


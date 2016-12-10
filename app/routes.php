<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('auth.login');
});

// route to show the login form
Route::get('auth/login', array('before' => 'guest','uses' => 'AuthController@showLogin'));

// route to process the login form
Route::post('auth/login', array('before' => 'csrf','uses' => 'AuthController@doLogin'));

// route to logout
Route::get('auth/logout', array('uses' => 'AuthController@doLogout'));

// route to show the register form
Route::get('auth/register', array('before' => 'guest','uses' => 'AuthController@showRegister'));

// route to process the register form
Route::post('auth/register', array('before' => 'csrf','uses' => 'AuthController@doRegister'));

// route to show confirmation of register
Route::get('auth/thanks', array('before' => 'guest','uses' => 'AuthController@showThanks'));


Route::group(['prefix' => 'api/v1', 'before'=>'auth'],function()
{

	Route::group(['prefix' => 'admin', 'before'=> 'admin'],function(){


		Route::get('/',function()
		{
			return View::make('admin/admin');
		});

		Route::get('appointments',function()
		{
			return View::make('admin/appointments');
		});

		Route::get('forms/neweventform',function()
		{
			return View::make('admin/forms/neweventform');
		});

		Route::get('forms/eventform',function()
		{
			return View::make('admin/forms/eventform');
		});

		Route::get('users',function()
		{
			return View::make('admin/users');
		});

		Route::get('dashboard',function()
		{
			return View::make('admin/dashboard');
		});

        Route::get('myappointments',function()
        {
            return View::make('admin/myappointments');
        });

		Route::get('charts',function()
		{
			return View::make('admin/chart');
		});

	});

	Route::get('barber',array('before' => 'barber', function ()
	{
		return View::make('barber/barber');
	}));

	Route::get('intern',array('before' => 'intern', function ()
	{
		return View::make('intern/intern');
	}));


	Route::group(['prefix' => 'client', 'before'=> 'client'],function(){

		Route::get('/',function()
		{
			return View::make('client/client');
		});

		Route::get('dashboard',function()
		{
			return View::make('client/dashboard');
		});

		Route::get('forms/clientform.php',function()
		{
			return View::make('client/forms/clientform');
		});

		Route::get('forms/clienteditform.php',function()
		{
			return View::make('client/forms/clienteditform');
		});

		Route::get('appointments','ClientsController@index');
		Route::post('appointments','ClientsController@store');
		Route::get('appointments/{id}','ClientsController@show');
		Route::post('appointments/{id}','ClientsController@update');
		Route::delete('appointments/{id}','ClientsController@destroy');


	});

	Route::resource('users','UsersController');

	Route::resource('appointments', 'AppointmentsController');

	Route::post('users/{id}', 'UsersController@update');

	Route::post('appointments/{id}', 'AppointmentsController@update');

	Route::get('clients', 'UsersController@getClients');

	Route::get('barbers', 'UsersController@index');

	Route::get('user', 'AuthController@getLoggedInUser');

	Route::get('times/{timeslot?}/{date}','AppointmentsController@getTimes');

	Route::get('users/{id}/appointments','AppointmentsController@index');

});

///**
// * Admin Routes
// */
//
//
//Route::get('auth/login');
//Route::get('auth/logout');
//Route::get('admin/dashboard');
//
///**
// * Admin Barbers
// */
//
//Route::get('admin/barbers/create');
//Route::get('admin/barbers');
//Route::post('admin/barbers');
//Route::get('admin/barbers/{barber}');
//Route::get('admin/barbers/{barber}/edit');
//Route::put('admin/barbers/{barber}');
//Route::delete('admin/barbers/{barber}');
//
///**
// * Admin Appointments
// */
//
//Route::get('admin/appointments/create');
//Route::get('admin/appointments');
//Route::post('admin/appointments');
//Route::get('admin/appointments/{appointment}');
//Route::get('admin/appointments/{appointment}/edit');
//Route::put('admin/appointments/{appointment}');
//Route::delete('admin/appointments/{appointment}');
//
//
///**
// * Barber Routes
// */
//
//Route::get('auth/login');
//Route::get('auth/logout');
//Route::get('barber/dashboard');
//Route::get('barber/appointments/create');
//Route::get('barber/appointments');
//Route::post('barber/appointments');
//Route::get('barber/appointments/{appointment}');
//Route::get('barber/appointments/{appointment}/edit');
//Route::put('barber/appointments/{appointment}');
//Route::delete('barber/appointments/{appointment}');
//
///**
// * Intern Routes
// */
//
//Route::get('auth/login');
//Route::get('auth/logout');
//Route::get('intern/dashboard');
//Route::get('intern/appointments');
//
//
///**
// * User (Client) Routes
// */
//
//Route::get('auth/login');
//Route::get('auth/register');
//Route::get('auth/logout');
//Route::get('user/dashboard');
//Route::get('user/appointments/create');
//Route::get('user/appointments');
//Route::post('user/appointments');
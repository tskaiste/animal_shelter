<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::get('shelters', 'ShelterController@index');
Route::post('clients', 'ClientController@store');

Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdmin');
    Route::delete('users/{id}', 'UserController@delete')->middleware('isAdmin');
    Route::post('register', 'AuthController@register')->middleware('isAdmin');
    // Shelters
    Route::get('shelters/{id}', 'ShelterController@show')->middleware('isAdmin');
    Route::post('shelters', 'ShelterController@store')->middleware('isAdmin');
    Route::put('shelters/{id}', 'ShelterController@update')->middleware('isAdmin');
    Route::delete('shelters/{id}', 'ShelterController@delete')->middleware('isAdmin');
    // Employees
    Route::get('employees', 'EmployeeController@index');
    Route::get('employees/{id}', 'EmployeeController@show')->middleware('isAdmin');
    Route::post('employees', 'EmployeeController@store')->middleware('isAdmin');
    Route::put('employees/{id}', 'EmployeeController@update')->middleware('isAdmin');
    Route::delete('employees/{id}', 'EmployeeController@delete')->middleware('isAdmin');
    // Animals
    Route::get('animals', 'AnimalController@index');
    Route::get('animals/{id}', 'AnimalController@show');
    Route::post('animals', 'AnimalController@store');
    Route::put('animals/{id}', 'AnimalController@update');
    Route::delete('animals/{id}', 'AnimalController@delete');
    // Bills
    Route::get('bills', 'BillController@index');
    Route::get('bills/{id}', 'BillController@show');
    Route::post('bills', 'BillController@store');
    Route::put('bills/{id}', 'BillController@update');
    Route::delete('bills/{id}', 'BillController@delete');
    // Cages
    Route::get('cages', 'CageController@index');
    Route::get('cages/{id}', 'CageController@show');
    Route::post('cages', 'CageController@store');
    Route::put('cages/{id}', 'CageController@update');
    Route::delete('cages/{id}', 'CageController@delete');
    // Clients
    Route::get('clients', 'ClientController@index');
    Route::get('clients/{id}', 'ClientController@show');
    Route::put('clients/{id}', 'ClientController@update');
    Route::delete('clients/{id}', 'ClientController@delete');
    // Donations
    Route::get('donations', 'DonationController@index');
    Route::get('donations/{id}', 'DonationController@show');
    Route::post('donations', 'DonationController@store');
    Route::put('donations/{id}', 'DonationController@update');
    Route::delete('donations/{id}', 'DonationController@delete');
    // Resources
    Route::get('resources', 'ResourceController@index');
    Route::get('resources/{id}', 'ResourceController@show');
    Route::post('resources', 'ResourceController@store');
    Route::put('resources/{id}', 'ResourceController@update');
    Route::delete('resources/{id}', 'ResourceController@delete');
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/employees', 'App\Http\Controllers\EmployeeController@index');
Route::prefix('/employees')->group(function () {
    Route::post('/store', 'App\Http\Controllers\EmployeeController@newEntry');
    Route::put('/update/{id}', 'App\Http\Controllers\EmployeeController@update');
    Route::delete('/delete/{id}', 'App\Http\Controllers\EmployeeController@destroy');
});

// Route::post('/newEntry', [EmployeeController::class, 'newEntry']);

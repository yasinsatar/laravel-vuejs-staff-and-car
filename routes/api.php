<?php

use App\Http\Controllers\Api\StaffCarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['namespace' => 'api'], function () {
    Route::get('getStaffCar',[StaffCarController::class,'index'])->name('api.getStaffCar');
    Route::delete('/delete/{id}',[StaffCarController::class,'destroy'])->name('api.deleteStaffCar');

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

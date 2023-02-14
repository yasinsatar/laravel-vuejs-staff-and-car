<?php

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\StaffCarController;
use App\Http\Controllers\Api\StaffController;
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
    // StaffCar
    Route::get('staffCar/all',[StaffCarController::class,'index'])->name('api.staffCar.all');
    Route::post('staffCar/create',[StaffCarController::class,'store'])->name('api.staffCar.create');
    Route::get('staffCar/show/{id}',[StaffCarController::class,'show'])->name('api.staffCar.show');
    Route::get('staffCar/edit/{id}',[StaffCarController::class,'edit'])->name('api.staffCar.edit');
    Route::put('staffCar/update/{id}',[StaffCarController::class,'update'])->name('api.staffCar.update');
    Route::delete('staffCar/delete/{id}',[StaffCarController::class,'destroy'])->name('api.staffCar.delete');

    // Staff
    Route::get('staff/all',[StaffController::class,'index'])->name('api.staff.all');

    // Car
    Route::get('car/all',[CarController::class,'index'])->name('api.car.all');

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

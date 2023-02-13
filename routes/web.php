<?php

use App\Http\Controllers\Pages\StaffCarController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [StaffCarController::class, 'index'])->name('pages.staffCar.index');
Route::get('/create', [StaffCarController::class, 'create'])->name('pages.staffCar.create');
Route::get('/update/{id}', [StaffCarController::class, 'update'])->name('pages.staffCar.update');
Route::get('/detail/{id}', [StaffCarController::class, 'detail'])->name('pages.staffCar.detail');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

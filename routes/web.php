<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\InfoController;

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

Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/reserve', [ReserveController::class, 'index'])->name('reserve.index');
Route::get('/reserve/first_search', [ReserveController::class, 'first_search'])->name('reserve.first_search');
Route::get('/reserve/second_search/{aircraft_id}', [ReserveController::class, 'second_search'])->name('reserve.second_search');
Route::get('/reserve/confirm', [ReserveController::class, 'confirm'])->name('reserve.confirm');
Route::post('/reserve/create', [ReserveController::class, 'create'])->name('reserve.create');
Route::get('/reserve/show', [ReserveController::class, 'show'])->name('reserve.show');
Route::get('/information/{info_id}', [InfoController::class, 'show'])->name('info.show');
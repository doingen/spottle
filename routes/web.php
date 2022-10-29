<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;

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
Route::get('/reserve', [ReserveController::class, 'index'])->middleware(['verified'])->name('reserve.index');
Route::get('/reserve/first_search', [ReserveController::class, 'first_search'])->name('reserve.first_search');
Route::get('/reserve/second_search/{aircraft_id}', [ReserveController::class, 'second_search'])->name('reserve.second_search');
Route::get('/reserve/confirm', [ReserveController::class, 'confirm'])->name('reserve.confirm');
Route::post('/reserve/create', [ReserveController::class, 'create'])->name('reserve.create');
Route::get('/reserve/show', [ReserveController::class, 'show'])->name('reserve.show');
Route::get('/information/{info_id}', [InfoController::class, 'show'])->name('info.show');
Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register/confirm', [RegisterController::class, 'confirm'])->name('register.confirm');
Route::post('/register', [RegisterController::class, 'create'])->name('register.create');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
->middleware('auth')
                ->middleware('throttle:6,1')
                ->name('verification.send');
Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
->middleware('auth')
                ->name('verification.notice');

Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
->middleware('auth')
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

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

Route::get('/information/{info_id}', [InfoController::class, 'show'])->name('info.show');

Route::middleware('guest')->group(function (){
  Route::get('/register', [RegisterController::class, 'show'])->name('register.show');

  Route::post('/register/confirm', [RegisterController::class, 'confirm'])->name('register.confirm');

  Route::post('/register', [RegisterController::class, 'create'])->name('register.create');

  Route::get('/login', [LoginController::class, 'show'])->name('login.show');

  Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function (){
  Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

  Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

  Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('reserve')->middleware(['auth', 'verified'])->group(function() {
  Route::get('/', [ReserveController::class, 'index'])->name('reserve.index');

  Route::get('first_search', [ReserveController::class, 'first_search'])->name('reserve.first_search');

  Route::get('second_search/{aircraft_id}', [ReserveController::class, 'second_search'])->name('reserve.second_search');

  Route::get('confirm', [ReserveController::class, 'confirm'])->name('reserve.confirm');

  Route::post('create', [ReserveController::class, 'create'])->name('reserve.create');
  
  Route::get('show', [ReserveController::class, 'show'])->name('reserve.show');

  Route::get('update', [ReserveController::class, 'updateConfirm'])->name('reserve.update_confirm');

  Route::post('update', [ReserveController::class, 'update'])->name('reserve.update');
  
  Route::get('delete', [ReserveController::class, 'deleteConfirm'])->name('reserve.delete');

  Route::post('delete', [ReserveController::class, 'delete']);
});

Route::middleware(['auth', 'verified'])->group(function() {
  Route::get('mypage', [MypageController::class, 'index'])->name('mypage.index');

  Route::get('review', [ReviewController::class, 'show'])->name('review.show');

  Route::post('review', [ReviewController::class, 'create'])->name('review.create');
});

Route::prefix('admin')->name('admin.')->group(function(){
    require __DIR__.'/admin.php';
});

Route::prefix('airport_admin')->name('airport_admin.')->group(function(){
    require __DIR__.'/airport_admin.php';
});
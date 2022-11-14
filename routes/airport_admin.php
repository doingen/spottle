<?php

use App\Http\Controllers\Airport_admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Airport_admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Airport_admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Airport_admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Airport_admin\Auth\NewPasswordController;
use App\Http\Controllers\Airport_admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Airport_admin\Auth\RegisteredUserController;
use App\Http\Controllers\Airport_admin\Auth\VerifyEmailController;

use App\Http\Controllers\Airport_admin\AirportAdminController;
use App\Http\Controllers\Airport_admin\AddAircraftController;
use App\Http\Controllers\Airport_admin\AddSpotController;
use App\Http\Controllers\Airport_admin\AddInfoController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:airport_admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::get('/', [AirportAdminController::class, 'index'])
                ->name('index');

Route::get('add_aircraft', [AddAircraftController::class, 'index'])
                ->name('add_aircraft');

Route::post('add_aircraft', [AddAircraftController::class, 'create']);

Route::get('change_aircraft', [AddAircraftController::class, 'show'])
                ->name('change_aircraft');

Route::post('change_aircraft', [AddAircraftController::class, 'update']);

Route::get('add_spot', [AddSpotController::class, 'index'])
                ->name('add_spot');

Route::post('add_spot', [AddSpotController::class, 'create']);

Route::post('change_spot', [AddSpotController::class, 'update'])
                ->name('change_spot');

Route::get('add_info', [AddInfoController::class, 'index'])
                ->name('add_info');

Route::post('add_info', [AddInfoController::class, 'create']);

Route::get('change_info', [AddInfoController::class, 'show'])
                ->name('change_info');

Route::post('change_info', [AddInfoController::class, 'update']);

Route::middleware('auth:airport_admin')->group(function () {
    

    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

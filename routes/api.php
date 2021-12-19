<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Models\User;

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


Route::group(['prefix' => 'user'], function() {
    Route::post('regisration', [RegistrationController::class, 'registerUser']);
    Route::post('verify_otp', [RegistrationController::class, 'otpVerify']);
    Route::post('login', [AuthController::class, 'login']);
});



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('/fcm-update', [ProfileController::class, 'updateFCM']);
});

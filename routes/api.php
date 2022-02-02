<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Models\User;
use App\Http\Controllers\AgentsController;

use App\Http\Controllers\Master\PackagesController;
use App\Http\Controllers\Master\PackagesPointsController;

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


Route::get('/view-all-packages', [PackagesController::class, 'apiViewAllPackages']);
Route::get('/view-all-package-points', [PackagesPointsController::class, 'apiViewAllPackagePoints']);

Route::group(['prefix' => 'user'], function() {
    Route::post('registration', [RegistrationController::class, 'registerUser']);
    Route::post('verify_otp', [RegistrationController::class, 'otpVerify']);
    Route::post('login', [AuthController::class, 'login']);
});



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });


    Route::post('/add-vendor', [AgentsController::class, 'addVendor']);
    Route::post('/add-consumer', [AgentsController::class, 'addConsumer']);

    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('/fcm-update', [ProfileController::class, 'updateFCM']);
    Route::get('/dashboard-agent', [AgentsController::class, 'agentDashboard']);

    Route::group(['prefix' => 'agent'], function() {
        Route::group(['prefix' => 'search'], function() {
            Route::get('/user', [AgentsController::class, 'search_vendor']);
        });
    });
});

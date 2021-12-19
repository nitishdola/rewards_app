<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

//Route::post('/register', [RegistrationController::class, 'registerAdminUser'])->name('admin_user.registration');

Route::group(['auth:sanctum', 'verified'], function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

    Route::group(['prefix' => 'master'], function() {
        Route::post('regisration', [RegistrationController::class, 'registerUser']);
        Route::post('verify_otp', [RegistrationController::class, 'otpVerify']);
        Route::post('login', [AuthController::class, 'login']);
    });
});

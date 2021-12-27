<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Master\PackagesController;
use Illuminate\Support\Facades\Auth;
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

Route::group(['auth:sanctum', 'verified'], function () {

    Route::group(['prefix' => 'master'], function() {
        Route::post('regisration', [RegistrationController::class, 'registerUser']);
        Route::post('verify_otp', [RegistrationController::class, 'otpVerify']);
        Route::post('login', [AuthController::class, 'login']);
    });


    Route::group(['middleware' => 'authadmin'], function() {
        Route::get('dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
        Route::group(['prefix' => 'master'], function() {
            Route::group(['prefix' => 'package'], function() {
                Route::get('package/view-all', [PackagesController::class, 'index'])->name('admin.package.index');
                Route::get('package', [PackagesController::class, 'create'])->name('admin.package.create');
                Route::post('package/save', [PackagesController::class, 'store'])->name('admin.package.store');
            });
        });
    });
});


//Route::post('/register', [RegistrationController::class, 'registerAdminUser'])->name('admin_user.registration');



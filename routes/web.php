<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Master\PackagesController;
use App\Http\Controllers\Master\PackagesPointsController;
use App\Http\Controllers\AgentsController;
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
    return view('auth.login');
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

                Route::group(['prefix' => 'points'], function() {
                    Route::get('view-all', [PackagesPointsController::class, 'index'])->name('admin.package_points.index');
                    Route::get('create', [PackagesPointsController::class, 'create'])->name('admin.package_points.create');
                    Route::post('save', [PackagesPointsController::class, 'store'])->name('admin.package_points.store');
                });
            });


            Route::group(['prefix' => 'agents'], function() {
                Route::get('view-all', [AgentsController::class, 'index'])->name('admin.agents.index');
                Route::get('create', [AgentsController::class, 'create'])->name('admin.agents.create');
                Route::post('save', [AgentsController::class, 'store'])->name('admin.agents.store');

                Route::get('enable/{id}', [AgentsController::class, 'enable'])->name('admin.agent.enable');
                Route::get('disable/{id}', [AgentsController::class, 'disable'])->name('admin.agent.disable');
            });


        });


        /*Route::get('storage/{filename}', function ($filename)
        {
            $path = storage_path('public/' . $filename);

            if (!File::exists($path)) {
                abort(404);
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $response;
        });*/
    });
});


//Route::post('/register', [RegistrationController::class, 'registerAdminUser'])->name('admin_user.registration');



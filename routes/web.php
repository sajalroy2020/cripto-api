<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('mail-verify/{token}', [AuthController::class, 'verifyMailLink']);


Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {
        return redirect('dashboard');
    });
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile-view', [ProfileController::class, 'profile'])->name('profile');
    Route::post('profile-update', [ProfileController::class, 'profileUpdate'])->name('profile-update');

    // chart data insurt route
    Route::group(['prefix' => 'chart', 'as' => 'chart.'], function () {
        Route::get('/', [ChartController::class, 'index'])->name('index');
        Route::post('/', [ChartController::class, 'store'])->name('store');
        Route::get('delete/{id}', [ChartController::class, 'delete'])->name('delete');
    });

});

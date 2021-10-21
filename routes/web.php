<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DashboardController;


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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');

//  SUPER ADMIN ROUTES START

Route::middleware(['auth:sanctum', 'verified'])->get('/delivery-companies', [SuperAdminController::class, 'DeliveryCompanies'])->name('delivery-companies');

//  SUPER ADMIN ROUTES END
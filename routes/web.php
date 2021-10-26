<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryCompanyController;


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

Route::middleware(['auth:sanctum', 'verified', 'supmin'])->get('/delivery-companies', [SuperAdminController::class, 'DeliveryCompanies'])->name('delivery-companies');

Route::middleware(['auth:sanctum', 'verified', 'supmin'])->get('/del-com-list', [DeliveryCompanyController::class, 'DeliveryCompanies'])->name('del-com-list');

Route::middleware(['auth:sanctum', 'verified', 'supmin'])->get('/add-del-com', [DeliveryCompanyController::class, 'AddDeliveryCompanies'])->name('add-del-com');

Route::middleware(['auth:sanctum', 'verified', 'supmin'])->post('/add-del-com', [DeliveryCompanyController::class, 'InsertDelComList'])->name('add-del-com');

Route::middleware(['auth:sanctum', 'verified', 'supmin'])->get('/category-list', [DeliveryCompanyController::class, 'CategoryList'])->name('category-list');

Route::middleware(['auth:sanctum', 'verified', 'supmin'])->get('/add-category', [DeliveryCompanyController::class, 'AddCategory'])->name('add-category');

Route::middleware(['auth:sanctum', 'verified', 'supmin'])->post('/add-category', [DeliveryCompanyController::class, 'InsertCategory'])->name('add-category');

//  SUPER ADMIN ROUTES END
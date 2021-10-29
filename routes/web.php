<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryCompanyController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\SupplyHandlerController;


use App\Http\Middleware\SuperAdmin;
use App\Http\Middleware\EnsureAuthManager;
use App\Http\Middleware\UserIsSupplyHander;




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

//  USER DASHBOARD
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');


//  SUPER ADMIN ROUTES START
//  CHECK IF ADMIN
Route::middleware([SuperAdmin::class])->group(function () {


// Route::middleware(['auth:sanctum', 'verified', 'supmin'])->get('/delivery-companies', [SuperAdminController::class, 'DeliveryCompanies'])->name('delivery-companies');

//  VIEW DELIVERY COMAPNIES
Route::middleware(['auth:sanctum', 'verified', 'supmin'])->get('/del-com-list', [DeliveryCompanyController::class, 'DeliveryCompanies'])->name('del-com-list');

//  VIEW DELIVERY COMAPNIES
Route::middleware(['auth:sanctum', 'verified', 'supmin'])->get('/add-del-com', [DeliveryCompanyController::class, 'AddDeliveryCompanies'])->name('add-del-com');

//  VIEW DELIVERY COMAPNIES
Route::middleware(['auth:sanctum', 'verified', 'supmin'])->post('/add-del-com', [DeliveryCompanyController::class, 'InsertDelComList'])->name('add-del-com');

//  VIEW DELIVERY COMAPNIES
Route::middleware(['auth:sanctum', 'verified', 'supmin'])->get('/category-list', [DeliveryCompanyController::class, 'CategoryList'])->name('category-list');

//  VIEW CATEGORY ADD PAGE
Route::middleware(['auth:sanctum', 'verified', 'supmin'])->get('/add-category', [DeliveryCompanyController::class, 'AddCategory'])->name('add-category');

//  INSERT DELIVERY COMPANY
Route::middleware(['auth:sanctum', 'verified', 'supmin'])->post('/add-category', [DeliveryCompanyController::class, 'InsertCategory'])->name('add-category');



});
//  SUPER ADMIN ROUTES END


//  MANAGER ROUTES START
//  CHECK IF ADMIN
Route::middleware([EnsureAuthManager::class])->group(function () {

// Route::middleware(['auth:sanctum', 'verified'])->get('/add-product', [ManagerController::class, 'AddProduct'])->name('add-product');

// Route::middleware(['auth:sanctum', 'verified'])->get('/product-list', [ManagerController::class, 'ProductList'])->name('product-list');


});
//  MANAGER ROUTES END


//  SUPPLY HANDLER ROUTES START
//  CHECK IF SUPPLYHANDLER
Route::middleware([UserIsSupplyHander::class])->group(function () {

Route::middleware(['auth:sanctum', 'verified'])->get('/add-product', [SupplyHandlerController::class, 'AddProduct'])->name('add-product');

Route::middleware(['auth:sanctum', 'verified'])->post('/insert-product', [SupplyHandlerController::class, 'InsertProduct'])->name('insert-product');

Route::middleware(['auth:sanctum', 'verified'])->get('/product-list', [SupplyHandlerController::class, 'ProductList'])->name('product-list');


});

//  SUPPLY HANDLER ROUTES END


//  COMMON ROUTES

Route::get('/logout', [CommonController::class, 'Logout'])->name('logout');

Route::get('/delete/{id}', [CommonController::class, 'DeleteProduct'])->name('delete');

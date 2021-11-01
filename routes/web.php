<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryCompanyController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\SupplyHandlerController;
use App\Http\Controllers\DataEntryHandler;


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

// USER DASHBOARD
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');


//  SUPER ADMIN ROUTES START
//  CHECK IF ADMIN
// Route::middleware([SuperAdmin::class])->group(function () {


Route::middleware(['auth:sanctum', 'verified'])->get('/delivery-companies', [SuperAdminController::class, 'DeliveryCompanies'])->name('delivery-companies');

//  VIEW DELIVERY COMAPNIES
Route::middleware(['auth:sanctum', 'verified'])->get('/del-com-list', [DeliveryCompanyController::class, 'DeliveryCompanies'])->name('del-com-list');

//  VIEW DELIVERY COMAPNIES
Route::middleware(['auth:sanctum', 'verified'])->get('/add-del-com', [DeliveryCompanyController::class, 'AddDeliveryCompanies'])->name('add-del-com');

//  VIEW DELIVERY COMAPNIES
Route::middleware(['auth:sanctum', 'verified'])->post('/add-del-com', [DeliveryCompanyController::class, 'InsertDelComList'])->name('add-del-com');

//  VIEW DELIVERY COMAPNIES
Route::middleware(['auth:sanctum', 'verified'])->get('/category-list', [DeliveryCompanyController::class, 'CategoryList'])->name('category-list');

//  VIEW CATEGORY ADD PAGE
Route::middleware(['auth:sanctum', 'verified'])->get('/add-category', [DeliveryCompanyController::class, 'AddCategory'])->name('add-category');

//  INSERT DELIVERY COMPANY
Route::middleware(['auth:sanctum', 'verified'])->post('/add-category', [DeliveryCompanyController::class, 'InsertCategory'])->name('add-category');



// });
//  SUPER ADMIN ROUTES END


//  MANAGER ROUTES START
//  CHECK IF MANAGER
// Route::middleware([EnsureAuthManager::class])->group(function () {

Route::middleware(['auth:sanctum', 'verified'])->get('/ma-add-product', [ManagerController::class, 'AddProduct'])->name('ma-add-product');

Route::middleware(['auth:sanctum', 'verified'])->get('/ma-product-list', [ManagerController::class, 'ProductList'])->name('ma-product-list');

Route::middleware(['auth:sanctum', 'verified'])->post('/ma-insert-product', [ManagerController::class, 'InsertProduct'])->name('ma-insert-product');

Route::middleware(['auth:sanctum', 'verified'])->post('/ma-save-price', [ManagerController::class, 'InsertPrice'])->name('ma-save-price');
// });
//  MANAGER ROUTES END


//  SUPPLY HANDLER ROUTES START
//  CHECK IF SUPPLYHANDLER
// Route::middleware([UserIsSupplyHander::class])->group(function () {

Route::middleware(['auth:sanctum', 'verified'])->get('/sh-add-product', [SupplyHandlerController::class, 'AddProduct'])->name('sh-add-product');

Route::middleware(['auth:sanctum', 'verified'])->post('/sh-insert-product', [SupplyHandlerController::class, 'InsertProduct'])->name('sh-insert-product');

Route::middleware(['auth:sanctum', 'verified'])->get('/sh-product-list', [SupplyHandlerController::class, 'ProductList'])->name('sh-product-list');


// });

//  SUPPLY HANDLER ROUTES END

//  DATA ENTRY ROUTES START
//  CHECK IF DATA ENTRY
Route::middleware([UserIsDataEntryHandler::class])->group(function () {

Route::middleware(['auth:sanctum', 'verified'])->get('/de-add-product', [DataEntryHandler::class, 'AddProduct'])->name('de-add-product');

Route::middleware(['auth:sanctum', 'verified'])->post('/de-insert-product', [DataEntryHandler::class, 'InsertProduct'])->name('de-insert-product');

Route::middleware(['auth:sanctum', 'verified'])->get('/de-product-list', [DataEntryHandler::class, 'ProductList'])->name('de-product-list');


});

//  SUPPLY HANDLER ROUTES END


//  COMMON ROUTES

Route::get('/logout', [CommonController::class, 'Logout'])->name('logout');

Route::get('/delete/{id}', [CommonController::class, 'DeleteProduct'])->name('delete');

Route::get('/delete-del/{id}', [CommonController::class, 'DeleteDeliveryCompany'])->name('delete-del');

Route::get('/delete-cat/{id}', [CommonController::class, 'DeleteCategory'])->name('delete-cat');

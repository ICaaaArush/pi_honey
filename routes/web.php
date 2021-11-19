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
use App\Http\Middleware\UserIsDataEntryHandler;



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

Route::middleware(['auth', 'supmin'])->prefix('/supmin')->group(function () {

    
    Route::middleware(['auth:sanctum', 'verified'])->get('/delivery-companies', [SuperAdminController::class, 'DeliveryCompanies'])->name('delivery-companies');
    Route::middleware(['auth:sanctum', 'verified'])->get('/del-com-list', [DeliveryCompanyController::class, 'DeliveryCompanies'])->name('del-com-list');
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-del-com', [DeliveryCompanyController::class, 'AddDeliveryCompanies'])->name('add-del-com');
    Route::middleware(['auth:sanctum', 'verified'])->post('/add-del-com', [DeliveryCompanyController::class, 'InsertDelComList'])->name('add-del-com');
    Route::middleware(['auth:sanctum', 'verified'])->get('/delete-del/{id}', [CommonController::class, 'DeleteDeliveryCompany'])->name('delete-del');
    Route::middleware(['auth:sanctum', 'verified'])->get('/category-list', [DeliveryCompanyController::class, 'CategoryList'])->name('category-list');
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-category', [DeliveryCompanyController::class, 'AddCategory'])->name('add-category');
    Route::middleware(['auth:sanctum', 'verified'])->post('/add-category', [DeliveryCompanyController::class, 'InsertCategory'])->name('add-category');
    Route::middleware(['auth:sanctum', 'verified'])->get('/delete-cat/{id}', [CommonController::class, 'DeleteCategory'])->name('delete-cat');
    Route::middleware(['auth:sanctum', 'verified'])->get('/color-list', [SuperAdminController::class, 'color_list'])->name('color-list');
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-color', [SuperAdminController::class, 'add_color'])->name('add-color');
    Route::middleware(['auth:sanctum', 'verified'])->post('/add-color', [SuperAdminController::class, 'store_color'])->name('add-color');
    Route::middleware(['auth:sanctum', 'verified'])->get('/delete-color/{id}', [SuperAdminController::class, 'delete_color'])->name('delete-color');
    Route::middleware(['auth:sanctum', 'verified'])->get('/brand-list', [SuperAdminController::class, 'brand_list'])->name('brand-list');
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-brand', [SuperAdminController::class, 'add_brand'])->name('add-brand');
    Route::middleware(['auth:sanctum', 'verified'])->post('/add-brand', [SuperAdminController::class, 'store_brand'])->name('add-brand');
    Route::middleware(['auth:sanctum', 'verified'])->get('/delete-brand/{id}', [SuperAdminController::class, 'delete_brand'])->name('delete-brand');
    Route::middleware(['auth:sanctum', 'verified'])->get('/size-list', [SuperAdminController::class, 'size_list'])->name('size-list');
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-size', [SuperAdminController::class, 'add_size'])->name('add-size');
    Route::middleware(['auth:sanctum', 'verified'])->post('/add-size', [SuperAdminController::class, 'store_size'])->name('add-size');
    Route::middleware(['auth:sanctum', 'verified'])->get('/delete-size/{id}', [SuperAdminController::class, 'delete_size'])->name('delete-size');
    Route::middleware(['auth:sanctum', 'verified'])->get('/quality-list', [SuperAdminController::class, 'quality_list'])->name('quality-list');
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-quality', [SuperAdminController::class, 'add_quality'])->name('add-quality');
    Route::middleware(['auth:sanctum', 'verified'])->post('/add-quality', [SuperAdminController::class, 'store_quality'])->name('add-quality');
    Route::middleware(['auth:sanctum', 'verified'])->get('/delete-quality/{id}', [SuperAdminController::class, 'delete_quality'])->name('delete-quality');
    Route::middleware(['auth:sanctum', 'verified'])->get('/branch-list', [SuperAdminController::class, 'branch_list'])->name('branch-list');
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-branch', [SuperAdminController::class, 'add_branch'])->name('add-branch');
    Route::middleware(['auth:sanctum', 'verified'])->post('/add-branch', [SuperAdminController::class, 'store_branch'])->name('add-branch');
    Route::middleware(['auth:sanctum', 'verified'])->get('/delete-branch/{id}', [SuperAdminController::class, 'delete_branch'])->name('delete-branch');
    Route::middleware(['auth:sanctum', 'verified'])->get('/sub-category-list', [DeliveryCompanyController::class, 'SubCategoryList'])->name('sub-category-list');
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-sub-category', [DeliveryCompanyController::class, 'AddSubCategory'])->name('add-sub-category');
    Route::middleware(['auth:sanctum', 'verified'])->post('/add-sub-category', [DeliveryCompanyController::class, 'InsertSubCategory'])->name('add-sub-category');
    Route::middleware(['auth:sanctum', 'verified'])->get('/delete-sub-cat/{id}', [CommonController::class, 'DeleteSubCategory'])->name('delete-sub-cat');
    Route::middleware(['auth:sanctum', 'verified'])->get('/season-list', [DeliveryCompanyController::class, 'SeasonList'])->name('season-list');
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-sseason', [DeliveryCompanyController::class, 'AddSeason'])->name('add-season');
    Route::middleware(['auth:sanctum', 'verified'])->post('/add-season', [DeliveryCompanyController::class, 'InsertSeason'])->name('add-season');
    Route::middleware(['auth:sanctum', 'verified'])->get('/delete-season/{id}', [CommonController::class, 'DeleteSeason'])->name('delete-season');
    
});

Route::middleware(['auth', 'dataentry'])->prefix('/data-entry')->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->post('/de-insert-product', [DataEntryHandler::class, 'InsertProduct'])->name('de-insert-product');
    Route::middleware(['auth:sanctum', 'verified'])->get('/de-product-list', [DataEntryHandler::class, 'ProductList'])->name('de-product-list');
    Route::middleware(['auth:sanctum', 'verified'])->get('/sort/{id}', [DataEntryHandler::class, 'ProductSort'])->name('sort');
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-order', [DataEntryHandler::class, 'add_order'])->name('de-add-order');
    Route::middleware(['auth:sanctum', 'verified'])->post('/place-order', [DataEntryHandler::class, 'store_order'])->name('de-place-order');
    Route::middleware(['auth:sanctum', 'verified'])->get('/de-add-product/{id}', [DataEntryHandler::class, 'add_product']);
    Route::middleware(['auth:sanctum', 'verified'])->get('/de-add/{id}', [DataEntryHandler::class, 'add']);
    Route::middleware(['auth:sanctum', 'verified'])->get('/add-return-product', [DataEntryHandler::class, 'add_return_product'])->name('de-add-return-product');
    Route::middleware(['auth:sanctum', 'verified'])->post('/store-return-order', [DataEntryHandler::class, 'store_return_product'])->name('de-place--return-product');
});

// USER DASHBOARD
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');

//  MANAGER ROUTES START
//  CHECK IF MANAGER
Route::middleware(['auth'])->prefix('/manager')->group(function () {

Route::middleware(['auth:sanctum', 'verified'])->get('/ma-add-product', [ManagerController::class, 'AddProduct'])->name('ma-add-product');

Route::middleware(['auth:sanctum', 'verified'])->get('/ma-product-list', [ManagerController::class, 'ProductList'])->name('ma-product-list');

Route::middleware(['auth:sanctum', 'verified'])->post('/ma-insert-product', [ManagerController::class, 'InsertProduct'])->name('ma-insert-product');

Route::middleware(['auth:sanctum', 'verified'])->post('/ma-save-price', [ManagerController::class, 'InsertPrice'])->name('ma-save-price');

Route::middleware(['auth:sanctum', 'verified'])->get('/ma-sorted-product-list', [ManagerController::class, 'SortedProductList'])->name('ma-sorted-product-list');

Route::middleware(['auth:sanctum', 'verified'])->get('/ma-return-product-list', [ManagerController::class, 'ReturnProductList'])->name('ma-return-product-list');

Route::middleware(['auth:sanctum', 'verified'])->get('/ma-change-status', [ManagerController::class, 'ChangeSortStatus'])->name('ma-change-status');

Route::middleware(['auth:sanctum', 'verified'])->get('/ma-edit/{id}', [ManagerController::class, 'MaEdit'])->name('ma-edit');

Route::middleware(['auth:sanctum', 'verified'])->post('/ma-confirm-return-product', [ManagerController::class, 'confirm_return'])->name('ma-confirm-return-product');

});
//  MANAGER ROUTES END


//  SUPPLY HANDLER ROUTES START
//  CHECK IF SUPPLYHANDLER
Route::middleware(['auth'])->prefix('/supply-handler')->group(function () {

Route::middleware(['auth:sanctum', 'verified'])->get('/sh-add-product', [SupplyHandlerController::class, 'AddProduct'])->name('sh-add-product');

Route::middleware(['auth:sanctum', 'verified'])->post('/sh-insert-product', [SupplyHandlerController::class, 'InsertProduct'])->name('sh-insert-product');

Route::middleware(['auth:sanctum', 'verified'])->get('/sh-product-list', [SupplyHandlerController::class, 'ProductList'])->name('sh-product-list');

Route::middleware(['auth:sanctum', 'verified'])->get('/sh-add-supplier', [SupplyHandlerController::class, 'AddSupplier'])->name('sh-add-supplier');

Route::middleware(['auth:sanctum', 'verified'])->post('/sh-insert-supplier', [SupplyHandlerController::class, 'InsertSupplier'])->name('sh-insert-supplier');

Route::middleware(['auth:sanctum', 'verified'])->post('/sh-update-supplier', [SupplyHandlerController::class, 'UpdateSupplier'])->name('sh-update-supplier');

Route::middleware(['auth:sanctum', 'verified'])->get('/sh-supplier-list', [SupplyHandlerController::class, 'SupplierList'])->name('sh-supplier-list');

Route::middleware(['auth:sanctum', 'verified'])->get('/delete-supplier/{id}', [CommonController::class, 'DeleteSupplier'])->name('delete-supplier');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-supplier/{id}', [SupplyHandlerController::class, 'EditSupplier'])->name('edit-supplier');

});

//  SUPPLY HANDLER ROUTES END

//  SUPPLY HANDLER ROUTES END


//  COMMON ROUTES

Route::get('/logout', [CommonController::class, 'Logout'])->name('logout');

Route::get('/delete/{id}', [CommonController::class, 'DeleteProduct'])->name('delete');

Route::get('/delete/main/{id}', [CommonController::class, 'DeleteMainProduct'])->name('delete-main');

Route::get('/orders', [CommonController::class, 'orders'])->name('orders');

Route::get('/customers', [CommonController::class, 'customers'])->name('customers');

Route::get('/de-get-product-detail/{id}', [CommonController::class, 'get_product_detail']);

Route::get('/de-get-products-detail/{id}', [CommonController::class, 'get_products_detail']);



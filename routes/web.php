<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['AdminAuth'])->group(function () {
    //routes protected by middleware to url type back to these routes after log in
    Route::redirect('/', 'loginPage');
    Route::get('/registerPage', [Authcontroller::class, 'registerPage'])->name('auth#register');
    Route::get('/loginPage', [Authcontroller::class, 'loginPage'])->name('auth#login');

});

//auth routes
Route::middleware([
    'auth',
])->group(function () {

    Route::get('/dashboard', [Authcontroller::class, 'dashboardPage'])->name('dashboard');

    //admin and accounts prevented by userAuth to control user access to admin privilege
    Route::prefix('account')->middleware(['userAuth'])->group(function () {
        Route::get('/listPage', [AdminController::class, 'listPage'])->name('admin#listPage');
        Route::get('/accountDetails', [AdminController::class, 'accountDetails'])->name('admin#accountDetails');
        Route::get('/editPage', [AdminController::class, 'editPage'])->name('admin#editPage');
        Route::post('/update', [AdminController::class, 'edit'])->name('admin#edit');

    });

    //dashboard for easy understanding and latest info about business
    Route::prefix('dashboard')->middleware(['userAuth'])->group(function () {
        Route::get('/listPage', [DashboardController::class, 'listPage'])->name('dashboard#listPage');
        Route::get('/lowStockPage', [DashboardController::class, 'lowStockPage'])->name('dashboard#lowStockPage');
        Route::get('/stockEditPage/{id}', [DashboardController::class, 'stockEditPage'])->name('dashboard#stockEditPage');
        Route::post('/stockUpdate', [DashboardController::class, 'stockUpdate'])->name('dashboard#stockUpdate');
        Route::get('/orderPage', [DashboardController::class, 'orderPage'])->name('dashboard#orderPage');
        Route::get('/pedingOrderDetails/{orderCode}', [DashboardController::class, 'pendingOrderDetails'])->name('dashboard#pendingOrderDetailsPage');

    });

    //common password change page for user and admin
    Route::get('/passwordChangePage', [AdminController::class, 'passwordChangePage'])->name('admin#passwordChangePage');
    Route::post('/passwordChange', [AdminController::class, 'passwordChange'])->name('admin#passwordChange');

    Route::prefix('user')->group(function () {
        //user can access these routes only
        Route::get('/details', [UserController::class, 'userDetails'])->name('user#accountDetails');
        Route::get('/editPage', [UserController::class, 'editPage'])->name('user#editPage');
        Route::post('/update', [UserController::class, 'edit'])->name('user#edit');

    });

    //category
    Route::prefix('category')->middleware(['userAuth'])->group(function () {
        Route::get('/listPage', [CategoryController::class, 'listPage'])->name('category#listPage');
        Route::get('/createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
        Route::post('/create', [CategoryController::class, 'create'])->name('category#create');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
        Route::get('/edit/{id}', [CategoryController::class, 'editPage'])->name('category#editPage');
        Route::post('/update', [CategoryController::class, 'update'])->name('category#update');
    });

    //product

    Route::prefix('product')->middleware(['userAuth'])->group(function () {
        Route::get('/listPage', [ProductController::class, 'listPage'])->name('product#listPage');
        Route::get('/createPage', [ProductController::class, 'createPage'])->name('product#createPage');
        Route::post('/create', [ProductController::class, 'create'])->name('product#create');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
        Route::get('/edit/{id}', [ProductController::class, 'editPage'])->name('product#editPage');
        Route::post('/update', [ProductController::class, 'update'])->name('product#update');
    });

    //order

    Route::prefix('order')->middleware(['userAuth'])->group(function () {
        Route::get('/listPage', [OrderController::class, 'listPage'])->name('order#listPage');
        Route::get('/listPage/filter', [OrderController::class, 'filterList'])->name('order#filterList');
        Route::get('/detailsPage/{orderCode}', [OrderController::class, 'details'])->name('order#detailsPage');
    });

    //contact

    Route::prefix('contact')->middleware(['userAuth'])->group(function () {
        Route::get('/listPage', [ContactController::class, 'listPage'])->name('contact#listPage');
        Route::get('/details/{id}', [ContactController::class, 'detailsPage'])->name('contact#detailsPage');
        Route::get('/delete/{id}', [ContactController::class, 'delete'])->name('contact#delete');

    });
    //ajax
    Route::prefix('ajax')->group(function () {
        //user role change with ajax by admin
        Route::get('/changeRole', [AjaxController::class, 'changeRole'])->name('ajax#changeRole');
        Route::get('/changeRoleUser', [AjaxController::class, 'changeRoleUser'])->name('ajax#changeRoleUser');
        Route::get('/deleteUser', [AjaxController::class, 'deleteUser'])->name('ajax#deleteUser');

        //ajax edit and delete category
        Route::get('/deleteCategory', [AjaxController::class, 'deleteCategory'])->name('ajax#deleteCategory');

        //order status update with ajax
        Route::get('/update/status', [AjaxController::class, 'updateStatus'])->name('ajax#updateStatus');

    });

});
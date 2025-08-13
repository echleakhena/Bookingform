<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;

Route::get('/Login', [AuthController::class, 'FormLogin'])->name('login');
Route::post('/LoginTo', [AuthController::class, 'Login'])->name('loginprocess');

Route::get('/', [BookingController::class, 'FormRegister'])->name('form');
Route::post('/StoreRegister', [BookingController::class, 'StoreBooking'])->name('store.register');
Route::get('/alert', [BookingController::class,'alert'])->name('alert.register');



Route::middleware('auth:sanctum')->group(function () {

        Route::prefix('User')->group(function () {
            Route::get('/List', [UserController::class, 'List'])->name('list.user');
            Route::get('/Create', [UserController::class, 'Create'])->name('create.user');
            Route::post('/Store', [UserController::class, 'Store'])->name('store.user');
            Route::delete('/Delete/{id}', [UserController::class, 'delete'])->name('delete.user');
        });
   
  
        Route::get('/Admin', [IndexController::class, 'Dashboard'])->name('dashboard');
        Route::post('/filter-data', [IndexController::class, 'filterData'])->name('filter.data');

        Route::prefix('Customer')->group(function () {
            Route::get('/List', [CustomerController::class, 'List'])->name('list.customer');
            Route::get('/Create', [CustomerController::class, 'Create'])->name('create.customer');
            Route::post('/Store', [CustomerController::class, 'Store'])->name('store.customer');
            Route::get('/FormUpdate', [CustomerController::class, 'UpdateForm'])->name('formupdate.customer');
            Route::post('/Update', [CustomerController::class, 'Update'])->name('update.customer');
            Route::get('/View/{id}', [CustomerController::class, 'View'])->name('view.customer');
        });

        Route::prefix('Service')->group(function () {
            Route::get('/List', [ServiceController::class, 'List'])->name('list.service');
            Route::get('/Create', [ServiceController::class, 'Create'])->name('create.service');
            Route::post('/Store', [ServiceController::class, 'Store'])->name('store.service');
            Route::get('/FormUpdate/{id}', [ServiceController::class, 'FormUpdate'])->name('formupdate.service');
            Route::post('/Update/{id}', [ServiceController::class, 'Update'])->name('update.service');
            Route::delete('/Delete/{id}', [ServiceController::class, 'Delete'])->name('delete.service');
        });

        Route::prefix('Booking')->group(function () {
            Route::get('/List', [BookingController::class, 'List'])->name('list.booking');
            Route::get('/Create', [BookingController::class, 'Create'])->name('create.booking');
            Route::post('/Store', [BookingController::class, 'Store'])->name('store.booking');
            Route::get('/FormUpdate/{id}', [BookingController::class, 'FormUpdate'])->name('formupdate.booking');
            Route::post('/Update/{id}', [BookingController::class, 'Update'])->name('update.booking');
            Route::get('/View/{id}', [BookingController::class, 'View'])->name('view.booking');

        });

        Route::prefix('Branch')->group(function () {
            Route::get('/List', [BranchController::class, 'List'])->name('list.branch');
            Route::get('/Create', [BranchController::class, 'Create'])->name('create.branch');
            Route::post('/Store', [BranchController::class, 'Store'])->name('store.branch');
            Route::get('/FormUpdate/{id}', [BranchController::class, 'FormUpdate'])->name('formupdate.branch');
            Route::post('/Update/{id}', [BranchController::class, 'Update'])->name('update.branch');
            Route::delete('/Delete/{id}', [BranchController::class, 'Delete'])->name('delete.branch');
        });
   

    Route::get('/Logout', [AuthController::class, 'Logout'])->name('logout');
});
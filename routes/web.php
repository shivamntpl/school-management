<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\Authantication;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\StudentRegisterController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\StudentPaymentController;
use App\Http\Controllers\Admin\StudentFeeController;


Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'guest:admins',
], function () {
    Route::get('/admin/login',[AdminController::class,'create'])->name('auth.login');
    Route::post('/login',[AdminController::class,'store'])->name('login.store');
});

Route::middleware(Authantication::class)->prefix('admin')->group(function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/logout',[AdminController::class,'destroy'])->name('admin.logout');

    Route::get('/student/list', [StudentRegisterController::class, 'index'])->name('student.list');
    Route::get('/student/register', [StudentRegisterController::class, 'create'])->name('student.create');
    Route::post('/student/store', [StudentRegisterController::class, 'store'])->name('student.store');
    Route::get('/student-invoice/{id}', [StudentRegisterController::class, 'invoice'])
    ->name('student.invoice');

    Route::delete('/student/{id}', [StudentRegisterController::class, 'destroy'])
    ->name('student.destroy');

    Route::get('/class/list', [ClassController::class, 'index'])->name('class.list');
    Route::get('/class/create', [ClassController::class, 'create'])->name('class.create');
    Route::post('/class/store', [ClassController::class, 'store'])->name('class.store');
    Route::get('/class/edit/{id}', [ClassController::class, 'edit'])->name('class.edit');
    Route::put('/class/update/{id}', [ClassController::class, 'update'])->name('class.update');
    Route::delete('/class/delete/{id}', [ClassController::class, 'destroy'])->name('class.destroy');

    Route::get('/vehicle/list', [VehicleController::class, 'index'])->name('vehicle.list');
    Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
    Route::post('/vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::get('/vehicle/edit/{id}', [VehicleController::class, 'edit'])->name('vehicle.edit');
    Route::put('/vehicle/update/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::delete('/vehicle/delete/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');

    Route::get('/student/profile/{id}', [StudentRegisterController::class, 'profile'])->name('student.profile');
    Route::post('/students/monthly-pay', [StudentPaymentController::class, 'monthlyPay']);
    Route::get('/students/{id}/edit', [StudentRegisterController::class, 'edit'])->name('student.edit');
    Route::put('/students/{id}/update', [StudentRegisterController::class, 'update'])->name('student.update');

    Route::get('/fees/list', [StudentFeeController::class, 'index'])->name('fees.list');
    Route::get('/fees/create', [StudentFeeController::class, 'create'])->name('fees.create');
    Route::post('/fees/store', [StudentFeeController::class, 'store'])->name('fees.store');
    Route::get('/fees/edit/{id}', [StudentFeeController::class, 'edit'])->name('fees.edit');
    Route::put('/fees/update/{id}', [StudentFeeController::class, 'update'])->name('fees.update');
    Route::delete('/fees/delete/{id}', [StudentFeeController::class, 'destroy'])->name('fees.destroy');



});

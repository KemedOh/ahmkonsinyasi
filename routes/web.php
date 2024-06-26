<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('user-export', [UserController::class, 'export'])->name('user-export');
Route::post('user-import', [UserController::class, 'import'])->name('user-import');

Route::resource('users', UserController::class);
Route::get('user', [UserController::class, 'index'])->name('user.index');

Route::resource('products', ProductController::class);
Route::get('product', [ProductController::class, 'index'])->name('products.index');

Route::resource('customers', CustomerController::class);
Route::get('customer', [CustomerController::class, 'index'])->name('customers.index');

Route::resource('sellings', SellingController::class);
Route::get('selling', [SellingController::class, 'index'])->name('sellings.index');

Route::get('report/sellings', [SellingController::class, 'report'])->name('sellings-report');
Route::get('report/sellings/pdf', [SellingController::class, 'reportPdf'])->name('sellings-reportPdf');

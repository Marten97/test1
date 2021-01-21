<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
    'register' => false,
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['isadmin']], function () {
    
    Route::get('company', [CompanyController::class, 'index'])->name('company');
    Route::post('store-company', [CompanyController::class, 'store'])->name('company.store');
    Route::post('update-company', [CompanyController::class, 'update'])->name('company.update');
    Route::post('delete-company', [CompanyController::class, 'destroy'])->name('company.destroy');

    Route::get('employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('store-employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::post('update-employee', [EmployeeController::class, 'update'])->name('employee.update');
    Route::post('delete-employee', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});

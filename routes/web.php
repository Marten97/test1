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
    Route::post('add-update-company', [CompanyController::class, 'store']);
    Route::post('edit-company', [CompanyController::class, 'edit']);
    Route::post('delete-company', [CompanyController::class, 'destroy']);

    Route::get('employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('store-employee', [EmployeeController::class, 'store']);
    Route::post('edit-employee', [EmployeeController::class, 'edit']);
    Route::post('delete-employee', [EmployeeController::class, 'destroy']);
});

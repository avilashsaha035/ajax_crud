<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('welcome');
});

//Customer
Route::get('/customer/add', [CustomerController::class, 'addCustomer'])->name('customer.add');          //add form
Route::post('/customer/create', [CustomerController::class, 'create'])->name('customer.create');        //insert
Route::get('/customer/show', [CustomerController::class, 'show'])->name('customer.show');               //read or view
Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');          //edit
Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');   //update
Route::get('/customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');    //delete


//Transaction
Route::post('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');

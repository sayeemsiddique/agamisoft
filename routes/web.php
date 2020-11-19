<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Maincontroller;
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
    $customer= null;
    return view('welcome', compact('customer'));
});
// Route::get('search-customer', [Maincontroller::class, 'search'])->name('search_customer');

Route::get('search-customer', [Maincontroller::class, 'search'])->name('search_customer');
Route::post('pay', [Maincontroller::class, 'pay'])->name('pay_payment');
Route::get('due', [Maincontroller::class, 'due'])->name('due');

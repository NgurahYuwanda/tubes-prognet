<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\DetailPenjualanController;

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

Route::get('/', [HomeController::class, 'index']);
Route::resource('/SatuanBarang', SatuanBarangController::class);
Route::resource('/Barang', BarangController::class);
Route::resource('/Penjualan', PenjualanController::class);
Route::resource('/DetailPenjualan', DetailPenjualanController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

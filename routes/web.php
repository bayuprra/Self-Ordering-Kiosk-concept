<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;

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

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::get('/login', 'login');
    Route::post('/login', 'authentikasi');
    Route::post('/logout', 'logout')->name('logout');
});
Route::get('/verifyUser', function () {
})->middleware('loginRoute');

Route::controller(PasswordController::class)->middleware('auth')->group(function () {
    Route::get('/changePassword', 'index')->name('changePassword');
    Route::post('/change', 'change')->name('change');
});

Route::controller(DashboardController::class)->middleware('auth')->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(KategoriController::class)->middleware('auth')->group(function () {
    Route::get('/kategori', 'index')->name('kategori');
    Route::post('/addKategori', 'store')->name('addKategori');
    Route::post('/updateKategori', 'update')->name('updateKategori');
    Route::post('/deleteKategori', 'delete')->name('deleteKategori');
});

Route::controller(MenuController::class)->middleware('auth')->group(function () {
    Route::get('/mennu', 'index')->name('mennu');
    Route::post('/addMenu', 'store')->name('addMenu');
    Route::post('/updateMenu', 'update')->name('updateMenu');
    Route::post('/deleteMenu', 'delete')->name('deleteMenu');

    // today's menu
    Route::get('/todaysMenu', 'todaysMenu')->name('todaysMenu');
    Route::post('/setUnavailbleMenu', 'setUnavailbleMenu')->name('setUnavailbleMenu');
});

Route::controller(MejaController::class)->middleware('auth')->group(function () {
    Route::get('/meja', 'index')->name('meja');
    Route::post('/addMeja', 'store')->name('addMeja');
    Route::post('/updateMeja', 'update')->name('updateMeja');
    Route::post('/deleteMeja', 'delete')->name('deleteMeja');
});

Route::controller(TransaksiController::class)->middleware('auth')->group(function () {
    Route::get('/dataTransaksi', 'index')->name('dataTransaksi');
    Route::get('/history', 'history')->name('history');
    Route::get('/kasir', 'kasir')->name('kasir');
});
Route::controller(KitchenController::class)->middleware('auth')->group(function () {
    Route::get('/kitchen', 'index')->name('kitchen');
    Route::get('/kitchenOrder', 'order')->name('kitchenOrder');
    Route::post('/checklist', 'checklist')->name('checklist');
    Route::get('/orderForKitchen', 'orderForKitchen')->name('orderForKitchen');
    Route::get('/allFinish', 'allFinish')->name('allFinish');
    Route::post('/Finish', 'Finish')->name('Finish');
});

//user route
Route::controller(MenuController::class)->group(function () {
    Route::post('/menuById', 'findById')->name('menuById');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/order', 'index')->name('order')->where('table', '[0-9]+');
    Route::post('/bayar', 'bayar')->name('bayar');
    Route::post('/storeOrder', 'storeOrder')->name('storeOrder');
});
Route::controller(TransaksiController::class)->group(function () {
    Route::post('/addTransaksi', 'store')->name('addTransaksi');
    Route::post('/updateTransaksi', 'update')->name('updateTransaksi');
});

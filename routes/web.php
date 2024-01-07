<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\Barang;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function(){
//     return view('dashboard');
// })->name('dashboard')->middleware(['auth','user-access:admin']);

Route::middleware(['auth', 'user-access:admin'])->prefix('barang')->group(
    function () {
        Route::get('', [BarangController::class, 'index'])->name('barang');
        Route::get('tambah', [BarangController::class, 'create'])->name('barang.create');
        Route::post('tambah', [BarangController::class, 'store'])->name('barang.store');
        Route::get('edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
        Route::post('update/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    }
);

Route::middleware(['auth', 'user-access:admin'])->prefix('user')->group(function () {
    Route::get('', [UserController::class, 'index'])->name('user');
    Route::get('/cari', [UserController::class, 'cari'])->name('user.cari');
    Route::get('tambah', [UserController::class, 'create'])->name('user.create');
    Route::post('tambah', [UserController::class, 'store'])->name('user.store');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'barang' => Barang::all(),
        ]);
    })->name('dashboard');
});

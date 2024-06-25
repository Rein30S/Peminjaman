<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenyewaanBarangController;
use App\Http\Controllers\PenyewaanMemberController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth', EnsureUserIsUser::class]], function () {
    Route::get('/user', [UserController::class, 'index'])->name('index_user');
});

Route::group(['middleware' => ['auth', EnsureUserIsAdmin::class]], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('index_admin');
});

Route::resource('barang', BarangController::class);

Route::resource('penyewaan', PenyewaanBarangController::class)->except(['show']);
Route::get('/barang/{id}', [PenyewaanBarangController::class, 'getBarang'])->name('barang.get');
Route::get('penyewaan/confirm', [PenyewaanBarangController::class, 'confirm'])->name('penyewaan.confirm');
Route::get('penyewaan/riwayat', [PenyewaanBarangController::class, 'riwayat'])->name('penyewaan.riwayat');
Route::patch('/penyewaan/{id}/kembali', [PenyewaanBarangController::class, 'kembali'])->name('penyewaan.kembali');

Route::get('/laporan/keuangan', [LaporanController::class, 'keuangan'])->name('laporan.keuangan');

Route::resource('member', MemberController::class);

Route::resource('penyewaan_member', PenyewaanMemberController::class)->except(['show']);
Route::get('/barang/{id}', [PenyewaanMemberController::class, 'getBarang'])->name('barang.get');
Route::get('user/penyewaan/confirm', [PenyewaanMemberController::class, 'confirm'])->name('user.penyewaan.confirm');
Route::get('user/penyewaan/riwayat', [PenyewaanMemberController::class, 'riwayat'])->name('user.penyewaan.riwayat');
Route::patch('user/penyewaan/{id}/kembali', [PenyewaanMemberController::class, 'kembali'])->name('user.penyewaan.kembali');
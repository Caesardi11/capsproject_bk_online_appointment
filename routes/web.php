<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegLogOutController;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\DokterDashboard;
use App\Http\Controllers\PasienDashboard;

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
    if(auth()->user()){
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('welcome');

Route::get('/register', [RegLogOutController::class, 'register'])->name('register');
Route::post('/register-proses', [RegLogOutController::class, 'register_proses'])->name('register-proses');
Route::get('/login', [RegLogOutController::class, 'login'])->name('login');
Route::post('/login-proses', [RegLogOutController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [RegLogOutController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::
middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PasienDashboard::class, 'index'])->name('dashboard');

    Route::middleware(['auth', 'checkrole:admin'])->group(function () {

        //manage dokter
        Route::get('admin/manage-dokter', [AdminDashboard::class, 'manageDokter'])->name('manageDokter');
        Route::get('admin/tambah-dokter', [AdminDashboard::class, 'tambahDokter'])->name('tambahDokter');
        Route::post('admin/tambah-dokter-proses', [AdminDashboard::class, 'tambahDokterProses'])->name('tambahDokterProses');
        Route::get('admin/edit-dokter/{id}', [AdminDashboard::class, 'editDokter'])->name('editDokter');
        Route::put('admin/edit-dokter-proses/{id}', [AdminDashboard::class, 'editDokterProses'])->name('editDokterProses');
        Route::delete('admin/hapus-dokter/{id}', [AdminDashboard::class, 'hapusDokter'])->name('hapusDokter');

        //manage poli
        Route::get('admin/manage-poli', [AdminDashboard::class, 'managePoli'])->name('managePoli');
        Route::get('admin/tambah-poli', [AdminDashboard::class, 'tambahPoli'])->name('tambahPoli');
        Route::post('admin/tambah-poli-proses', [AdminDashboard::class, 'tambahPoliProses'])->name('tambahPoliProses');
        Route::get('admin/edit-poli/{id}', [AdminDashboard::class, 'editPoli'])->name('editPoli');
        Route::put('admin/edit-poli-proses/{id}', [AdminDashboard::class, 'editPoliProses'])->name('editPoliProses');
        Route::delete('admin/hapus-poli/{id}', [AdminDashboard::class, 'hapusPoli'])->name('hapusPoli');

        //manage pasien
        Route::get('admin/manage-pasien', [AdminDashboard::class, 'managePasien'])->name('managePasien');
        Route::get('admin/tambah-pasien', [AdminDashboard::class, 'tambahPasien'])->name('tambahPasien');
        Route::post('admin/tambah-pasien-proses', [AdminDashboard::class, 'tambahPasienProses'])->name('tambahPasienProses');
        Route::get('admin/edit-pasien/{id}', [AdminDashboard::class, 'editPasien'])->name('editPasien');
        Route::put('admin/edit-pasien-proses/{id}', [AdminDashboard::class, 'editPasienProses'])->name('editPasienProses');
        Route::delete('admin/hapus-pasien/{id}', [AdminDashboard::class, 'hapusPasien'])->name('hapusPasien');

        //manage obat
        Route::get('admin/manage-obat', [AdminDashboard::class, 'manageObat'])->name('manageObat');
        Route::get('admin/tambah-obat', [AdminDashboard::class, 'tambahObat'])->name('tambahObat');
        Route::post('admin/tambah-obat-proses', [AdminDashboard::class, 'tambahObatProses'])->name('tambahObatProses');
        Route::get('admin/edit-obat/{id}', [AdminDashboard::class, 'editObat'])->name('editObat');
        Route::put('admin/edit-obat-proses/{id}', [AdminDashboard::class, 'editObatProses'])->name('editObatProses');
        Route::delete('admin/hapus-obat/{id}', [AdminDashboard::class, 'hapusObat'])->name('hapusObat');
    });

    Route::middleware(['auth', 'checkrole:dokter'])->group(function () {
        Route::get('dokter/user-setting/{id}', [DokterDashboard::class, 'userSetting'])->name('userSetting');
        Route::put('dokter/user-setting-proses/{id}', [DokterDashboard::class, 'userSettingProses'])->name('userSettingProses');
        Route::get('dokter/jadwal-periksa', [DokterDashboard::class, 'jadwalPeriksaDokter'])->name('jadwalPeriksaDokter');
        Route::post('dokter/input-jadwal-proses', [DokterDashboard::class, 'inputJadwalProses'])->name('inputJadwalProses');
        Route::put('dokter/edit-jadwal-proses', [DokterDashboard::class,'editJadwalProses'])->name('editJadwalProses');
        Route::get('dokter/periksa', [DokterDashboard::class, 'periksa'])->name('periksa');
        Route::get('dokter/periksa/{id_pasien}', [DokterDashboard::class, 'periksaProses'])->name('periksaProses');
        Route::put('dokter/periksa-proses/{id_pasien}', [DokterDashboard::class, 'periksaProsesInsert'])->name('periksaProsesInsert');
    });

    Route::middleware(['auth', 'checkrole:pasien'])->group(function () {
        Route::get('pasien/daftar-poli', [PasienDashboard::class, 'daftarPoli'])->name('daftarPoli');
        Route::post('pasien/daftar-poli-proses/{id}', [PasienDashboard::class, 'daftarPoliProses'])->name('daftarPoliProses');
    });
});

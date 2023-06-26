<?php

use App\Http\Controllers\AbsentController;
use App\Http\Controllers\CobaAja;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DataAbsensiController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinancialStatementController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\employeeSalaryController;
use App\Http\Controllers\IndexAdminController;
use App\Http\Controllers\SettingController;
use App\Models\Absent;
use App\Models\Izin;
use App\Models\User;
use App\Models\company;


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
    return view('dashboardlanding');
});

Route::get('/test',function(){
        company::query()->update(['status' => 'tutup']);
        return view('test');
});

Route::get('/about', function () {
    return view('landingpage.section.about');
});

// register admin
Route::get('/register/admin', [LoginController::class, 'indexRegisAdmin']);
Route::post('/register/admin', [LoginController::class, 'registrasiAdmin']);

// register employee
Route::get('/register/Employee', [LoginController::class, 'indexRegisEmployee']);
Route::post('/register/Employee', [LoginController::class, 'registrasiEmployee']);

// login
Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login'])->name('login');

// admin
Route::middleware(['loginAs'])->group(function () {

    Route::get('/admin',[IndexAdminController::class,'viewIndexAdmin']);

    // Setting
    Route::get('/setting',[SettingController::class,'viewSetting']);
    Route::get('/setting/presensi/buka',[AbsentController::class,'bukaPresensi']);
    Route::get('/setting/presensi/tutup',[AbsentController::class,'tutupPresensi']);
    Route::put('/setting/perusahaan/titik',[SettingController::class,'SettingLokasiPerusahaan']);
    // End Setting

    //Edit or Lihat Profile Perusahaan
    Route::get('/setting/perusahaan',[SettingController::class,'viewProfilePerusahaan']);
    Route::get('setting/perusahaan/profile',[SettingController::class,'viewEditProfilePerusahaan']);
    Route::put('/setting/perusahaan/profile/edit',[SettingController::class,'editProfilePerusahaan']);


    // jabatan
    Route::get('/jabatan', [JabatanController::class, 'index']);
    // add jabatan
    Route::get('/jabatan/add', [JabatanController::class, 'create']);
    Route::post('/jabatan', [JabatanController::class, 'store']);
    // edit jabatan
    Route::get('/jabatan/{id_jabatan}/edit', [JabatanController::class, 'edit']);
    Route::put('/jabatan/{id_jabatan}', [JabatanController::class, 'update']);
    // delete jabatan
    Route::get('jabatan/{id_jabatan}/delete', [JabatanController::class, 'destroy']);

    //Bayar Karyawan
    Route::get('/gaji',[employeeSalaryController::class,'viewGajiKaryawan']);
    Route::get('/gaji/bayar/{id}',[employeeSalaryController::class,'viewBayarGajiKaryawan']);
    Route::get('gaji/detail/{id}',[employeeSalaryController::class,'viewDetailGajiKaryawan']);
    Route::post('/gaji/bayar/{id}/kirim',[employeeSalaryController::class,'bayarGajiKaryawan']);
    //END Bayar Karyawan

    // karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::put('/karyawan/jabatan/edit/{id}', [KaryawanController::class, 'update']);
    Route::get('karyawan/info/{id}',[KaryawanController::class,'viewKaryawan']);
    Route::get('karyawan/info/{id}/kehadiran',[KaryawanController::class,'viewKaryawanKehadiran']);
    Route::get('karyawan/info/{id}/cuti',[KaryawanController::class,'viewKaryawanCuti']);
    Route::get('/karyawan/info/{id}/alpha',[KaryawanController::class,'viewKaryawanAlpha']);
    // End karyawan

    // Permintaan Cuti
    Route::get('/karyawan/cuti',[KaryawanController::class,'viewPermintaanCuti']);
    Route::put('/karyawan/update/cuti/{id}',[KaryawanController::class,'updateStatusCuti']);
    // END Permintaan Cuti

    // Permintaan Lupa Cuti
    Route::get('karyawan/lupaPresensi',[KaryawanController::class,'viewPermintaanLupaPresent']);
    Route::put('/karyawan/lupaPresensi/{id}',[KaryawanController::class,'setPermintaanLupaPresent']);
});

// employee
Route::middleware(['loginAsEmployee'])->group(function () {

    // Sistem Presensi
    Route::get('/absent', [AbsentController::class, 'index']);
    Route::put('/absent', [AbsentController::class, 'absent'])->name('absent');
    // END Sistem Presensi

    //Sistem Lupa Presensi
    Route::get('/lupaPresensi', [AbsentController::class, 'viewLupaPresensiEmpl']);
    Route::put('/lupaPresensi/kirim',[AbsentController::class, 'kirimLupaPresensiEmpl']);

    // Sistem Cuti
    Route::get('/cuti',[CutiController::class,'index']);
    Route::post('/cuti/kirim',[CutiController::class,'kirimCuti'])->name('kirimCuti');
    // END Sistem Cuti

    // Data Kehadiran
    Route::get('/data_absensi', [DataAbsensiController::class, 'index']);
    Route::get('data_absensi/cuti',[DataAbsensiController::class,'indexCuti']);
    Route::get('data_absensi/alpha',[DataAbsensiController::class,'indexAlpha']);
    // END Data Kehadiran

    //Riwayat Gaji
    Route::get('/riwayat_gaji',[employeeSalaryController::class,'viewGajiSaya']);
    //END Riwayat Gaji

    //Profile
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profile', [ProfileController::class, 'update']);
    //End Profile
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

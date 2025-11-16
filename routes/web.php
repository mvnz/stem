<?php

use App\Http\Controllers\TowerController;
use App\Http\Controllers\TempatSampahController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\MesinPemilahController;
use App\Http\Controllers\JadwalPiketController;
use App\Http\Controllers\InsidenController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotifWhatsappController;
use App\Http\Controllers\ActivityLogController;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/trash-data', [DashboardController::class, 'trashData'])->name('dashboard.trash-data');

    Route::get('/tower', [TowerController::class, 'index'])->name('tower.index');
    Route::get('/tower/create', [TowerController::class, 'create'])->name('tower.create');
    Route::post('/tower', [TowerController::class, 'store'])->name('tower.store');
    Route::get('/tower/edit/{id}', [TowerController::class, 'edit'])->name('tower.edit');
    Route::put('/tower/update/{id}', [TowerController::class, 'update'])->name('tower.update');
    Route::delete('/tower/delete/{id}', [TowerController::class, 'destroy'])->name('tower.destroy');

    Route::get('/tempatSampah', [TempatSampahController::class, 'index'])->name('tempatSampah.index');
    Route::get('/tempatSampah/create', [TempatSampahController::class, 'create'])->name('tempatSampah.create');
    Route::post('/tempatSampah', [TempatSampahController::class, 'store'])->name('tempatSampah.store');
    Route::get('/tempatSampah/edit/{id}', [TempatSampahController::class, 'edit'])->name('tempatSampah.edit');
    Route::put('/tempatSampah/update/{id}', [TempatSampahController::class, 'update'])->name('tempatSampah.update');
    Route::delete('/tempatSampah/delete/{id}', [TempatSampahController::class, 'destroy'])->name('tempatSampah.destroy');

    Route::get('/sensor', [SensorController::class, 'index'])->name('sensor.index');
    Route::get('/sensor/create', [SensorController::class, 'create'])->name('sensor.create');
    Route::post('/sensor', [SensorController::class, 'store'])->name('sensor.store');
    Route::get('/sensor/edit/{id}', [SensorController::class, 'edit'])->name('sensor.edit');
    Route::put('/sensor/update/{id}', [SensorController::class, 'update'])->name('sensor.update');
    Route::delete('/sensor/delete/{id}', [SensorController::class, 'destroy'])->name('sensor.destroy');

    Route::get('/mesinPemilah', [MesinPemilahController::class, 'index'])->name('mesinPemilah.index');
    Route::get('/mesinPemilah/create', [MesinPemilahController::class, 'create'])->name('mesinPemilah.create');
    Route::post('/mesinPemilah', [MesinPemilahController::class, 'store'])->name('mesinPemilah.store');
    Route::get('/mesinPemilah/edit/{id}', [MesinPemilahController::class, 'edit'])->name('mesinPemilah.edit');
    Route::put('/mesinPemilah/update/{id}', [MesinPemilahController::class, 'update'])->name('mesinPemilah.update');
    Route::delete('/mesinPemilah/delete/{id}', [MesinPemilahController::class, 'destroy'])->name('mesinPemilah.destroy');

    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/delete/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

    Route::get('/jadwalPiket', [JadwalPiketController::class, 'index'])->name('jadwalPiket.index');
    Route::post('/jadwalPiket/generate', [JadwalPiketController::class, 'generate'])->name('jadwalPiket.generate');
    Route::get('/jadwalPiket/create', [JadwalPiketController::class, 'create'])->name('jadwalPiket.create');
    Route::get('/jadwalPiket/edit/{id}', [JadwalPiketController::class, 'edit'])->name('jadwalPiket.edit');
    Route::put('/jadwalPiket/update/{id}', [JadwalPiketController::class, 'update'])->name('jadwalPiket.update');   

    Route::get('/insiden', [InsidenController::class, 'index'])->name('insiden.index');
    Route::get('/insiden/create', [InsidenController::class, 'create'])->name('insiden.create');
    Route::post('/insiden', [InsidenController::class, 'store'])->name('insiden.store');
    Route::get('/insiden/edit/{id}', [InsidenController::class, 'edit'])->name('insiden.edit');
    Route::put('/insiden/update/{id}', [InsidenController::class, 'update'])->name('insiden.update');
    Route::delete('/insiden/delete/{id}', [InsidenController::class, 'destroy'])->name('insiden.destroy');
    Route::get('/insiden/show/{id}', [InsidenController::class, 'show'])->name('insiden.show');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');   
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/notifikasi', [NotifWhatsappController::class, 'index'])->name('notifikasi.index');
    Route::get('/notifikasi/create', [NotifWhatsappController::class, 'create'])->name('notifikasi.create');
    Route::post('/notifikasi', [NotifWhatsappController::class, 'store'])->name('notifikasi.store');

    Route::get('/activityLog', [ActivityLogController::class, 'index'])->name('activityLog.index');

    Route::get('/api/thingspeak/perField', [DashboardController::class, 'hitungPerField']);
    Route::get('/api/thingspeak/allField', [DashboardController::class, 'hitungTotal']);
    Route::get('/api/thingspeak/sumFields', [DashboardController::class, 'sumFields']);


});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/logout', function(){
    return redirect()->route('login');
});
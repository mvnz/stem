<?php

use App\Http\Controllers\TowerController;
use App\Http\Controllers\TempatSampahController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\MesinPemilahController;
use App\Models\Tower;
use app\Models\TempatSampah;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

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

Route::get('/pegawai', [App\Http\Controllers\PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai/create', [App\Http\Controllers\PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('/pegawai', [App\Http\Controllers\PegawaiController::class, 'store'])->name('pegawai.store');
Route::get('/pegawai/edit/{id}', [App\Http\Controllers\PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::put('/pegawai/update/{id}', [App\Http\Controllers\PegawaiController::class, 'update'])->name('pegawai.update');
Route::delete('/pegawai/delete/{id}', [App\Http\Controllers\PegawaiController::class, 'destroy'])->name('pegawai.destroy');

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('/user', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');   
Route::delete('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');  

Route::get('/jadwalPiket', [App\Http\Controllers\JadwalPiketController::class, 'index'])->name('jadwalPiket.index');
Route::post('/jadwalPiket/generate', [App\Http\Controllers\JadwalPiketController::class, 'generate'])->name('jadwalPiket.generate');
Route::get('/jadwalPiket/create', [App\Http\Controllers\JadwalPiketController::class, 'create'])->name('jadwalPiket.create');
Route::get('/jadwalPiket/edit/{id}', [App\Http\Controllers\JadwalPiketController::class, 'edit'])->name('jadwalPiket.edit');
Route::put('/jadwalPiket/update/{id}', [App\Http\Controllers\JadwalPiketController::class, 'update'])->name('jadwalPiket.update');   

Route::get('/insiden', [App\Http\Controllers\InsidenController::class, 'index'])->name('insiden.index');
Route::get('/insiden/create', [App\Http\Controllers\InsidenController::class, 'create'])->name('insiden.create');
Route::post('/insiden', [App\Http\Controllers\InsidenController::class, 'store'])->name('insiden.store');
Route::get('/insiden/edit/{id}', [App\Http\Controllers\InsidenController::class, 'edit'])->name('insiden.edit');
Route::put('/insiden/update/{id}', [App\Http\Controllers\InsidenController::class, 'update'])->name('insiden.update');
Route::delete('/insiden/delete/{id}', [App\Http\Controllers\InsidenController::class, 'destroy'])->name('insiden.destroy');
Route::get('/insiden/show/{id}', [App\Http\Controllers\InsidenController::class, 'show'])->name('insiden.show');
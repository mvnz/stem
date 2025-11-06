<?php

use App\Http\Controllers\TowerController;
use App\Http\Controllers\TempatSampahController;
use App\Http\Controllers\SensorController;
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
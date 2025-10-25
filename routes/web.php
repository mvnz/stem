<?php

use App\Http\Controllers\TowerController;
use App\Models\Tower;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/tower', [TowerController::class, 'index']);
Route::get('/tower/create', [TowerController::class, 'create']);
Route::post('/tower/store', [TowerController::class, 'store']);
Route::get('/tower/edit/{id}', [TowerController::class, 'edit']);
Route::post('/tower/update/{id}', [TowerController::class, 'update']);
Route::get('/tower/delete/{id}', [TowerController::class, 'delete']);
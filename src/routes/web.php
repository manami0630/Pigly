<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightController;



Route::middleware('auth')->group(function () {
    Route::get('/register/step2', [WeightController::class, 'initial']);

    Route::post('/register/step2', [WeightController::class, 'store']);

    Route::get('/weight_logs', [WeightController::class, 'admin']);

    Route::post('/weight_logs', [WeightController::class, 'show']);

    Route::get('/weight_logs/goal_setting', [WeightController::class, 'settings']);

    Route::post('/weight_logs/goal_setting', [WeightController::class, 'updateGoal']);

    Route::post('/weight_logs/{id}/update', [WeightController::class, 'update'])->name('weight_logs.update');

    Route::delete('/weight_logs/{id}/delete', [WeightController::class, 'destroy']);

    Route::get('/weight_logs/{id}', [WeightController::class, 'details']);

    Route::get('/weight_logs/search', [WeightController::class, 'search'])->name('weight_logs.search');
});
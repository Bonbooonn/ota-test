<?php

use App\Http\Controllers\JobBoard\CreateJobBoardController;
use App\Http\Controllers\JobBoard\GetAllJobBoardController;
use Illuminate\Support\Facades\Route;

Route::prefix('job-board')->group(function () {
    Route::get('get-all', GetAllJobBoardController::class)->name('job-board.get-all');

    Route::middleware('auth:sanctum')->group(function() {
        Route::post('create', CreateJobBoardController::class)->name('job-board.create');
    });
});

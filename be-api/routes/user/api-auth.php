<?php

use App\Http\Controllers\Users\AuthenticateController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function() {
    Route::post('authenticate', AuthenticateController::class)->name('user.authenticate');
});

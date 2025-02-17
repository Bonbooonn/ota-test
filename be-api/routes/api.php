<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    $directories = [
        __DIR__ . '/job-board',
        __DIR__ . '/job-post',
        __DIR__ . '/user',
    ];

    foreach ($directories as $directory) {
        $files = glob($directory . '/*.php');

        foreach ($files as $file) {
            require $file;
        }
    }
});

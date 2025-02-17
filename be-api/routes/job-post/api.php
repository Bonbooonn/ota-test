<?php

use app\Http\Controllers\JobPosts\ApproveJobPostController;
use App\Http\Controllers\JobPosts\CreateJobPostController;
use App\Http\Controllers\JobPosts\GetCombinedJobPostController;
use app\Http\Controllers\JobPosts\GetExternalJobPostController;
use App\Http\Controllers\JobPosts\GetExternalJobPostsController;
use app\Http\Controllers\JobPosts\GetJobPostController;
use App\Http\Controllers\JobPosts\GetJobPostsController;
use App\Http\Controllers\JobPosts\RejectJobPostController;
use Illuminate\Support\Facades\Route;

Route::prefix('job-post')->group(function () {
    Route::post('create', CreateJobPostController::class)->name('job-post.create');
    Route::get('/{id}/get', GetJobPostController::class)->name('job-post.get');
    Route::get('/{id}/get-external', GetExternalJobPostController::class)->name('job-post.get-external');
    Route::get('get-external', GetExternalJobPostsController::class)->name('job-post.get-external-list');
    Route::get("/get-list", GetJobPostsController::class)->name('job-post.get-list');
    Route::get('/get-combined', GetCombinedJobPostController::class)->name('job-post.get-combined');

    Route::middleware('auth:sanctum')->group(function () {
        Route::patch('/{id}/approve', ApproveJobPostController::class)->name('job-post.approve');
        Route::patch('/{id}/reject', RejectJobPostController::class)->name('job-post.reject');
    });
});

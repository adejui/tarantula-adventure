<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\OpaController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\LoanController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\ActivityController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoanDetailController;
use App\Http\Controllers\Dashboard\ActivityPhotoController;
use App\Http\Controllers\Dashboard\ActivityMemberController;
use App\Http\Controllers\Dashboard\ActivityDocumentController;


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::put('/users/{id}/photo', [UserController::class, 'updatePhoto'])->name('users.update-photo');
    Route::delete('/users/{id}/photo', [UserController::class, 'deletePhoto'])->name('users.delete-photo');

    Route::get('/generate-nrp-password', [UserController::class, 'generateNrpPassword'])->name('generate.nrp.password');


    Route::resource('opas', OpaController::class);

    Route::get('/activities/events', [ActivityController::class, 'getEvents']);
    Route::resource('activities', ActivityController::class);
    Route::get('/activity-lists', [ActivityController::class, 'listActivity'])->name('list.activity');
    Route::get('/activities/manage/{activity}', [ActivityController::class, 'manage'])->name('manage.activity');

    Route::resource('items', ItemController::class);
    Route::get('/items/generate-code/{category}', [ItemController::class, 'generateCode']);


    Route::resource('categories', CategoryController::class);

    Route::resource('loans', LoanController::class);
    Route::get('/loans/manage/{loan}', [LoanController::class, 'manage'])->name('loans.manage');

    Route::resource('loan-details', LoanDetailController::class);
    Route::resource('activity-members', ActivityMemberController::class);
    Route::resource('activity-documents', ActivityDocumentController::class);
    Route::resource('activity-photos', ActivityPhotoController::class);
    Route::resource('articles', ArticleController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\OpaController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\LoanController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\ActivityController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoanDetailController;
use App\Http\Controllers\Dashboard\ActivityMemberController;
use App\Http\Controllers\Dashboard\ActivityDocumentController;



Route::resource('users', UserController::class);
Route::resource('opas', OpaController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('activities', ActivityController::class);
Route::get('/activities/events', [ActivityController::class, 'getEvents']);

Route::resource('items', ItemController::class);
Route::get('/items/generate-code/{category_id}', [ItemController::class, 'generateCode']);

Route::resource('categories', CategoryController::class);

Route::resource('loans', LoanController::class);
Route::get('/loans/manage/{loan}', [LoanController::class, 'manage'])->name('loans.manage');

Route::resource('loan-details', LoanDetailController::class);
Route::resource('activity-members', ActivityMemberController::class);
Route::resource('activity-documents', ActivityDocumentController::class);
Route::resource('articles', ArticleController::class);

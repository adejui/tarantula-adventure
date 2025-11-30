<?php

// --- CONTROLLERS FRONTEND ---
use App\Http\Controllers\Frontend\HomeController;

// --- CONTROLLERS BACKEND ---
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

// --- FRONTEND ---
Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});


// --- Login ---
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --- BACKEND ---

Route::get('/users/{user}/edit-profile', [UserController::class, 'editProfile'])
    ->name('users.editProfile');

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
    Route::get('/notifications/{loan}', [LoanController::class, 'showNotification'])->name('notifications.show');
    Route::get('/loans/manage/{loan}', [LoanController::class, 'manage'])->name('loans.manage');
    Route::post('loans/{loan}/accept', [LoanController::class, 'accept'])->name('loans.accept');
    Route::post('loans/{loan}/reject', [LoanController::class, 'reject'])->name('loans.reject');
    Route::post('loans/{loan}/approve', [LoanController::class, 'approve'])->name('loans.approve');
    Route::post('loans/{loan}/borrowed', [LoanController::class, 'borrowed'])->name('loans.borrowed');

    Route::resource('loan-details', LoanDetailController::class);
    // Route::post('/loans/{loan}/details', [LoanController::class, 'store'])->name('loan-details.store');

    // Route untuk menyimpan loan detail (item yang dipinjam)
    // Route::post('/loans/{loan}/details', [LoanDetailController::class, 'store'])->name('loan-details.store');
    // Route::post('/loans/{loan}/details', [LoanDetailController::class, 'store'])->name('loan-details.store');
    Route::post('/loans/{loan}/details', [LoanDetailController::class, 'store'])->name('loan-details.store');

    // Route::post('/loan-details/store', [LoanDetailController::class, 'store'])->name('loan-details.store');



    Route::resource('activity-members', ActivityMemberController::class);
    Route::resource('activity-documents', ActivityDocumentController::class);
    Route::resource('activity-photos', ActivityPhotoController::class);
    Route::resource('articles', ArticleController::class);
});

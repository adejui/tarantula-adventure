<?php

// --- CONTROLLERS FRONTEND ---
use App\Mail\LoanApprovedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// --- CONTROLLERS BACKEND ---
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\OpaController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\LoanController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\ActivityController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Frontend\InventoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Frontend\PublicLoanController;
use App\Http\Controllers\Dashboard\LoanDetailController;
use App\Http\Controllers\Dashboard\ActivityPhotoController;
use App\Http\Controllers\Frontend\PublicActivityController;
use App\Http\Controllers\Dashboard\ActivityMemberController;
use App\Http\Controllers\Dashboard\ActivityDocumentController;


// Route::get('/test-mail', function () {
//     $loan = App\Models\Loan::first(); // contoh
//     Mail::to('chestnuthealer@gmail.com')->send(new LoanApprovedMail($loan));
//     return "Email dikirim!";
// });
Route::get('/test-email', function () {
    Mail::raw('Test Mailtrap', function ($msg) {
        $msg->to('chestnuthealer@gmail.com')->subject('Testing Mailtrap');
    });

    return 'Email sudah dikirim';
});

// --- FRONTEND ---
Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::get('/inventory/{id}', [InventoryController::class, 'show'])->name('inventory.show');

    Route::get('/kegiatan', [PublicActivityController::class, 'index'])->name('kegiatan');

    Route::post('/inventory/cart/add/{id}', [InventoryController::class, 'addToCart'])->name('inventory.cart.add');


    Route::post('/inventory/cart/update-qty', [InventoryController::class, 'updateQty'])
        ->name('inventory.cart.updateQty');


    Route::post('/inventory/cart/update/{id}', [InventoryController::class, 'updateCart'])->name('inventory.cart.update');
    Route::post('/inventory/cart/remove/{id}', [InventoryController::class, 'removeFromCart'])->name('inventory.cart.remove');

    Route::get('/pinjaman', [PublicLoanController::class, 'pinjamanForm'])->name('pinjaman');
    Route::post('/pinjaman/store', [PublicLoanController::class, 'store'])->name('pinjaman.store');
    Route::get('/pinjaman/sukses', [PublicLoanController::class, 'success'])->name('pinjaman.success');

    Route::get('/artikel', [PublicArticleController::class, 'index'])->name('artikel');   
    // Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('frontend.articles.show');
});



// --- Login ---
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});



// --- BACKEND ---
// --- Role: Admin dan Logistik ---
Route::middleware(['auth', 'role:admin,logistics'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('opas', OpaController::class);

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
    Route::post('/loans/{loan}/details', [LoanDetailController::class, 'store'])->name('loan-details.store');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// --- Role: Admin ---
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('users', UserController::class);
    Route::put('/users/{id}/photo', [UserController::class, 'updatePhoto'])->name('users.update-photo');
    Route::delete('/users/{id}/photo', [UserController::class, 'deletePhoto'])->name('users.delete-photo');

    Route::get('/generate-nrp-password', [UserController::class, 'generateNrpPassword'])->name('generate.nrp.password');

    Route::get('/activities/events', [ActivityController::class, 'getEvents']);
    Route::resource('activities', ActivityController::class);
    Route::get('/activity-lists', [ActivityController::class, 'listActivity'])->name('list.activity');
    Route::get('/activities/manage/{activity}', [ActivityController::class, 'manage'])->name('manage.activity');

    Route::resource('activity-members', ActivityMemberController::class);
    Route::resource('activity-documents', ActivityDocumentController::class);
    Route::resource('activity-photos', ActivityPhotoController::class);
    Route::resource('articles', ArticleController::class);
});


// --- Role: Logistik ---
Route::middleware(['auth', 'role:logistics'])->group(function () {

    Route::get('/users/{user}/edit-profile', [UserController::class, 'editProfile'])
        ->name('users.editProfile');
});

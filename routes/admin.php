<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PublishingStepController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WritingEventController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Modules
    Route::resource('books', BookController::class);
    Route::resource('news', NewsController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('events', WritingEventController::class);
    Route::resource('publishing-steps', PublishingStepController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('faqs', FaqController::class);
    Route::get('contacts', [ContactMessageController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{id}', [ContactMessageController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{id}', [ContactMessageController::class, 'destroy'])->name('contacts.destroy');

    // Profile & Users
    Route::get('company-profile', [CompanyProfileController::class, 'edit'])->name('company-profile.edit');
    Route::put('company-profile', [CompanyProfileController::class, 'update'])->name('company-profile.update');
    Route::resource('users', UserController::class);
});

// Logout
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

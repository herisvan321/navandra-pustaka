<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PublishingStepController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WritingEventController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/faq', [PublicController::class, 'faq'])->name('public.faq');
Route::get('/paket-penerbitan', [PublicController::class, 'packages'])->name('public.packages');
Route::get('/terbitkan-buku', [PublicController::class, 'publishingSteps'])->name('public.steps');
Route::get('/belanja-buku', [PublicController::class, 'books'])->name('public.books');
Route::get('/tentang-kami', [PublicController::class, 'about'])->name('public.about');
Route::get('/contact-us', [PublicController::class, 'contact'])->name('public.contact');
Route::post('/contact-us', [PublicController::class, 'storeContact'])->name('public.contact.store');
Route::get('/event-menulis', [PublicController::class, 'events'])->name('public.events');
Route::get('/galeri-foto', [PublicController::class, 'gallery'])->name('public.gallery');
Route::get('/testimoni', [PublicController::class, 'testimonials'])->name('public.testimonials');
Route::get('/dokumentasi-event', [PublicController::class, 'documentation'])->name('public.documentation');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected by Middleware)
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('books', BookController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('events', WritingEventController::class);
    Route::resource('news', NewsController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('contacts', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::resource('publishing-steps', PublishingStepController::class);

    Route::get('company-profile', [CompanyProfileController::class, 'edit'])->name('company-profile.edit');
    Route::put('company-profile', [CompanyProfileController::class, 'update'])->name('company-profile.update');
});

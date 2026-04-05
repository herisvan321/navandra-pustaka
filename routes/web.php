<?php

use App\Http\Controllers\PublicController;
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

<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectRequestController;
use Illuminate\Support\Facades\Route;

// Default to Arabic.
Route::get('/', fn () => redirect('/ar'));

Route::prefix('{locale}')
    ->where(['locale' => 'ar|en'])
    ->middleware('setLocale')
    ->group(function () {
        Route::get('/', [PageController::class, 'home'])->name('home');

        Route::get('/services', [PageController::class, 'services'])->name('services');

        Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
        Route::get('/portfolio/{slug}', [PageController::class, 'project'])->name('project');

        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('post');

        Route::get('/contact', [PageController::class, 'contact'])->name('contact');
        Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

        Route::get('/request', [ProjectRequestController::class, 'create'])->name('request');
        Route::post('/request', [ProjectRequestController::class, 'store'])->name('request.store');
    });

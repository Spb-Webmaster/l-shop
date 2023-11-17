<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Support\Facades\Route;







Route::controller(SignInController::class)->group(function () {

    Route::get('/login', 'page')->name('login');
    Route::post('/login', 'handle')
        ->middleware('throttle:auth')
        ->name('login.handle');

});

Route::controller(SignUpController::class)->group(function () {

    Route::get('/sign-up', 'page')->name('register');
    Route::post('/sign-up', 'handle')
        ->middleware('throttle:auth')
        ->name('register.handle');

});

Route::controller(ForgotPasswordController::class)->group(function () {

    Route::get('/forgot-password', 'page')
        ->middleware('guest')
        ->name('forgot');

    Route::post('/forgot-password', 'handle')
        ->middleware('guest')
        ->name('forgot.handel');

});

Route::controller(ResetPasswordController::class)->group(function () {

    Route::get('/reset-password/{token}', 'page')
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', 'handle')
        ->middleware('guest')
        ->name('password.handle');

});

Route::controller(LogoutController::class)->group(function () {

    Route::delete('/logout', 'page')->name('logOut');

});


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/storage/images/{dir}/{method}/{size}/{file}', ThumbnailController::class)
    ->where('method', 'resize|crop|fit')
    ->where('size', '\d+x\d+')
    ->where('file', '.+\.(png|jpg|gif|bmp|svg|jpeg|JPG|JPEG)$')
    ->name('thumbnail');


Route::get('/catalog/{category:slug?}', [CatalogController::class, 'index'])->name('catalog');

Route::get('/product/{product:slug}', [ProductController::class, 'index'])->name('product');

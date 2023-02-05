<?php

use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/redirect', [SocialController::class, 'redirect'])->name('google.redirect');
Route::get('/google/redirect', [SocialController::class, 'googleCallback'])->name('google.callback');

Route::get('/auth/redirect/facebook', [SocialController::class, 'facebookRedirect'])->name('facebook.redirect');
Route::get('/facebook/redirect', [SocialController::class, 'facebookCallback'])->name('facebook.callback');

Route::get('/', function () {
    return view('welcome');
});

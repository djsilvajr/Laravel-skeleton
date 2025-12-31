<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Middleware\WebAuthenticate;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return class_exists(\App\Http\Web\Controllers\HomeController::class) ? 'ok' : 'faltou';
// });


// Route::get('/login', [LoginController::class, 'loginView'])
//     ->name('login.retornaViewLogin');
// Route::post('/login', [LoginController::class, 'realizarLogin'])
//     ->name('login.realizar');

Route::middleware([WebAuthenticate::class])->group(function () {
    //Route::get('/', [HomeController::class, 'homeView']);
    //Route::get('/home', [HomeController::class, 'homeView'])->name('home.home');
});
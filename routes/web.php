<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController};
use App\Http\Controllers\Auth\{LoginController, RegisterController};
use App\Http\Middleware\CheckIsAdmin;

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::get('users', [UserController::class, 'allUsers'])->middleware(CheckIsAdmin::class . ':role')->name('users');

//dashboard page
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

//flot page
Route::get('/flot', function(){
    return view('flot');
})->name('flot');

//Morris page
Route::get('/morris', function(){
    return view('morris');
})->name('morris');

//Table page
Route::get('/table', function(){
    return view('table');
})->name('table');

//forms page
Route::get('/forms', function(){
    return view('forms');
})->name('forms');

//UI elements/panels-wells
Route::get('/panels-wells', function(){
    return view('panels-wells');
})->name('panels-wells');

//UI elements/buttons
Route::get('/buttons', function(){
    return view('buttons');
})->name('buttons');

//UI elements/notifications
Route::get('/notifications', function(){
    return view('notifications');
})->name('notifications');

//UI elements/typography
Route::get('/typography', function(){
    return view('typography');
})->name('typography');
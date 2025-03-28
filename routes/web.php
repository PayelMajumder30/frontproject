<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, UserController, HomeController};
use App\Http\Controllers\Auth\{LoginController, RegisterController};
use App\Http\Middleware\CheckIsAdmin;

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register');

//Admin chat routes
Route::get('admin', [AdminController::class, 'allUsers'])->middleware(CheckIsAdmin::class . ':role')->name('users');
// Route::get('users', [AdminController::class, 'chatbox'])->middleware(CheckIsAdmin::class . ':role')->name('chatbox');
Route::get('admin/chat/{userId}', [AdminController::class, 'chat'])->middleware(CheckIsAdmin::class . ':role')->name('admin.adminchat'); 
Route::post('admin/chat/send/{userId}', [AdminController::class, 'sendmessage'])->middleware(CheckIsAdmin::class . ':role')->name('admin.adminchat.send'); 

//User chat routes
// Route::get('users/chat/{userId}', [UserController::class, 'index'])->middleware(CheckIsUser::class . ':role')->name('user.chat'); 
// Route::post('users/chat/send/{userId}', [UserController::class, 'sendmessage'])->middleware(CheckIsUser::class . ':role')->name('user.chat.send'); 

Route::middleware(['auth'])->group(function () {
    Route::get('users/chat/{userId}', [UserController::class, 'index'])->name('users.chat');
    Route::post('users/chat/send/{userId}', [UserController::class, 'sendMessage'])->name('users.chat.send');
});
//dashboard page
Route::get('/',[HomeController::class, 'dashboardview'])->name('dashboard');

//flot page
Route::get('/flot',[HomeController::class, 'flotview'])->name('flot');

//Morris page
Route::get('/morris',[HomeController::class, 'morrisview'])->name('morris');

//Table page
Route::get('/table',[HomeController::class, 'tableview'])->name('table');

//forms page
Route::get('/forms',[HomeController::class, 'formsview'])->name('forms');

//UI elements/panels-wells
Route::get('/panels-wells',[HomeController::class, 'panelswellsview'])->name('panels-wells');

//UI elements/buttons
Route::get('/buttons',[HomeController::class, 'buttonsview'])->name('buttons');

//UI elements/notifications
Route::get('/notifications',[HomeController::class, 'notificationsview'])->name('notifications');

//UI elements/typography
Route::get('/typography',[HomeController::class, 'typographyview'])->name('typography');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, UserController, HomeController, ProfileController};
use App\Http\Controllers\Auth\{LoginController, RegisterController, ResetPasswordController};
use App\Http\Middleware\CheckIsAdmin;

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register');

//Forget password

// Show reset password form
Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.request');
// Handle password reset submission
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

//Admin chat routes
Route::get('admin/userlist', [AdminController::class, 'allUsers'])->middleware(CheckIsAdmin::class . ':role')->name('users');
// Route::get('users', [AdminController::class, 'chatbox'])->middleware(CheckIsAdmin::class . ':role')->name('chatbox');
Route::get('admin/chat/{userId}', [AdminController::class, 'chat'])->middleware(CheckIsAdmin::class . ':role')->name('admin.adminchat'); 
Route::post('admin/chat/send/{userId}', [AdminController::class, 'sendmessage'])->middleware(CheckIsAdmin::class . ':role')->name('admin.adminchat.send'); 
Route::get('admin/unread-messages', [AdminController::class, 'getUnreadMessages'])->middleware(CheckIsAdmin::class . ':role')->name('admin.unreadMessages');

//User chat routes
Route::middleware(['auth'])->group(function () {
    Route::get('users/chat/{userId}', [UserController::class, 'index'])->name('users.chat');
    Route::post('users/chat/send/{userId}', [UserController::class, 'sendMessage'])->name('users.chat.send');
});

//Update Profile
Route::middleware(['auth'])->group(function (){
    Route::get('profile',[ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update',[ProfileController::class, 'update'])->name('profile.update');
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
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, UserController, HomeController, ProfileController, DesignationController, 
    TeamController, ProductController};
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
Route::prefix('admin')->group(function(){
    Route::get('/userlist', [AdminController::class, 'allUsers'])->middleware(CheckIsAdmin::class . ':role')->name('users');
    //Route::get('admin/userdetails', [AdminController::class, 'detailUsers'])->middleware(CheckIsAdmin::class . ':role')->name('admin.userdetails');
    Route::get('/userdetails', [AdminController::class, 'detailUsers'])->middleware(CheckIsAdmin::class . ':role')->name('admin.userdetails');
    // Route::get('users', [AdminController::class, 'chatbox'])->middleware(CheckIsAdmin::class . ':role')->name('chatbox');
    Route::get('/chat/{userId}', [AdminController::class, 'chat'])->middleware(CheckIsAdmin::class . ':role')->name('admin.adminchat'); 
    Route::post('/chat/send/{userId}', [AdminController::class, 'sendmessage'])->middleware(CheckIsAdmin::class . ':role')->name('admin.adminchat.send'); 
    Route::get('/unread-messages', [AdminController::class, 'getUnreadMessages'])->middleware(CheckIsAdmin::class . ':role')->name('admin.unreadMessages');
    Route::get('/user/edit/{id}', [AdminController::class, 'edit'])->middleware(CheckIsAdmin::class . ':role')->name('admin.useredit');
    Route::post('/user/update/{id}', [AdminController::class, 'update'])->middleware(CheckIsAdmin::class . ':role')->name('admin.userupdate');
    Route::post('admin/make-team-leader/{id}', [AdminController::class, 'assignTeamLeader'])->middleware(CheckIsAdmin::class . ':role')->name('admin.makeTeamleader');
});

//Designation
Route::prefix('designation')->group(function() {
    Route::get('/', [DesignationController::class, 'index'])->middleware(CheckIsAdmin::class . ':role')->name('designation.list.all');
    Route::get('/create', [DesignationController::class, 'create'])->middleware(CheckIsAdmin::class . ':role')->name('designation.create');
    Route::post('/store', [DesignationController::class, 'store'])->middleware(CheckIsAdmin::class . ':role')->name('designation.store');
    Route::get('/edit/{id}', [DesignationController::class, 'edit'])->middleware(CheckIsAdmin::class . ':role')->name('designation.edit');
    Route::post('/update', [DesignationController::class, 'update'])->middleware(CheckIsAdmin::class . ':role')->name('designation.update');
    Route::get('/status/{id}', [DesignationController::class, 'status'])->middleware(CheckIsAdmin::class . ':role')->name('designation.status'); 
    Route::get('/delete/{id}', [DesignationController::class, 'delete'])->middleware(CheckIsAdmin::class . ':role')->name('designation.delete');
});
//User chat routes
Route::middleware(['auth'])->group(function () {
    Route::get('users/chat/{userId}', [UserController::class, 'index'])->name('users.chat');
    Route::post('users/chat/send/{userId}', [UserController::class, 'sendMessage'])->name('users.chat.send');
});

//Update Profile
Route::middleware(['auth'])->group(function (){
    Route::get('profile/',[ProfileController::class, 'view'])->name('profile.view');
    Route::get('profile/edit',[ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update',[ProfileController::class, 'update'])->name('profile.update');
});

//create team member
Route::middleware(['auth'])->group(function (){
    Route::get('/team/create', [TeamController::class, 'create'])->name('team.create');
    Route::post('/team/store', [TeamController::class, 'store'])->name('team.store');
    Route::get('/team/view', [TeamController::class, 'view'])->name('team.view');
});

//products
Route::middleware(['auth'])->group(function (){
    Route::get('/product/view/{id}', [ProductController::class, 'view'])->name('product.view');
    Route::get('/product/getProductPrice/{id}', [ProductController::class, 'getProductPrice'])->name('product.price');
    Route::post('/product/invoice', [ProductController::class, 'pdfGenerate'])->name('product.invoice');
    Route::post('/product/submit', [ProductController::class, 'submit'])->name('product.submit');
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
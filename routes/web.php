<?php

use Illuminate\Support\Facades\Route;

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
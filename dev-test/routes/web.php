<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Htpp\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', function(){
    return view ('register');
});

Route::get('login', function() {
    return view('login');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/home', [UserController::class,'home']);
Route::post('/task', [TaskController::class, 'task']);
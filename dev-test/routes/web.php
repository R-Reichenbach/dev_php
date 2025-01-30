<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('login');
});

Route::get('register', function(){
    return view ('register');
})->name('login');

Route::get('login', function() {
    return view('login');
});


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login'); 
})->name('logout');



Route::middleware(['auth'])->group(function () {

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    

    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    

    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    

    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    

    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/home', function () {
        return redirect()->route('tasks.index');
    })->name('home');
});
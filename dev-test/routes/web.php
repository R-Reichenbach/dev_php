<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
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

Route::get('index', function() {
    return view('index');
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
Route::post('/tasks', [TaskController::class, 'task'])->name('tasks');
Route::post('/index', [TaskController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    // Rota para listar as tarefas do usuário
    Route::get('/task', [TaskController::class, 'index'])->name('index');

    // Rota para criar uma nova tarefa
    Route::post('/task', [TaskController::class, 'task'])->name('task');
}); 

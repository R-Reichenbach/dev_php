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
});

Route::get('login', function() {
    return view('login');
});

// Rotas públicas
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login'); // Altere para a página que deseja
})->name('logout');

// Rotas protegidas para tarefas
Route::middleware(['auth'])->group(function () {
    // Lista todas as tarefas
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    
    // Mostra formulário de criação
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    
    // Salva nova tarefa
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    
    // Mostra formulário de edição
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    
    // Atualiza tarefa
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    
    // Exclui tarefa
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/home', function () {
        return redirect()->route('tasks.index');
    })->name('home');
});
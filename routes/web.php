<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;

// Redirecionamento
Route::redirect('/', '/tasks')->name('home');

// Autenticação
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Tarefas do usuário logado
Route::resource('tasks', TaskController::class)
    ->except(['show'])
    ->middleware('auth');

// Rotas do admin protegidas por middleware 'auth' e 'admin'
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
   Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');


    // Listar todas as tarefas para o admin
    Route::get('tasks', [AdminTaskController::class, 'index'])->name('tasks.index');
});

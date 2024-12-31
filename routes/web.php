<?php

use Illuminate\Support\Facades\Route;

// routes/web.php (Projeto 1)
use App\Http\Controllers\UsuarioController;

// Rota para visualizar todos os usuários
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

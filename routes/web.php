<?php

use Illuminate\Support\Facades\Route;

// routes/web.php (Projeto 1)
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UploadController;

// Rota para visualizar todos os usuários
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

// Rota para o formulário de upload
Route::get('/upload', [UploadController::class, 'index'])->name('upload.index');
Route::post('/upload', [UploadController::class, 'uploadArquivo'])->name('upload.arquivo');

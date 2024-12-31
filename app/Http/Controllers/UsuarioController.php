<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();  // Pega todos os usuários no banco de dados
        return view('usuarios.index', compact('usuarios'));
    }
}

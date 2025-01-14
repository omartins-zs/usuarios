<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function uploadArquivo(Request $request)
    {
        // Log para verificar se o arquivo foi enviado corretamente
        if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
            Log::info('Arquivo enviado', ['nome_original' => $request->file('arquivo')->getClientOriginalName()]);
        } else {
            Log::error('Arquivo não enviado ou inválido.');
            return redirect()->route('usuarios.index')->with('error', 'Arquivo não enviado ou inválido.');
        }

        // Obtendo o arquivo e preparando a requisição
        $file = $request->file('arquivo');
        $tabela = $request->input('tabela');

        Log::info('Iniciando envio do arquivo para o projeto 2', [
            'arquivo' => $file->getClientOriginalName(),
            'tamanho' => $file->getSize()
        ]);

        // Enviando o arquivo para o projeto 2
        $response = Http::attach('arquivo', file_get_contents($file), 'arquivo.' . $file->getClientOriginalExtension())
                        ->post('http://127.0.0.1:8002/api/importar-arquivo');

        Log::debug('Dados recebidos', ['request_data' => $request->all()]);

        // Verificando a resposta da API do projeto 2
        if ($response->successful()) {
            Log::info('Arquivo importado com sucesso', ['response' => $response->body()]);
            return redirect()->route('usuarios.index')->with('success', 'Arquivo importado com sucesso!');
        } else {
            Log::error('Erro ao importar arquivo', ['response' => $response->body(), 'status_code' => $response->status()]);
            return redirect()->route('usuarios.index')->with('error', 'Falha ao importar o arquivo.');
        }
    }
}

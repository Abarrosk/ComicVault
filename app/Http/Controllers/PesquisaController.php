<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Issue;
use Illuminate\Http\Request;

class PesquisaController extends Controller
{
    public function resultados(Request $request)
    {
        // Validar os dados recebidos da navbar
        $request->validate([
            'pesquisa' => 'required|string|max:255',
            'campo' => 'required|in:nome,numero,isbn',
        ]);

        // Obter o texto e o tipo de pesquisa
        $pesquisa = trim($request->input('pesquisa'));
        $campo = $request->input('campo');

        // Permite encontrar correspondências parciais
        $termo = '%' . $pesquisa . '%';

        if ($campo == 'nome') {

            // Procurar pelo título dos comics
            $comics = Comic::where('titulo', 'like', $termo)
                ->get();

            // Procurar pelo nome da série OU título da issue
            $issues = Issue::where('nome_serie', 'like', $termo)
                ->orWhere('titulo', 'like', $termo)
                ->get();

        } elseif ($campo == 'numero') {

            // Procurar pelo número dos comics
            $comics = Comic::where('numero', 'like', $termo)
                ->get();

            // Procurar pelo número das issues
            $issues = Issue::where('numero_edicao', 'like', $termo)
                ->get();

        } else {

            // Procurar pelo ISBN dos comics
            $comics = Comic::where('isbn', 'like', $termo)
                ->get();

            // Procurar pelo ISBN das issues
            $issues = Issue::where('isbn', 'like', $termo)
                ->get();
        }

        return view('pesquisa.resultados',
            compact('comics', 'issues', 'pesquisa', 'campo'));
    }
}

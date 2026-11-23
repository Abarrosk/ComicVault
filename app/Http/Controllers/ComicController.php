<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ComicController extends Controller
{
    // Obter todos os comics
    protected function getAllComics()
    {
        $comics = Comic::all();

        foreach ($comics as $comic) {
            $comic->numero_issues = Issue::where('id_comic', $comic->id)
                ->count();
        }

        return $comics;
    }

    // Listar todos os comics e apresentar um comic selecionado
    public function allComics(?int $id = null)
    {
        $comics = $this->getAllComics();

        $comicInfo = null;
        $issuesComic = null;

        if ($id !== null) {
            $comicInfo = Comic::where('id', $id)->firstOrFail();

            $issuesComic = Issue::where('id_comic', $id)->get();
        }

        return view('comics.allComics',
            compact('comics', 'comicInfo', 'issuesComic'));
    }


public function addComics()
{
    if (Auth::user()->tipo_utilizador != 1) {
        abort(403);
    }

    $quantidadeIssues = (int) old('quantidade_issues', 0);

    return view('comics.addComics', compact('quantidadeIssues'));
}


public function storeComic(Request $request)
{
    if (Auth::user()->tipo_utilizador != 1) {
        abort(403);
    }

    // Se carregámos no botão + Adicionar Issue
    if ($request->input('acao') === 'adicionar_issue') {

        $quantidadeIssues = (int) $request->input('quantidade_issues', 0);

        // Acrescentar uma issue, até ao limite de 100
        $quantidadeIssues = min(max($quantidadeIssues, 0) + 1, 100);

        // Preservar os dados já preenchidos
       $dados = $request->input();
        $dados['quantidade_issues'] = $quantidadeIssues;

        return redirect()
            ->route('comics.add')
            ->withInput($dados);
    }

    // Validar os dados antes de guardar
    $request->validate([
        'titulo' => 'required|string|max:255',
        'editor' => 'required|string|max:100',
        'isbn' => 'nullable|string|max:20|unique:comics,isbn',
        'formato' => 'nullable|string|max:50',
        'descricao' => 'nullable|string',
        'capa' => 'nullable|image|max:2048',
        'quantidade_issues' => 'required|integer|min:0|max:100',

        'issues' => 'nullable|array',
        'issues.*.nome_serie' => 'required|string|max:255',
        'issues.*.numero_edicao' => 'required|string|max:20',
        'issues.*.titulo' => 'nullable|string|max:255',
        'issues.*.data_publicacao' => 'nullable|date',
        'issues.*.capa' => 'nullable|image|max:2048',
    ]);

    // Guardar a capa do comic
    $caminhoCapa = null;

    if ($request->hasFile('capa')) {
        $caminhoCapa = Storage::disk('public')
            ->putFile('comics', $request->file('capa'));
    }

    // Criar o comic
    $comic = Comic::create([
        'titulo' => $request->titulo,
        'editor' => $request->editor,
        'isbn' => $request->isbn,
        'formato' => $request->formato,
        'descricao' => $request->descricao,
        'caminho_capa' => $caminhoCapa,
    ]);

    // Criar as issues associadas ao comic
    foreach ($request->input('issues', []) as $indice => $dadosIssue) {

        $caminhoCapaIssue = null;

        if ($request->hasFile("issues.$indice.capa")) {
            $caminhoCapaIssue = Storage::disk('public')
                ->putFile(
                    'issues',
                    $request->file("issues.$indice.capa")
                );
        }

        Issue::create([
            'id_comic' => $comic->id,
            'nome_serie' => $dadosIssue['nome_serie'],
            'numero_edicao' => $dadosIssue['numero_edicao'],
            'titulo' => $dadosIssue['titulo'] ?? null,
            'data_publicacao' => $dadosIssue['data_publicacao'] ?: null,
            'caminho_capa' => $caminhoCapaIssue,
        ]);
    }

    return redirect()
        ->route('comics.show', $comic->id)
        ->with('message', 'Comic e issues adicionados com sucesso!');
}

}

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
        'numero' => 'nullable|string|max:20',
        'issues.*.isbn' => 'nullable|string|max:20',
        'issues' => 'nullable|array',
        'issues.*.nome_serie' => 'required|string|max:255',
        'issues.*.numero_edicao' => 'required|string|max:20',
        'issues.*.titulo' => 'nullable|string|max:255',
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
        'numero' => $request->numero,

    ]);

    // Criar as issues associadas ao comic
    foreach ($request->input('issues', []) as $indice => $dadosIssue) {
        Issue::create([
            'id_comic' => $comic->id,
            'nome_serie' => $dadosIssue['nome_serie'],
            'numero_edicao' => $dadosIssue['numero_edicao'],
            'titulo' => $dadosIssue['titulo'] ?? null,
            'isbn' => $dadosIssue['isbn'] ?? null,
        ]);
    }
    return redirect()
        ->route('comics.show', $comic->id)
        ->with('message', 'Comic e issues adicionados com sucesso!');
}

 // Apresentar formulário de edição
public function editComic(int $id)
{
    $comic = Comic::where('id', $id)->firstOrFail();

    $issuesComic = Issue::where('id_comic', $id)->get();

    return view('comics.editComics',
        compact('comic', 'issuesComic'));
}


 // Atualizar Comic e respetivas Issues
public function updateComic(Request $request, int $id)
{
    $comic = Comic::where('id', $id)->firstOrFail();

    // Validar dados recebidos
    $request->validate([
        'titulo' => 'required|string|max:255',
        'numero' => 'nullable|string|max:20',
        'editor' => 'required|string|max:100',
        'isbn' => 'nullable|string|max:20|unique:comics,isbn,' . $comic->id,
        'formato' => 'nullable|string|max:50',
        'descricao' => 'nullable|string',
        'capa' => 'nullable|image|max:2048',

        'issues' => 'nullable|array',
        'issues.*.nome_serie' => 'required|string|max:255',
        'issues.*.numero_edicao' => 'required|string|max:20',
        'issues.*.isbn' => 'nullable|string|max:20',
        'issues.*.titulo' => 'nullable|string|max:255',
    ]);

    // Manter a capa anterior se não for enviada outra
    $caminhoCapa = $comic->caminho_capa;
    $caminhoAntigo = $comic->caminho_capa;
    $novaCapa = false;

    if ($request->hasFile('capa')) {

        $caminhoCapa = Storage::disk('public')
            ->putFile('comics', $request->file('capa'));

        $novaCapa = true;
    }

    // Atualizar os dados do comic
    $comic->update([
        'titulo' => $request->titulo,
        'numero' => $request->numero,
        'editor' => $request->editor,
        'isbn' => $request->isbn,
        'formato' => $request->formato,
        'descricao' => $request->descricao,
        'caminho_capa' => $caminhoCapa,
    ]);

    // Atualizar as issues já associadas ao comic
    $issuesComic = Issue::where('id_comic', $comic->id)->get();

    foreach ($issuesComic as $issue) {

        $dadosIssue = $request->input('issues.' . $issue->id);

        if ($dadosIssue !== null) {

            $issue->update([
                'nome_serie' => $dadosIssue['nome_serie'],
                'numero_edicao' => $dadosIssue['numero_edicao'],
                'isbn' => $dadosIssue['isbn'] ?? null,
                'titulo' => $dadosIssue['titulo'] ?? null,
            ]);
        }
    }

    // Remover a capa antiga do armazenamento local, se foi substituída
    if ($novaCapa && $caminhoAntigo &&
        !str_starts_with($caminhoAntigo, 'http')) {

        Storage::disk('public')->delete($caminhoAntigo);
    }

    return redirect()
        ->route('comics.show', $comic->id)
        ->with('message', 'Comic atualizado com sucesso!');
}

 // Apresentar confirmação de eliminação
public function confirmarEliminarComic(int $id)
{
    // Apenas administradores
    if (Auth::user()->tipo_utilizador != 1) {
        abort(403);
    }

    $comic = Comic::where('id', $id)->firstOrFail();

    $numeroIssues = Issue::where('id_comic', $id)->count();

    return view('comics.confirmarEliminarComic',
        compact('comic', 'numeroIssues'));
}



 // Eliminar Comic
public function deleteComic(int $id)
{
    // Apenas administradores
    if (Auth::user()->tipo_utilizador != 1) {
        abort(403);
    }

    $comic = Comic::where('id', $id)->firstOrFail();

    $caminhoCapa = $comic->caminho_capa;

    // Eliminar o comic da base de dados
    $comic->delete();

    // Eliminar a capa guardada localmente
    if ($caminhoCapa &&
        !str_starts_with($caminhoCapa, 'http')) {

        Storage::disk('public')->delete($caminhoCapa);
    }

    return redirect()
        ->route('comics.all')
        ->with('message', 'Comic eliminado com sucesso!');
}




























}

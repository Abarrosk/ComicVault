<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Comic;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    // Obter todas as issues
    protected function getAllIssues()
    {
        $issues = Issue::join(
            'comics',
            'issues.id_comic',
            '=',
            'comics.id'
        )
        ->select(
            'issues.id',
            'issues.id_comic',
            'issues.nome_serie',
            'issues.numero_edicao',
            'issues.titulo',
            'issues.data_publicacao',
            'issues.caminho_capa',
            'comics.titulo as titulo_comic',
            'issues.isbn'
        )
        ->get();

        return $issues;
    }

    // Listar todas as issues e apresentar uma selecionada
    public function allIssues(?int $id = null)
    {
        $issues = $this->getAllIssues();

        $issueInfo = null;

        if ($id !== null) {
            $issueInfo = Issue::join(
                'comics',
                'issues.id_comic',
                '=',
                'comics.id'
            )
            ->where('issues.id', $id)
            ->select(
                'issues.id',
                'issues.id_comic',
                'issues.nome_serie',
                'issues.numero_edicao',
                'issues.titulo',
                'issues.data_publicacao',
                'issues.caminho_capa',
                'comics.titulo as titulo_comic',
                'issues.isbn'
            )
            ->firstOrFail();
        }

        return view('issues.allIssues',
            compact('issues', 'issueInfo'));
    }

    // Apresentar confirmação de eliminação de uma issue
public function confirmarEliminarIssue(int $id)
{
    if (Auth::user()->tipo_utilizador != 1) {
        abort(403);
    }

    $issue = Issue::where('id', $id)->firstOrFail();

    return view('issues.confirmarEliminarIssue', compact('issue'));
}

// Eliminar apenas a issue selecionada
public function deleteIssue(int $id)
{
    if (Auth::user()->tipo_utilizador != 1) {
        abort(403);
    }

    $issue = Issue::where('id', $id)->firstOrFail();

    $caminhoCapa = $issue->caminho_capa;

    $issue->delete();

    // Eliminar a capa associada, caso exista
    if ($caminhoCapa && !str_starts_with($caminhoCapa, 'http')) {
        Storage::disk('public')->delete($caminhoCapa);
    }

    return redirect()
        ->route('issues.all')
        ->with('message', 'Issue eliminada com sucesso!');
}


    // Formulário para adicionar uma issue
    public function addIssue()
    {
        if (Auth::user()->tipo_utilizador != 1) {
            abort(403);
        }

        $comics = Comic::orderBy('titulo')->get();

        return view('issues.addIssues', compact('comics'));
    }

    // Guardar uma nova issue
    public function storeIssue(Request $request)
    {
        if (Auth::user()->tipo_utilizador != 1) {
            abort(403);
        }

        $request->validate([
            'id_comic' => 'required|exists:comics,id',
            'nome_serie' => 'required|string|max:255',
            'numero_edicao' => 'required|string|max:20',
            'titulo' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'data_publicacao' => 'nullable|date',
            'capa' => 'nullable|image|max:2048',
        ]);

        $caminhoCapa = null;

        if ($request->hasFile('capa')) {
            $caminhoCapa = Storage::disk('public')
                ->putFile('issues', $request->file('capa'));
        }

        $issue = Issue::create([
            'id_comic' => $request->id_comic,
            'nome_serie' => $request->nome_serie,
            'numero_edicao' => $request->numero_edicao,
            'titulo' => $request->titulo,
            'isbn' => $request->isbn,
            'data_publicacao' => $request->data_publicacao,
            'caminho_capa' => $caminhoCapa,
        ]);

        return redirect()
            ->route('issues.show', $issue->id)
            ->with('message', 'Issue adicionada com sucesso!');
    }

    // Formulário para editar uma issue
    public function editIssue(int $id)
    {
        $issue = Issue::where('id', $id)->firstOrFail();

        $comic = Comic::where('id', $issue->id_comic)->firstOrFail();

        return view('issues.editIssues', compact('issue', 'comic'));
    }

    // Atualizar uma issue existente
    public function updateIssue(Request $request, int $id)
    {
        $issue = Issue::where('id', $id)->firstOrFail();

        $request->validate([
            'nome_serie' => 'required|string|max:255',
            'numero_edicao' => 'required|string|max:20',
            'titulo' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'data_publicacao' => 'nullable|date',
            'capa' => 'nullable|image|max:2048',
        ]);

        $caminhoAntigo = $issue->caminho_capa;
        $caminhoNovo = $caminhoAntigo;

        if ($request->hasFile('capa')) {
            $caminhoNovo = Storage::disk('public')
                ->putFile('issues', $request->file('capa'));
        }

        $issue->update([
            'nome_serie' => $request->nome_serie,
            'numero_edicao' => $request->numero_edicao,
            'titulo' => $request->titulo,
            'isbn' => $request->isbn,
            'data_publicacao' => $request->data_publicacao,
            'caminho_capa' => $caminhoNovo,
        ]);

        if ($caminhoAntigo &&
            $caminhoNovo !== $caminhoAntigo &&
            !str_starts_with($caminhoAntigo, 'http')) {

            Storage::disk('public')->delete($caminhoAntigo);
        }

        return redirect()
            ->route('issues.show', $issue->id)
            ->with('message', 'Issue atualizada com sucesso!');
    }

}

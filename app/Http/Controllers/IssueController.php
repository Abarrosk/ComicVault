<?php

namespace App\Http\Controllers;

use App\Models\Issue;

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
            'comics.titulo as titulo_comic'
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
                'comics.titulo as titulo_comic'
            )
            ->firstOrFail();
        }

        return view('issues.allIssues',
            compact('issues', 'issueInfo'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id_comic', 'nome_serie', 'numero_edicao', 'titulo', 'data_publicacao', 'caminho_capa'])]
class Issue extends Model
{
}

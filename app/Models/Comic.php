<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['titulo', 'numero', 'editor', 'isbn', 'formato', 'caminho_capa', 'descricao'])]
class Comic extends Model
{
}

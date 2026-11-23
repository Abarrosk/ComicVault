<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['titulo', 'editor', 'isbn', 'formato', 'caminho_capa', 'descricao'])]
class Comic extends Model
{
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = [ 'clientes_id', 'assunto', 'descricao', 'prioridade', 'status'];
}

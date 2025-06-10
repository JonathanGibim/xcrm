<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = [ 'clientes_id', 'assunto', 'descricao', 'prioridade', 'status'];

    public function respostas()
    {
        return $this->hasMany(ChamadoResposta::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }
}
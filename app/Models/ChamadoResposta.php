<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChamadoResposta extends Model
{
    protected $fillable = ['chamado_id', 'mensagem', 'autor'];

    public function chamado()
    {
        return $this->belongsTo(Chamado::class);
    }
}

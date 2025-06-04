<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome', 'email', 'telefone', 'cpf', 'cep', 'estado', 'cidade', 'endereco', 'numero', 'complemento'];
}

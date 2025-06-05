<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    protected $table = 'clientes';
    protected $fillable = ['nome', 'email', 'password', 'telefone', 'cpf', 'cep', 'estado', 'cidade', 'endereco', 'numero', 'complemento'];
    protected $hidden = ['password'];

}

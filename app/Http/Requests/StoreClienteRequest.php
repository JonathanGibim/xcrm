<?php

namespace App\Http\Requests;

use App\Rules\CpfValido;
use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer essa requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtém as regras de validação aplicáveis à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
    return [
        'nome' => 'required|string|min:3|max:255',
        'email' => 'required|email|unique:clientes,email',
        'password' => 'required|string|min:6|confirmed',
        'telefone' => 'required|string|max:20',
        'cpf' => ['required','string','max:14','unique:clientes,cpf', new CpfValido],
        'cep' => 'required|string|max:9',
        'estado' => 'required|string|max:2',
        'cidade' => 'required|string|max:255',
        'endereco' => 'required|string|max:255',
        'numero' => 'required|string|max:10',
        'complemento' => 'nullable|string|max:255',
    ];
    }
}

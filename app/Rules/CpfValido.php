<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CpfValido implements Rule
{
    public function passes($attribute, $value)
    {
        // Remove tudo que não for número
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Verifica se tem 11 dígitos ou se todos os dígitos são iguais
        if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        // Valida os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $soma = 0;
            for ($i = 0; $i < $t; $i++) {
                $soma += $cpf[$i] * (($t + 1) - $i);
            }

            $digito = (10 * $soma) % 11;
            $digito = $digito == 10 ? 0 : $digito;

            if ($cpf[$t] != $digito) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'O :attribute informado não é um CPF válido.';
    }
}

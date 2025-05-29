<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string(column: 'telefone');
            $table->string(column: 'cpf');
            $table->string(column: 'cep');
            $table->string(column: 'estado');
            $table->string(column: 'cidade');
            $table->string(column: 'endereco');
            $table->string(column: 'numero');
            $table->string(column: 'complemento');
            $table->text(column: 'observacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

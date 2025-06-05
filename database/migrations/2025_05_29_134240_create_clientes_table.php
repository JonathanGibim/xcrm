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
            $table->string('nome', 255);
            $table->string('email',255)->unique();
            $table->string('password', 255);
            $table->string('telefone',15);
            $table->string('cpf', 14)->unique();
            $table->string('cep', 9);
            $table->string('estado', 255);
            $table->string('cidade', 255);
            $table->string('endereco', 255);
            $table->string('numero', 10);
            $table->string('complemento', 255)->nullable();
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

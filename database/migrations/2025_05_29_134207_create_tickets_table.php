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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clientes_id')->constrained()->onDelete('cascade');
            $table->text('assunto');
            $table->longText(column: 'descricao');
            $table->enum('prioridade', ['baixa', 'media', 'alta']);
            $table->enum('status', ['aberto', 'respondendo', 'fechado']);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

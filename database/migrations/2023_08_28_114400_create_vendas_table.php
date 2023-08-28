<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // tabela vendas
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_da_venda');
            // chave estrangeira 'produto_id' da tabela 'produtos'
            // onde 'foreignId(...)' informa que é uma chave estrangeira
            // e 'constrained(...)' refere-se que é uma campo vindo da tabela produtos.
            $table->foreignId('produto_id')->constrained('produtos');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};

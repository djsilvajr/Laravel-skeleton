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
        Schema::create('clothing_variant_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')
                  ->unique() // 1:1 com product_variants
                  ->constrained('product_variants')
                  ->onDelete('cascade');
            
            // Atributos principais (INDEXADOS para filtros)
            $table->string('size')->index(); // P, M, G, GG, 38, 40, 42, 44
            $table->string('color')->index(); // Azul, Preto, Branco, Vermelho
            $table->string('color_hex', 7)->nullable(); // #0000FF (para exibir cor)
            
            // Detalhes da roupa
            $table->string('pattern')->nullable()->index(); // Lisa, Listrada, Estampada, Xadrez
            $table->string('fit')->nullable(); // Slim, Regular, Oversized, Loose
            $table->string('neck_type')->nullable(); // Gola V, Redonda, Polo, Alta
            $table->string('sleeve_length')->nullable(); // Manga Curta, Longa, 3/4, Regata
            $table->string('length')->nullable(); // Curto, Médio, Longo (para vestidos/saias)
            $table->string('rise')->nullable(); // Cintura Alta, Média, Baixa (para calças)
            $table->string('closure')->nullable(); // Zíper, Botão, Elástico
            
            // Gênero
            $table->enum('gender', ['Masculino', 'Feminino', 'Unissex'])->nullable();
            
            // Material principal (pode ser múltiplos no JSON do produto)
            $table->string('main_material')->nullable(); // Algodão, Poliéster, Jeans
            
            $table->timestamps();
            
            $table->index(['size', 'color']); // filtro combinado mais comum
            $table->index(['color', 'pattern']);
            $table->index('gender');
            $table->index('main_material');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clothing_variant_attributes');
    }
};
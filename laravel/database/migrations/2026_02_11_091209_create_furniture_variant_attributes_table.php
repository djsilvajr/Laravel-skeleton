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
        Schema::create('furniture_variant_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')
                  ->unique()
                  ->constrained('product_variants')
                  ->onDelete('cascade');
            
            // Cor e acabamento
            $table->string('color')->nullable()->index(); // Marrom, Branco, Preto, Madeira
            $table->string('color_hex', 7)->nullable(); // #8B4513
            
            // Material (INDEXADO para filtros)
            $table->string('material'); // Madeira Maciça, MDF, MDP, Metal, Vidro
            $table->string('wood_type')->nullable(); // Pinus, Carvalho, Eucalipto
            $table->string('finish')->nullable(); // Laqueado, Envernizado, Natural, Fosco
            
            // Dimensões específicas (em cm)
            $table->decimal('width', 8, 2)->nullable(); // largura
            $table->decimal('height', 8, 2)->nullable(); // altura
            $table->decimal('depth', 8, 2)->nullable(); // profundidade
            $table->decimal('seat_height', 8, 2)->nullable(); // altura do assento
            
            // Capacidade
            $table->integer('seats')->nullable(); // 2, 3, 4, 5 lugares (sofás/mesas)
            $table->integer('drawers')->nullable(); // número de gavetas
            $table->integer('shelves')->nullable(); // número de prateleiras
            $table->integer('doors')->nullable(); // número de portas
            $table->decimal('max_weight', 8, 2)->nullable(); // peso máximo suportado (kg)
            
            // Características
            $table->boolean('assembly_required')->default(false); // precisa montagem?
            $table->boolean('has_cushions')->default(false);
            $table->boolean('is_modular')->default(false);
            $table->boolean('is_reclining')->default(false); // reclinável?
            $table->boolean('has_wheels')->default(false);
            
            // Estilo
            $table->string('style')->nullable()->index(); // Moderno, Clássico, Industrial, Rústico
            $table->string('room')->nullable(); // Sala, Quarto, Cozinha, Escritório
            
            $table->timestamps();
            
            $table->index('material');
            $table->index(['color', 'material']);
            $table->index(['material', 'style']);
            $table->index('seats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture_variant_attributes');
    }
};
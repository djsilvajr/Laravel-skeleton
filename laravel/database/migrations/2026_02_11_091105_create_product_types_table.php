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
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ex: "Camisas", "Notebooks", "Sofás"
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            
            // Categorias aninhadas (hierarquia)
            $table->foreignId('parent_id')->nullable()
                  ->constrained('product_types')
                  ->onDelete('cascade');
            
            // Define qual tipo de variante os produtos desta categoria usarão
            $table->enum('variant_type', [
                'clothing',      // Roupas/Calçados
                'electronics',   // Eletrônicos
                'furniture',     // Móveis
                'books',         // Livros (sem variantes)
                'simple'         // Produtos simples (sem variantes)
            ])->nullable(); // Null = categoria pai sem produtos diretos
            
            $table->integer('order')->default(0);
            $table->string('icon')->nullable(); // ícone da categoria
            $table->string('image_url')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('parent_id');
            $table->index('slug');
            $table->index('variant_type');
            $table->index(['active', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_types');
    }
};
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_type_id')
                  ->constrained('product_types')
                  ->onDelete('cascade');
            
            // Identificação
            $table->string('name');
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            
            // Atributos genéricos/descritivos (não críticos para filtros)
            $table->json('attributes')->nullable();
            // Ex: {"care_instructions": "Lavar à mão", "origin": "Brasil"}
            
            // Peso e dimensões médias
            $table->decimal('avg_weight', 8, 2)->nullable(); // kg
            $table->json('avg_dimensions')->nullable(); // cm
            
            // Estoque total (soma das variantes)
            $table->integer('total_stock')->default(0);
            $table->integer('min_stock')->default(0);
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            
            // Status e flags
            $table->boolean('active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('has_variants')->default(true); // false para livros/simples
            $table->timestamp('available_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('product_type_id');
            $table->index('sku');
            $table->index('brand');
            $table->index(['active', 'is_featured']);
            $table->index(['active', 'product_type_id']);
            $table->index('available_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
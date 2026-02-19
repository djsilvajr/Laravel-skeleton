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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
            
            // Identificação
            $table->string('sku')->unique();
            $table->string('name')->nullable(); // Ex: "Azul - M", "16GB/512GB"
            $table->string('barcode')->nullable()->unique(); // EAN/UPC
            
            // 🎯 POLIMORFISMO - Define qual tabela de atributos usar
            $table->enum('variant_type', [
                'clothing',
                'electronics',
                'furniture',
                'simple'
            ]);
            
            // Preço específico da variante
            $table->decimal('price_adjustment', 10, 2)->default(0);
            // Preço final = base_price + price_adjustment
            
            // Estoque específico da variante
            $table->integer('stock')->default(0);
            $table->integer('reserved_stock')->default(0); // em carrinhos
            $table->integer('min_stock')->default(0);
            
            // Peso e dimensões específicos (podem variar por tamanho)
            $table->decimal('weight', 8, 2)->nullable(); // kg
            $table->json('dimensions')->nullable(); // {altura, largura, profundidade} cm
            
            // Imagem principal da variante
            $table->string('image_url')->nullable();
            
            // Ordenação (qual mostrar primeiro)
            $table->integer('order')->default(0);
            
            // Status
            $table->boolean('active')->default(true);
            $table->boolean('is_default')->default(false); // variante padrão
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('product_id');
            $table->index('sku');
            $table->index('barcode');
            $table->index('variant_type');
            $table->index(['product_id', 'variant_type']);
            $table->index(['product_id', 'active']);
            $table->index(['active', 'stock']);
            $table->index(['product_id', 'is_default']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
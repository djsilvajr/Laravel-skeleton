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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
            $table->foreignId('product_variant_id')->nullable()
                  ->constrained('product_variants')
                  ->onDelete('cascade'); // imagem específica de uma variante
            
            // URLs das imagens (tamanhos diferentes)
            $table->string('url'); // URL original
            $table->string('thumbnail_url')->nullable(); // 150x150
            $table->string('small_url')->nullable(); // 300x300
            $table->string('medium_url')->nullable(); // 600x600
            $table->string('large_url')->nullable(); // 1200x1200
            
            // Metadados
            $table->string('alt_text')->nullable(); // SEO/acessibilidade
            $table->string('title')->nullable();
            $table->enum('type', [
                'main',      // imagem principal
                'gallery',   // galeria
                'variant',   // específica de variante
                'detail',    // detalhe do produto
                'lifestyle', // foto de uso
                'size_chart' // tabela de medidas
            ])->default('gallery');
            
            // Ordenação
            $table->integer('order')->default(0);
            
            // Dimensões originais
            $table->integer('width')->nullable(); // px
            $table->integer('height')->nullable(); // px
            $table->integer('file_size')->nullable(); // bytes
            $table->string('mime_type')->nullable(); // image/jpeg, image/png
            
            // Status
            $table->boolean('active')->default(true);
            $table->boolean('is_primary')->default(false); // imagem principal
            
            $table->timestamps();
            
            $table->index('product_id');
            $table->index('product_variant_id');
            $table->index(['product_id', 'order']);
            $table->index(['product_id', 'is_primary']);
            $table->index(['product_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
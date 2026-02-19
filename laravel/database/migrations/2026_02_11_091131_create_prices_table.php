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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                  ->unique() // 1:1 com produto
                  ->constrained('products')
                  ->onDelete('cascade');
            
            // Preços base (variantes podem ter ajustes)
            $table->decimal('base_price', 10, 2);
            $table->decimal('cost_price', 10, 2)->nullable();
            $table->decimal('profit_margin', 5, 2)->nullable(); // %
            
            // Preço promocional
            $table->decimal('promotional_price', 10, 2)->nullable();
            $table->timestamp('promotional_starts_at')->nullable();
            $table->timestamp('promotional_ends_at')->nullable();
            
            // Preço de comparação ("De R$ X Por R$ Y")
            $table->decimal('compare_at_price', 10, 2)->nullable();
            
            // Multi-moeda
            $table->string('currency', 3)->default('BRL'); // ISO 4217
            
            // Impostos
            $table->decimal('tax_rate', 5, 2)->nullable(); // %
            
            $table->timestamps();
            
            $table->index('product_id');
            $table->index('promotional_ends_at');
            $table->index(['base_price', 'promotional_price']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
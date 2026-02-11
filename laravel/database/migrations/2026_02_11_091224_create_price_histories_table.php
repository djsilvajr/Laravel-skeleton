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
        Schema::create('price_histories', function (Blueprint $table) {
            $table->id();
            
            // Pode ser mudança no produto base OU na variante
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
            $table->foreignId('product_variant_id')->nullable()
                  ->constrained('product_variants')
                  ->onDelete('cascade');
            
            // Tipo de preço alterado
            $table->enum('price_type', [
                'base',                // preço base do produto
                'variant_adjustment',  // ajuste de variante
                'promotional',         // preço promocional
                'cost'                 // preço de custo
            ])->default('base');
            
            // Valores antes e depois
            $table->decimal('old_price', 10, 2);
            $table->decimal('new_price', 10, 2);
            $table->decimal('old_cost_price', 10, 2)->nullable();
            $table->decimal('new_cost_price', 10, 2)->nullable();
            $table->decimal('old_profit_margin', 5, 2)->nullable();
            $table->decimal('new_profit_margin', 5, 2)->nullable();
            
            // Diferença calculada
            $table->decimal('price_difference', 10, 2)->nullable(); // new - old
            $table->decimal('percentage_change', 5, 2)->nullable(); // %
            
            // Contexto da mudança
            $table->enum('change_type', [
                'manual',              // usuário alterou
                'automatic',           // sistema alterou
                'bulk',               // alteração em massa
                'promotional',        // início/fim de promoção
                'cost_adjustment',    // ajuste de custo
                'competitor',         // ajuste por concorrência
                'seasonal',           // sazonal
                'clearance'           // liquidação
            ])->default('manual');
            
            // Rastreabilidade
            $table->foreignId('user_id')->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->string('ip_address', 45)->nullable();
            $table->text('reason')->nullable();
            $table->json('metadata')->nullable(); // dados extras
            
            // Timing
            $table->timestamp('changed_at'); // quando mudou
            $table->timestamp('effective_at')->nullable(); // quando entra em vigor
            
            $table->timestamps();
            
            $table->index('product_id');
            $table->index('product_variant_id');
            $table->index('changed_at');
            $table->index(['product_id', 'changed_at']);
            $table->index('user_id');
            $table->index('change_type');
            $table->index('price_type');
            $table->index('effective_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_histories');
    }
};
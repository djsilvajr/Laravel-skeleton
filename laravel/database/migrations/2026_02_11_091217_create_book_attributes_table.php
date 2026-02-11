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
        Schema::create('book_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id') // ← Direto no PRODUTO, não na variante
                  ->unique() // 1:1
                  ->constrained('products')
                  ->onDelete('cascade');
            
            // Identificação do livro
            $table->string('isbn', 17)->unique()->nullable(); // ISBN-13
            $table->string('isbn10', 10)->nullable(); // ISBN-10 (antigo)
            
            // Autoria
            $table->string('author'); // autor principal
            $table->json('co_authors')->nullable(); // co-autores
            $table->string('translator')->nullable();
            $table->string('illustrator')->nullable();
            
            // Publicação
            $table->string('publisher')->nullable(); // editora
            $table->year('publication_year')->nullable()->index();
            $table->string('edition')->nullable(); // 1ª, 2ª, 3ª edição
            $table->integer('reprint')->nullable(); // reimpressão
            
            // Conteúdo
            $table->integer('pages')->nullable();
            $table->string('language')->default('Português')->index();
            $table->text('synopsis')->nullable(); // sinopse
            
            // Formato
            $table->enum('format', [
                'Capa Dura',
                'Capa Comum',
                'Brochura',
                'Espiral',
                'E-book',
                'Audiobook'
            ])->default('Capa Comum');
            
            // Dimensões físicas (cm)
            $table->decimal('width', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('thickness', 5, 2)->nullable();
            
            // Classificação
            $table->string('genre')->nullable(); // Ficção, Romance, Terror, etc
            $table->json('categories')->nullable(); // ["Literatura Brasileira", "Clássicos"]
            $table->string('age_rating')->nullable(); // Livre, +12, +14, +16, +18
            $table->boolean('is_bestseller')->default(false);
            
            // Prêmios
            $table->json('awards')->nullable(); // ["Prêmio Jabuti 2020", "Nobel"]
            
            $table->timestamps();
            
            $table->index('author');
            $table->index('publisher');
            $table->index('isbn');
            $table->index(['author', 'publication_year']);
            $table->index('genre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_attributes');
    }
};
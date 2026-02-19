<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // ==================== LIVRO 1: HARRY POTTER ====================
        
        $productId1 = DB::table('products')->insertGetId([
            'product_type_id' => 31, // Ficção
            'name' => 'Harry Potter e a Pedra Filosofal',
            'sku' => 'LIV-HP-PEDRA-001',
            'description' => 'Harry Potter é um garoto órfão que vive infeliz com seus tios. Até que, repentinamente, ele se vê transportado para um mundo mágico. Descubra o início da saga mais famosa da literatura mundial.',
            'short_description' => 'Primeiro livro da saga Harry Potter',
            'brand' => 'Rocco',
            'attributes' => json_encode([
                'capa' => 'Ilustrada',
                'tipo_papel' => 'Offset',
                'acabamento' => 'Cola',
                'selo' => 'Literatura Estrangeira'
            ]),
            'avg_weight' => 0.35,
            'avg_dimensions' => json_encode(['altura' => 20.8, 'largura' => 13.8, 'profundidade' => 1.5]),
            'total_stock' => 50,
            'min_stock' => 10,
            'meta_title' => 'Harry Potter e a Pedra Filosofal - J.K. Rowling',
            'active' => true,
            'is_featured' => true,
            'is_new' => false,
            'has_variants' => false, // ← SEM VARIANTES
            'available_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('prices')->insert([
            'product_id' => $productId1,
            'base_price' => 39.90,
            'cost_price' => 18.00,
            'profit_margin' => 121.67,
            'promotional_price' => 32.90,
            'promotional_starts_at' => $now,
            'promotional_ends_at' => $now->copy()->addDays(30),
            'currency' => 'BRL',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Atributos específicos de livro (direto no produto)
        DB::table('book_attributes')->insert([
            'product_id' => $productId1,
            'isbn' => '978-85-325-1102-8',
            'isbn10' => '8532511023',
            'author' => 'J.K. Rowling',
            'translator' => 'Lia Wyler',
            'publisher' => 'Rocco',
            'publication_year' => 2000,
            'edition' => '1ª Edição',
            'pages' => 264,
            'language' => 'Português',
            'synopsis' => 'Harry Potter vive com os tios e o primo, que não gostam dele. No dia de seu aniversário, ele descobre que é um bruxo e vai estudar em Hogwarts.',
            'format' => 'Capa Comum',
            'width' => 13.80,
            'height' => 20.80,
            'thickness' => 1.50,
            'genre' => 'Fantasia',
            'categories' => json_encode(['Literatura Estrangeira', 'Fantasia', 'Juvenil']),
            'age_rating' => 'Livre',
            'is_bestseller' => true,
            'awards' => json_encode(['British Book Award', 'Prêmio Nestlé Smarties']),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->command->info('✅ Livro 1: Harry Potter criado (sem variantes)');

        // ==================== LIVRO 2: CLEAN CODE ====================
        
        $productId2 = DB::table('products')->insertGetId([
            'product_type_id' => 32, // Técnicos
            'name' => 'Clean Code: Habilidades Práticas do Agile Software',
            'sku' => 'LIV-CLEAN-CODE-001',
            'description' => 'Mesmo um código ruim pode funcionar. Mas se ele não for limpo, pode acabar com uma empresa de desenvolvimento. O livro Clean Code está repleto de conselhos práticos para escrever código de qualidade.',
            'short_description' => 'Guia essencial para código limpo',
            'brand' => 'Alta Books',
            'attributes' => json_encode([
                'nivel' => 'Intermediário a Avançado',
                'tipo_papel' => 'Offset',
                'selo' => 'Programação'
            ]),
            'avg_weight' => 0.60,
            'avg_dimensions' => json_encode(['altura' => 23.0, 'largura' => 16.0, 'profundidade' => 2.5]),
            'total_stock' => 30,
            'min_stock' => 8,
            'meta_title' => 'Clean Code - Robert C. Martin',
            'active' => true,
            'is_featured' => true,
            'is_new' => true,
            'has_variants' => false,
            'available_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('prices')->insert([
            'product_id' => $productId2,
            'base_price' => 89.90,
            'cost_price' => 45.00,
            'profit_margin' => 99.78,
            'currency' => 'BRL',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('book_attributes')->insert([
            'product_id' => $productId2,
            'isbn' => '978-85-7608-967-8',
            'isbn10' => '8576089874',
            'author' => 'Robert C. Martin',
            'co_authors' => json_encode(['Martin Fowler', 'Kent Beck']),
            'publisher' => 'Alta Books',
            'publication_year' => 2009,
            'edition' => '1ª Edição',
            'pages' => 425,
            'language' => 'Português',
            'synopsis' => 'Este livro apresenta um paradigma revolucionário com as melhores práticas de Agile para escrever código limpo que funciona.',
            'format' => 'Capa Comum',
            'width' => 16.00,
            'height' => 23.00,
            'thickness' => 2.50,
            'genre' => 'Técnico',
            'categories' => json_encode(['Programação', 'Engenharia de Software', 'Desenvolvimento']),
            'age_rating' => 'Adulto',
            'is_bestseller' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->command->info('✅ Livro 2: Clean Code criado (sem variantes)');
    }
}
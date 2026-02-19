<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$now = Carbon::now();

        $images = [
            // Camisa Nike (produto 1)
            [
                'product_id' => 1,
                'url' => 'storage/products/camisa-nike-drifit-main.jpg',
                'thumbnail_url' => 'storage/products/thumbs/camisa-nike-drifit-main.jpg',
                'alt_text' => 'Camisa Nike Dri-FIT Masculina',
                'type' => 'main',
                'order' => 1,
                'is_primary' => true,
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 1,
                'url' => 'storage/products/camisa-nike-drifit-detail.jpg',
                'thumbnail_url' => 'storage/products/thumbs/camisa-nike-drifit-detail.jpg',
                'alt_text' => 'Detalhe da tecnologia Dri-FIT',
                'type' => 'detail',
                'order' => 2,
                'is_primary' => false,
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Notebook Dell (produto com ID maior, ajuste conforme necessário)
            [
                'product_id' => 3,
                'url' => 'storage/products/notebook-dell-inspiron-main.jpg',
                'thumbnail_url' => 'storage/products/thumbs/notebook-dell-inspiron-main.jpg',
                'alt_text' => 'Notebook Dell Inspiron 15',
                'type' => 'main',
                'order' => 1,
                'is_primary' => true,
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Harry Potter
            [
                'product_id' => 7,
                'url' => 'storage/products/harry-potter-pedra-filosofal.jpg',
                'thumbnail_url' => 'storage/products/thumbs/harry-potter-pedra-filosofal.jpg',
                'alt_text' => 'Capa Harry Potter e a Pedra Filosofal',
                'type' => 'main',
                'order' => 1,
                'is_primary' => true,
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('product_images')->insert($images);*/

        $this->command->info('✅ Imagens de produtos criadas');
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClothingProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // ==================== PRODUTO 1: CAMISA NIKE ====================
        
        // Produto base
        $productId1 = DB::table('products')->insertGetId([
            'product_type_id' => 3, // Camisas Esportivas
            'name' => 'Camisa Nike Dri-FIT Masculina',
            'sku' => 'CAM-NIKE-DRIFIT-001',
            'description' => 'Camisa esportiva Nike com tecnologia Dri-FIT que absorve o suor da pele e mantém você seco e confortável. Ideal para corrida, academia e esportes em geral.',
            'short_description' => 'Camisa esportiva com tecnologia Dri-FIT',
            'brand' => 'Nike',
            'model' => 'Dri-FIT Legend',
            'attributes' => json_encode([
                'material' => 'Poliéster 100%',
                'tecnologia' => 'Dri-FIT',
                'origem' => 'Importado',
                'cuidados' => 'Lavar à máquina em água fria'
            ]),
            'avg_weight' => 0.18, // kg
            'total_stock' => 0, // será calculado
            'min_stock' => 20,
            'meta_title' => 'Camisa Nike Dri-FIT - Tecnologia Esportiva',
            'active' => true,
            'is_featured' => true,
            'is_new' => true,
            'has_variants' => true,
            'available_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Preço
        DB::table('prices')->insert([
            'product_id' => $productId1,
            'base_price' => 129.90,
            'cost_price' => 65.00,
            'profit_margin' => 99.85,
            'promotional_price' => 99.90,
            'promotional_starts_at' => $now,
            'promotional_ends_at' => $now->copy()->addDays(15),
            'currency' => 'BRL',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Variantes: Azul M, Azul G, Preto M, Preto G
        $variants1 = [
            ['size' => 'M', 'color' => 'Azul', 'hex' => '#0047AB', 'stock' => 50],
            ['size' => 'G', 'color' => 'Azul', 'hex' => '#0047AB', 'stock' => 40],
            ['size' => 'M', 'color' => 'Preto', 'hex' => '#000000', 'stock' => 45],
            ['size' => 'G', 'color' => 'Preto', 'hex' => '#000000', 'stock' => 35],
        ];

        foreach ($variants1 as $index => $varData) {
            $variantId = DB::table('product_variants')->insertGetId([
                'product_id' => $productId1,
                'sku' => "CAM-NIKE-DRIFIT-001-{$varData['color']}-{$varData['size']}",
                'name' => "{$varData['color']} - {$varData['size']}",
                'variant_type' => 'clothing',
                'price_adjustment' => $varData['size'] === 'GG' ? 10.00 : 0,
                'stock' => $varData['stock'],
                'weight' => 0.18,
                'order' => $index,
                'active' => true,
                'is_default' => $index === 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // Atributos específicos de roupa
            DB::table('clothing_variant_attributes')->insert([
                'product_variant_id' => $variantId,
                'size' => $varData['size'],
                'color' => $varData['color'],
                'color_hex' => $varData['hex'],
                'pattern' => 'Lisa',
                'fit' => 'Regular',
                'neck_type' => 'Gola Redonda',
                'sleeve_length' => 'Manga Curta',
                'gender' => 'Masculino',
                'main_material' => 'Poliéster',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Produto 1: Camisa Nike criada com 4 variantes');

        // ==================== PRODUTO 2: CALÇA ADIDAS ====================
        
        $productId2 = DB::table('products')->insertGetId([
            'product_type_id' => 4, // Calças
            'name' => 'Calça Adidas Moletom Essentials',
            'sku' => 'CAL-ADIDAS-MOL-001',
            'description' => 'Calça de moletom Adidas da linha Essentials. Conforto máximo para o dia a dia com ajuste perfeito e bolsos frontais. Tecido macio e respirável.',
            'short_description' => 'Calça de moletom confortável para o dia a dia',
            'brand' => 'Adidas',
            'model' => 'Essentials',
            'attributes' => json_encode([
                'material' => 'Algodão 70%, Poliéster 30%',
                'tipo' => 'Moletom',
                'origem' => 'Nacional',
                'cuidados' => 'Lavar à máquina'
            ]),
            'avg_weight' => 0.45,
            'total_stock' => 0,
            'min_stock' => 15,
            'meta_title' => 'Calça Adidas Moletom - Conforto Essentials',
            'active' => true,
            'is_featured' => false,
            'is_new' => true,
            'has_variants' => true,
            'available_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('prices')->insert([
            'product_id' => $productId2,
            'base_price' => 189.90,
            'cost_price' => 95.00,
            'profit_margin' => 99.89,
            'currency' => 'BRL',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Variantes: Preto P, Preto M, Cinza P, Cinza M
        $variants2 = [
            ['size' => 'P', 'color' => 'Preto', 'hex' => '#000000', 'stock' => 30],
            ['size' => 'M', 'color' => 'Preto', 'hex' => '#000000', 'stock' => 40],
            ['size' => 'P', 'color' => 'Cinza', 'hex' => '#808080', 'stock' => 25],
            ['size' => 'M', 'color' => 'Cinza', 'hex' => '#808080', 'stock' => 35],
        ];

        foreach ($variants2 as $index => $varData) {
            $variantId = DB::table('product_variants')->insertGetId([
                'product_id' => $productId2,
                'sku' => "CAL-ADIDAS-MOL-001-{$varData['color']}-{$varData['size']}",
                'name' => "{$varData['color']} - {$varData['size']}",
                'variant_type' => 'clothing',
                'price_adjustment' => 0,
                'stock' => $varData['stock'],
                'weight' => 0.45,
                'order' => $index,
                'active' => true,
                'is_default' => $index === 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('clothing_variant_attributes')->insert([
                'product_variant_id' => $variantId,
                'size' => $varData['size'],
                'color' => $varData['color'],
                'color_hex' => $varData['hex'],
                'pattern' => 'Lisa',
                'fit' => 'Regular',
                'closure' => 'Elástico com cordão',
                'rise' => 'Cintura Média',
                'gender' => 'Unissex',
                'main_material' => 'Algodão/Poliéster',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Produto 2: Calça Adidas criada com 4 variantes');
    }
}
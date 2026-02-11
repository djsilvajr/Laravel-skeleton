<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FurnitureProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // ==================== PRODUTO 1: SOFÁ ====================
        
        $productId1 = DB::table('products')->insertGetId([
            'product_type_id' => 21, // Sofás
            'name' => 'Sofá Retrátil e Reclinável 3 Lugares',
            'sku' => 'SOFA-MODERN-3L-001',
            'description' => 'Sofá retrátil e reclinável com 3 lugares, estrutura em madeira maciça e espuma D33. Design moderno e confortável, perfeito para sala de estar. Revestimento em tecido suede de alta qualidade.',
            'short_description' => 'Sofá 3 lugares retrátil e reclinável',
            'brand' => 'ModernHome',
            'model' => 'Confort Plus',
            'attributes' => json_encode([
                'estrutura' => 'Madeira Eucalipto',
                'espuma' => 'D33 Alta Densidade',
                'pes' => 'Plástico Reforçado',
                'garantia' => '12 meses estrutura',
                'origem' => 'Brasil'
            ]),
            'avg_weight' => 85.00,
            'total_stock' => 0,
            'min_stock' => 3,
            'meta_title' => 'Sofá 3 Lugares Retrátil - Conforto e Estilo',
            'active' => true,
            'is_featured' => true,
            'is_new' => false,
            'has_variants' => true,
            'available_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('prices')->insert([
            'product_id' => $productId1,
            'base_price' => 1899.90,
            'cost_price' => 950.00,
            'profit_margin' => 100.00,
            'currency' => 'BRL',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Variantes: cores e materiais
        $variants1 = [
            ['color' => 'Cinza', 'material' => 'Tecido Suede', 'stock' => 8],
            ['color' => 'Marrom', 'material' => 'Tecido Suede', 'stock' => 6],
            ['color' => 'Cinza', 'material' => 'Couro Sintético', 'stock' => 4, 'price_adj' => 300.00],
        ];

        foreach ($variants1 as $index => $varData) {
            $variantId = DB::table('product_variants')->insertGetId([
                'product_id' => $productId1,
                'sku' => "SOFA-MODERN-3L-001-{$varData['color']}-{$varData['material']}",
                'name' => "{$varData['color']} - {$varData['material']}",
                'variant_type' => 'furniture',
                'price_adjustment' => $varData['price_adj'] ?? 0,
                'stock' => $varData['stock'],
                'weight' => 85.00,
                'dimensions' => json_encode(['altura' => 90, 'largura' => 220, 'profundidade' => 95]),
                'order' => $index,
                'active' => true,
                'is_default' => $index === 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('furniture_variant_attributes')->insert([
                'product_variant_id' => $variantId,
                'color' => $varData['color'],
                'color_hex' => $varData['color'] === 'Cinza' ? '#808080' : '#8B4513',
                'material' => $varData['material'],
                'wood_type' => 'Eucalipto',
                'finish' => 'Natural',
                'width' => 220.00,
                'height' => 90.00,
                'depth' => 95.00,
                'seat_height' => 45.00,
                'seats' => 3,
                'max_weight' => 300.00,
                'assembly_required' => false,
                'has_cushions' => true,
                'is_reclining' => true,
                'style' => 'Moderno',
                'room' => 'Sala',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Produto 1: Sofá criado com 3 variantes');

        // ==================== PRODUTO 2: MESA DE ESCRITÓRIO ====================
        
        $productId2 = DB::table('products')->insertGetId([
            'product_type_id' => 22, // Mesas
            'name' => 'Mesa de Escritório Office Pro',
            'sku' => 'MESA-OFFICE-PRO-001',
            'description' => 'Mesa de escritório em MDP com acabamento premium. Design clean e funcional, ideal para home office. Tampo resistente a riscos e manchas.',
            'short_description' => 'Mesa escritório MDP - Home Office',
            'brand' => 'OfficeHome',
            'model' => 'Office Pro',
            'attributes' => json_encode([
                'gavetas' => '2 gavetas com corrediças metálicas',
                'porta_cabos' => 'Sim',
                'niveladores' => 'Pés niveladores inclusos',
                'garantia' => '12 meses',
                'origem' => 'Brasil'
            ]),
            'avg_weight' => 35.00,
            'total_stock' => 0,
            'min_stock' => 5,
            'meta_title' => 'Mesa Escritório Office Pro - Home Office',
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
            'base_price' => 549.90,
            'cost_price' => 250.00,
            'profit_margin' => 119.96,
            'currency' => 'BRL',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Variantes: cores
        $variants2 = [
            ['color' => 'Branco', 'stock' => 15],
            ['color' => 'Preto', 'stock' => 12],
            ['color' => 'Amadeirado', 'stock' => 10],
        ];

        foreach ($variants2 as $index => $varData) {
            $variantId = DB::table('product_variants')->insertGetId([
                'product_id' => $productId2,
                'sku' => "MESA-OFFICE-PRO-001-{$varData['color']}",
                'name' => $varData['color'],
                'variant_type' => 'furniture',
                'price_adjustment' => 0,
                'stock' => $varData['stock'],
                'weight' => 35.00,
                'dimensions' => json_encode(['altura' => 75, 'largura' => 120, 'profundidade' => 60]),
                'order' => $index,
                'active' => true,
                'is_default' => $index === 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $colorHex = match($varData['color']) {
                'Branco' => '#FFFFFF',
                'Preto' => '#000000',
                'Amadeirado' => '#8B4513',
            };

            DB::table('furniture_variant_attributes')->insert([
                'product_variant_id' => $variantId,
                'color' => $varData['color'],
                'color_hex' => $colorHex,
                'material' => 'MDP',
                'finish' => 'BP (Baixa Pressão)',
                'width' => 120.00,
                'height' => 75.00,
                'depth' => 60.00,
                'drawers' => 2,
                'max_weight' => 40.00,
                'assembly_required' => true,
                'style' => 'Moderno',
                'room' => 'Escritório',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Produto 2: Mesa de escritório criada com 3 variantes');
    }
}
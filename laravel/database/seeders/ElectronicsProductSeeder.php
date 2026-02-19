<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ElectronicsProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // ==================== PRODUTO 1: NOTEBOOK DELL ====================
        
        $productId1 = DB::table('products')->insertGetId([
            'product_type_id' => 11, // Notebooks
            'name' => 'Notebook Dell Inspiron 15 Intel Core i7',
            'sku' => 'NOTE-DELL-INSP15-001',
            'description' => 'Notebook Dell Inspiron 15 com processador Intel Core i7 de 11ª geração, ideal para trabalho, estudos e entretenimento. Tela Full HD de 15.6 polegadas, design elegante e bateria de longa duração.',
            'short_description' => 'Notebook Dell i7 15.6" - Performance e Portabilidade',
            'brand' => 'Dell',
            'model' => 'Inspiron 15 3000',
            'attributes' => json_encode([
                'tela' => '15.6" Full HD',
                'sistema_operacional' => 'Windows 11 Home',
                'teclado' => 'ABNT2 com teclado numérico',
                'webcam' => 'HD 720p',
                'garantia' => '12 meses',
                'origem' => 'China'
            ]),
            'avg_weight' => 1.85,
            'avg_dimensions' => json_encode(['altura' => 2.0, 'largura' => 36.0, 'profundidade' => 25.0]),
            'total_stock' => 0,
            'min_stock' => 5,
            'meta_title' => 'Notebook Dell Inspiron 15 i7 - Alta Performance',
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
            'base_price' => 3499.90,
            'cost_price' => 2100.00,
            'profit_margin' => 66.66,
            'compare_at_price' => 4299.90,
            'currency' => 'BRL',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Variantes: diferentes configs de RAM/Storage
        $variants1 = [
            ['ram' => '8GB', 'storage' => '256GB SSD', 'stock' => 8, 'price_adj' => 0],
            ['ram' => '16GB', 'storage' => '512GB SSD', 'stock' => 12, 'price_adj' => 800.00],
            ['ram' => '16GB', 'storage' => '1TB SSD', 'stock' => 5, 'price_adj' => 1200.00],
        ];

        foreach ($variants1 as $index => $varData) {
            $variantId = DB::table('product_variants')->insertGetId([
                'product_id' => $productId1,
                'sku' => "NOTE-DELL-INSP15-001-{$varData['ram']}-{$varData['storage']}",
                'name' => "{$varData['ram']} RAM / {$varData['storage']}",
                'variant_type' => 'electronics',
                'price_adjustment' => $varData['price_adj'],
                'stock' => $varData['stock'],
                'weight' => 1.85,
                'dimensions' => json_encode(['altura' => 2.0, 'largura' => 36.0, 'profundidade' => 25.0]),
                'order' => $index,
                'active' => true,
                'is_default' => $index === 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('electronics_variant_attributes')->insert([
                'product_variant_id' => $variantId,
                'color' => 'Prata',
                'storage' => $varData['storage'],
                'ram' => $varData['ram'],
                'processor' => 'Intel Core i7-1165G7',
                'processor_generation' => '11ª Geração',
                'graphics_card' => 'Intel Iris Xe',
                'screen_size' => '15.6"',
                'resolution' => 'Full HD (1920x1080)',
                'screen_type' => 'IPS',
                'battery_capacity' => 54000, // mAh
                'battery_life' => 8, // horas
                'wifi' => 'WiFi 6',
                'bluetooth' => 'Bluetooth 5.1',
                'ports' => json_encode(['2x USB 3.2', '1x USB-C', '1x HDMI', 'Leitor SD']),
                'operating_system' => 'Windows 11 Home',
                'voltage' => 'Bivolt',
                'warranty_months' => 12,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Produto 1: Notebook Dell criado com 3 variantes');

        // ==================== PRODUTO 2: SMARTPHONE SAMSUNG ====================
        
        $productId2 = DB::table('products')->insertGetId([
            'product_type_id' => 12, // Smartphones
            'name' => 'Samsung Galaxy A54 5G',
            'sku' => 'SMART-SAMSUNG-A54-001',
            'description' => 'Smartphone Samsung Galaxy A54 5G com tela Super AMOLED de 6.4", câmera tripla de 50MP e bateria de 5000mAh. Design premium com acabamento em vidro e metal.',
            'short_description' => 'Samsung A54 5G - Câmera 50MP e Tela AMOLED',
            'brand' => 'Samsung',
            'model' => 'Galaxy A54 5G',
            'attributes' => json_encode([
                'sistema_operacional' => 'Android 13',
                'camera_frontal' => '32MP',
                'tipo_chip' => 'Nano SIM + eSIM',
                'nfc' => 'Sim',
                'garantia' => '12 meses',
                'origem' => 'Vietnã'
            ]),
            'avg_weight' => 0.202,
            'avg_dimensions' => json_encode(['altura' => 0.82, 'largura' => 7.67, 'profundidade' => 15.87]),
            'total_stock' => 0,
            'min_stock' => 10,
            'meta_title' => 'Samsung Galaxy A54 5G - Smartphone Premium',
            'active' => true,
            'is_featured' => true,
            'is_new' => true,
            'has_variants' => true,
            'available_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('prices')->insert([
            'product_id' => $productId2,
            'base_price' => 1899.90,
            'cost_price' => 1200.00,
            'profit_margin' => 58.33,
            'promotional_price' => 1699.90,
            'promotional_starts_at' => $now,
            'promotional_ends_at' => $now->copy()->addDays(7),
            'compare_at_price' => 2299.90,
            'currency' => 'BRL',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Variantes: cores e armazenamento
        $variants2 = [
            ['color' => 'Preto', 'storage' => '128GB', 'ram' => '6GB', 'stock' => 25],
            ['color' => 'Preto', 'storage' => '256GB', 'ram' => '8GB', 'stock' => 18, 'price_adj' => 300.00],
            ['color' => 'Verde', 'storage' => '128GB', 'ram' => '6GB', 'stock' => 20],
            ['color' => 'Verde', 'storage' => '256GB', 'ram' => '8GB', 'stock' => 15, 'price_adj' => 300.00],
        ];

        foreach ($variants2 as $index => $varData) {
            $variantId = DB::table('product_variants')->insertGetId([
                'product_id' => $productId2,
                'sku' => "SMART-SAMSUNG-A54-001-{$varData['color']}-{$varData['storage']}",
                'name' => "{$varData['color']} - {$varData['storage']}",
                'variant_type' => 'electronics',
                'price_adjustment' => $varData['price_adj'] ?? 0,
                'stock' => $varData['stock'],
                'weight' => 0.202,
                'order' => $index,
                'active' => true,
                'is_default' => $index === 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('electronics_variant_attributes')->insert([
                'product_variant_id' => $variantId,
                'color' => $varData['color'],
                'storage' => $varData['storage'],
                'ram' => $varData['ram'],
                'processor' => 'Exynos 1380',
                'screen_size' => '6.4"',
                'resolution' => 'Full HD+ (2340x1080)',
                'screen_type' => 'Super AMOLED',
                'refresh_rate' => 120,
                'battery_capacity' => 5000,
                'camera' => '50MP + 12MP + 5MP',
                'front_camera' => '32MP',
                'wifi' => 'WiFi 6',
                'bluetooth' => 'Bluetooth 5.3',
                'operating_system' => 'Android 13',
                'os_version' => 'One UI 5.1',
                'warranty_months' => 12,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Produto 2: Samsung Galaxy A54 criado com 4 variantes');
    }
}
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
        Schema::create('electronics_variant_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')
                  ->unique()
                  ->constrained('product_variants')
                  ->onDelete('cascade');
            
            // Atributos principais (INDEXADOS)
            $table->string('color')->nullable()->index(); // Prata, Preto, Branco, Azul
            $table->string('storage')->nullable()->index(); // 64GB, 128GB, 256GB, 512GB, 1TB
            $table->string('ram')->nullable()->index(); // 4GB, 8GB, 16GB, 32GB, 64GB
            
            // Processador/Performance
            $table->string('processor')->nullable()->index(); // Intel i5, i7, i9, AMD Ryzen 5, 7, 9
            $table->string('processor_generation')->nullable(); // 11ª Geração, 12ª Geração
            $table->string('graphics_card')->nullable(); // Intel Iris Xe, NVIDIA RTX 3060
            $table->decimal('clock_speed', 5, 2)->nullable(); // GHz
            
            // Tela/Display
            $table->string('screen_size')->nullable(); // 13.3", 14", 15.6", 17"
            $table->string('resolution')->nullable(); // HD, Full HD, QHD, 4K
            $table->string('screen_type')->nullable(); // IPS, OLED, AMOLED, LCD
            $table->integer('refresh_rate')->nullable(); // 60Hz, 90Hz, 120Hz, 144Hz
            
            // Bateria
            $table->integer('battery_capacity')->nullable(); // mAh
            $table->integer('battery_life')->nullable(); // horas
            
            // Conectividade
            $table->string('wifi')->nullable(); // WiFi 5, WiFi 6, WiFi 6E
            $table->string('bluetooth')->nullable(); // Bluetooth 4.2, 5.0, 5.1
            $table->json('ports')->nullable(); // ["USB-C", "USB 3.0", "HDMI", "Thunderbolt"]
            
            // Câmera (para celulares/notebooks)
            $table->string('camera')->nullable(); // 12MP, 48MP, etc
            $table->string('front_camera')->nullable();
            
            // Sistema/Software
            $table->string('operating_system')->nullable(); // Windows 11, macOS, Android
            $table->string('os_version')->nullable();
            
            // Elétrico
            $table->enum('voltage', ['110V', '220V', 'Bivolt'])->nullable();
            $table->integer('power_consumption')->nullable(); // Watts
            
            // Garantia
            $table->integer('warranty_months')->default(12);
            
            $table->timestamps();
            
            $table->index(['ram', 'storage']); // combinação comum
            $table->index(['processor', 'ram']);
            $table->index('screen_size');
            $table->index('graphics_card');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electronics_variant_attributes');
    }
};
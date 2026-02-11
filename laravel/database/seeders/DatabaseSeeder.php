<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class); 
        $this->call(UserRoleSeeder::class); 
        $this->call(UserPermissionRoleSeeder::class); 
        $this->call(FeatureFlagSeeder::class); 
        $this->call(ProductTypeSeeder::class);
        $this->call(ClothingProductSeeder::class);
        $this->call(ElectronicsProductSeeder::class);
        $this->call(FurnitureProductSeeder::class);
        $this->call(BookProductSeeder::class);
        $this->call(ProductImageSeeder::class);

        $this->command->newLine();
        $this->command->info('✅ All seeders executed successfully!');
    }
}

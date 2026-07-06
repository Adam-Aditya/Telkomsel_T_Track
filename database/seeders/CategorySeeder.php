<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menghapus data lama untuk menghindari duplikasi
        DB::table('categories')->delete();

        // Mengisi kategori logistik default Telkomsel
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Network Device', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Infrastructure', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Office Tools', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Fiber Optic Kit', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

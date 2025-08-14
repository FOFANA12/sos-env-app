<?php

namespace Database\Seeders;

use App\Models\ReportCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReportCategory::whereNotNull('id')->delete();

        $categories = [
            ['name' => 'Infrastructure'],
            ['name' => 'Éducation'],
            ['name' => 'Santé'],
            ['name' => 'Sécurité'],
            ['name' => 'Environnement'],
        ];

        foreach ($categories as $category) {
            ReportCategory::create([
                'name' => $category['name'],
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
            ]);
        }
    }
}

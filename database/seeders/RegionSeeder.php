<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::whereNotNull('id')->delete();

        $regions = [
            ['name' => "Brakna"],
            ['name' => "Gorgol"],
            ['name' => "Nouakchott ouest"],
            ['name' => "Nouakchott nord"],
        ];

        foreach ($regions as $region) {
            Region::create([
                'name' => $region['name'],
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
            ]);
        }
    }
}

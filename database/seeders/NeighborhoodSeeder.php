<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Neighborhood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Neighborhood::whereNotNull('id')->delete();

        $department = Department::first();

        $neighborhoods = [
            ['name' => "Bassra"],
            ['name' => "PK9"],
            ['name' => "Socogim PS"],
            ['name' => "Ksar"],
        ];

        foreach ($neighborhoods as $neighborhood) {
            Neighborhood::create([
                'name' => $neighborhood['name'],
                'status' => true,
                'department_uuid' => $department?->uuid,
                'created_by' => null,
                'updated_by' => null,
            ]);
        }
    }
}

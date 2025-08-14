<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::whereNotNull('id')->delete();

        $region = Region::first();

        $departments = [
            ['name' => "Boghe"],
            ['name' => "Dar Naim"],
            ['name' => "M'bagne"],
            ['name' => "Sebkha"],
        ];

        foreach ($departments as $department) {
            Department::create([
                'name' => $department['name'],
                'status' => true,
                'region_uuid' => $region?->uuid,
                'created_by' => null,
                'updated_by' => null,
            ]);
        }
    }
}

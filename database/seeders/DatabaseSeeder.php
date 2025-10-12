<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->call('cache:clear');
        $this->command->call('config:cache');

        $this->command->info('Exécution de migration');

        $this->command->call('migrate:fresh');
        $this->command->warn('Données effacées.');


        $this->call(
            [
                UserSeeder::class,
                RegionSeeder::class,
                DepartmentSeeder::class , 
                NeighborhoodSeeder::class,
                ReportSeeder::class,
            ]
        );
    }
}

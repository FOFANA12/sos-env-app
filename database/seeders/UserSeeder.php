<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::whereNotNull('id')->delete();

        User::create([
            'uuid' => Str::uuid(),
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '38086802',
            'password' => Hash::make('password'),
            'status' => true,
            'lang' => 'fr',
            'role' => 'admin',
            'signup_method' => 'email',
            'email_verified_at' => now(),
            'terms_accepted_at' => now(),
        ]);

        User::factory()
            ->count(5)
            ->state([
                'role' => 'user',
                'signup_method' => 'email',
                'status' => true,
                'email_verified_at' => now(),
                'terms_accepted_at' => now(),
            ])
            ->create();


        User::factory()
            ->count(10)
            ->state(function () {
                $canLogin = fake()->boolean(70);

                return [
                    'email' => fake()->unique()->safeEmail(),
                    'password' => $canLogin ? Hash::make('password') : null,
                    'status' => true,
                    'lang' => 'fr',
                    'role' => 'user',
                    'signup_method' => 'email',
                    'email_verified_at' => now(),
                    'terms_accepted_at' => now(),
                ];
            })
            ->create();
    }
}

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
            'signup_method' => 'manual',
            'email_verified_at' => now(),
        ]);

        User::factory()
            ->count(5)
            ->state([
                'role' => 'public_user',
                'signup_method' => 'manual',
                'status' => true,
                'email_verified_at' => now(),
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
                    'role' => 'internal_user',
                    'signup_method' => 'admin_created',
                    'email_verified_at' => $canLogin ? now() : null,
                ];
            })
            ->create();
    }
}

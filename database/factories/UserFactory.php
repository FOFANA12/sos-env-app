<?php

namespace Database\Factories;

use App\Support\Language;
use App\Support\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = (string) Str::uuid();

        return [
            'uuid' => $uuid,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'google_id' => null,
            'phone' => fake()->unique()->e164PhoneNumber(),
            'avatar' => fake()->imageUrl(100, 100, 'people'),
            'lang' => fake()->randomElement(Language::codes()),
            'role' => fake()->randomElement(Role::codes()),
            'signup_method' => fake()->randomElement(['manual', 'google', 'admin_created']),
            'status' => true,
            'email_verified_at' => now(),
            'last_login_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

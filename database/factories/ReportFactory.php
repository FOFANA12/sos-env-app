<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Neighborhood;
use App\Models\Region;
use App\Models\ReportCategory;
use App\Models\User;
use App\Support\Role;
use App\Support\Language;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = (string) Str::uuid();
        $user = User::first();;
        $category = ReportCategory::first();
        $region = Region::first();
        $department = Department::first();
        $neighborhood = Neighborhood::first();

        return [
            'uuid' => $uuid,
            'user_uuid' => $user->uuid,
            'category_uuid' => $category->uuid,
            'region_uuid' => $region->uuid,
            'department_uuid' => $department->uuid,
            'neighborhood_uuid' => $neighborhood->uuid,
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(),
            'latitude' => $this->faker->latitude(10, 8),
            'longitude' => $this->faker->longitude(11, 8),
            'address' => $this->faker->address(),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'rejected']),
            'is_public' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'status_changed_at' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'status_changed_by' => $user->uuid,
            'created_by' => $user->uuid,
            'updated_by' => $user->uuid,
        ];
    }
}

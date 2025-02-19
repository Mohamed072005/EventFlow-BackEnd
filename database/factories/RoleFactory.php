<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Role::class;
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'role_name' => $this->faker->randomElement(['user', 'organizer', 'admin']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

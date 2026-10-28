<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();
        return [
            'user_id' => null,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'department_id' => \App\Models\Department::factory(),
            'position_id' => \App\Models\Position::factory(),
            'manager_id' => null,
            'hire_date' => fake()->dateBetween(startDate: '-10 years', endDate: 'now')->format('Y-m-d'),
            'salary' => $this->faker->numberBetween(30000, 100000),
            'avatar_path' => null,
            'address' => fake()->address()
        ];
    }
}

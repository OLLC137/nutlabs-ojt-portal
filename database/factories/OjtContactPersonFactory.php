<?php

namespace Database\Factories;

use App\Models\OjtCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OjtContactPerson>
 */
class OjtContactPersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyIds = OjtCompany::pluck('id')->toArray();

        return [
            'company_id' => $this->faker->randomElement($companyIds),
            'contact_name' => $this->faker->name,
            'contact_position' => $this->faker->jobTitle,
            'contact_contact' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->unique()->safeEmail,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

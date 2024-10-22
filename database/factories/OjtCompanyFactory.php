<?php

namespace Database\Factories;

use App\Models\OjtCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ojt_companies>
 */
class OjtCompanyFactory extends Factory
{
    protected $model = OjtCompany::class;

    public function definition(): array
    {
        return [
            'co_name' => $this->faker->company,
            'co_address' => $this->faker->address,
            'co_contact_number' => $this->faker->phoneNumber,
            'co_email' => $this->faker->unique()->safeEmail(),
            'co_website' => $this->faker->url,
            'co_isactive' => $this->faker->boolean(50),
        ];
    }
}

<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OjtCoordinator>
 */
class OjtCoordinatorFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'department' => $this->faker->word(), // Example department name
            // 'user_id' is set in the seeder
        ];
    }
}

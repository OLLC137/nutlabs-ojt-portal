<?php

namespace Database\Factories;

use App\Models\OjtStudent;
use Illuminate\Database\Eloquent\Factories\Factory;

class OjtStudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OjtStudent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'stud_first_name' => $this->faker->firstName,
            'stud_middle_initial' => $this->faker->randomLetter,
            'stud_last_name' => $this->faker->lastName,
            'stud_sex' => $this->faker->randomElement(['Male', 'Female']),
            'stud_birthday' => now()->subYears(rand(18, 25))->toDateString(),
            'stud_birth_place' => $this->faker->city,
            'stud_student_telephone' => $this->faker->unique()->phoneNumber,
            'stud_email' => $this->faker->unique()->safeEmail,
            'stud_junior_high_school' => 'JHS',
            'stud_senior_high_school' => 'SHS',
            'stud_university' => 'Alangilan',
            'stud_sr_code' => $this->faker->randomElement([20, 21, 22]) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'stud_year_level' => 4,
            'stud_department' => $this->faker->randomElement(['CIT', 'CAFAD', 'CICS', 'COE']),
            'stud_expected_graduation' => now()->addYears(2)->toDateString(),
        ];
    }
}

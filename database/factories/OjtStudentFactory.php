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
            'stud_birthday' => $this->faker->date,
            'stud_birth_place' => $this->faker->city,
            'stud_student_telephone' => $this->faker->unique()->phoneNumber,
            'stud_email' => $this->faker->unique()->safeEmail,
            'stud_junior_high_school' => $this->faker->word,
            'stud_senior_high_school' => $this->faker->word,
            'stud_university' => $this->faker->word,
            'stud_sr_code' => $this->faker->word,
            'stud_department' => $this->faker->randomElement(['COE','CICS','CAFAD','CET','CTE','CAS','CABEIHM','CONAHS']),
            'stud_expected_graduation' => $this->faker->date,
        ];
    }
}

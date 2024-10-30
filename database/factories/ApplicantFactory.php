<?php

namespace Database\Factories;

use App\Models\Applicant;
use App\Models\OjtStudent;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantFactory extends Factory
{
    protected $model = Applicant::class;

    public function definition()
    {
        return [
            'student_id' => OjtStudent::inRandomOrder()->first()->id, // Random existing student
            'application_date' => $this->faker->date(),
            'status' => $this->faker->numberBetween(0, 1), // Random status (Pending = 0 or Approved = 1)
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

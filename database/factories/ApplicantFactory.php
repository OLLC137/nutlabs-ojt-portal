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
            'student_id' => OjtStudent::inRandomOrder()->first()->id,
            'application_date' => $this->faker->date(),
            'status' => 0, // Set status to 0 by default
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

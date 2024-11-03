<?php

namespace Database\Seeders;

use App\Models\Applicant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OjtApplicantSeeder extends Seeder
{
    public function run()
    {
        DB::table('applicants')->truncate();

        $students = \App\Models\OjtStudent::all();

        if ($students->isEmpty()) {
            echo "No students found to associate with applicants.\n";
            return;
        }

        $shuffledStudents = $students->shuffle();

        foreach ($shuffledStudents as $student) {
            Applicant::create([
                'student_id' => $student->id,
                'application_date' => now()->subDays(rand(1, 30)),
                'status' => 0, // Set status to 0 by default
            ]);
        }
    }
}

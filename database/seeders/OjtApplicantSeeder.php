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
                'student_id' => $student->id, // Student ID for each applicant
                'application_date' => now()->subDays(rand(1, 30)), // Random application date within the last 30 days
                'status' => rand(0, 1), // Random status (Pending = 0 or Approved = 1)
            ]);
        }
    }
}

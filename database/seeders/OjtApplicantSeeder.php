<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\OjtCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OjtApplicantSeeder extends Seeder
{
    public function run()
    {
        DB::table('applicants')->truncate();

        $students = \App\Models\OjtStudent::all();
        $companies = OjtCompany::all();

        if ($students->isEmpty() || $companies->isEmpty()) {
            echo "No students found to associate with applicants.\n";
            return;
        }


        foreach ($students as $student) {
            Applicant::create([
                'student_id' => $student->id,
                'company_id' => $companies->random()->id, // Associate each applicant with a random company
                'application_date' => now()->subDays(rand(1, 30)),
                'status' => 0, // Default status
            ]);
        }
    }
}

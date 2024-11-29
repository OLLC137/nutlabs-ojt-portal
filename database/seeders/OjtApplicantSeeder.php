<?php

namespace Database\Seeders;

use App\Models\OjtApplicant;
use App\Models\OjtJobListing;
use App\Models\OjtStudent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OjtApplicantSeeder extends Seeder
{
    public function run()
    {
        $students = OjtStudent::all();
        $jobList = OjtJobListing::all();

        foreach ($students as $student) {
            // Shuffle the job listings and pick 2–5 unique job IDs
            $joblistIds = $jobList->pluck('id')->shuffle()->take(rand(2, 5));

            foreach ($joblistIds as $joblistId) {
                OjtApplicant::create([
                    'status' => 2,
                    'student_id' => $student->id,
                    'joblist_id' => $joblistId, // Associate with unique joblist ID
                    'application_date' => now()->subDays(rand(1, 30)),
                    'resume_mode' => 3,
                    'cover_mode' => 3
                ]);
            }
        }
    }

}

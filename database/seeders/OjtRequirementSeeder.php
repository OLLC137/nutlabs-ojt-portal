<?php

namespace Database\Seeders;

use App\Models\OjtStudent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OjtRequirementSeeder extends Seeder
{
    public function run()
    {
        $students = OjtStudent::pluck('id')->toArray();
        $requirements = range(1, 10); // IDs of required documents

        foreach ($students as $studentId) {
            foreach ($requirements as $reqId) {
                DB::table('ojt_requirements')->insert([
                    'student_id' => $studentId,
                    'req_id' => $reqId,
                    'req_file_name' => 'file' . $studentId . '_' . $reqId . '.pdf',
                    'req_orig_name' => 'Requirement ' . $reqId,
                    'req_file_path' => 'files/student' . $studentId . '/requirement' . $reqId . '.pdf',
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OjtStudentSeeder extends Seeder
{
    public function run()
    {
        $departments = ['CONAHS', 'CABEIHM', 'CAS', 'CTE', 'CET', 'CAFAD', 'CICS', 'COE'];

        foreach (range(1, 10) as $index) {
            DB::table('ojt_students')->insert([
                'user_id' => $index, // Assuming there's a corresponding user with this ID
                'stud_prefix' => 'Mr.',
                'stud_first_name' => 'FirstName' . $index,
                'stud_middle_initial' => Str::random(1),
                'stud_last_name' => 'LastName' . $index,
                'stud_suffix' => 'Jr.',
                'stud_sex' => $index % 2 === 0 ? 'Male' : 'Female',
                'stud_birthday' => now()->subYears(rand(18, 25))->toDateString(),
                'stud_birth_place' => 'City' . $index,
                'stud_student_telephone' => '123456789' . $index,
                'stud_email' => 'student' . $index . '@example.com',
                'stud_junior_high_school' => 'JHS ' . $index,
                'stud_senior_high_school' => 'SHS ' . $index,
                'stud_university' => 'University ' . $index,
                'stud_sr_code' => 'SRCode' . $index,
                'stud_department' => $departments[array_rand($departments)],
                'stud_expected_graduation' => now()->addYears(2)->toDateString(),
            ]);
        }
    }
}

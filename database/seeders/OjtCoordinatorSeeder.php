<?php

namespace Database\Seeders;

use App\Models\OjtCoordinator;
use App\Models\User;
use Illuminate\Database\Seeder;

class OjtCoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map user IDs to departments
        $departmentMapping = [
            4 => 'CIT',
            5 => 'COE',
            6 => 'CICS',
            7 => 'CAFAD',
        ];

        // Create OjtCoordinator entries based on the mapping
        foreach ($departmentMapping as $userId => $department) {
            OjtCoordinator::create([
                'user_id' => $userId,
                'department' => $department,
            ]);
        }
    }
}

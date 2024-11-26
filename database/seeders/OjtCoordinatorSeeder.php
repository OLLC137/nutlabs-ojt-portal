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
        // Map usernames to departments
        $usernameToDepartment = [
            'CITojtcoordinator' => 'CIT',
            'COEojtcoordinator' => 'COE',
            'CICSojtcoordinator' => 'CICS',
            'CAFADojtcoordinator' => 'CAFAD',
        ];

        // Create OjtCoordinator entries based on the username-to-department mapping
        foreach ($usernameToDepartment as $username => $department) {
            $user = User::where('username', $username)->first();

            if ($user) {
                OjtCoordinator::create([
                    'user_id' => $user->id,
                    'department' => $department,
                ]);
            }
        }
    }
}

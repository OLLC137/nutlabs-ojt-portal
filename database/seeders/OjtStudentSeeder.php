<?php

namespace Database\Seeders;

use App\Models\OjtStudent;
use App\Models\User;
use Illuminate\Database\Seeder;

class OjtStudentSeeder extends Seeder
{
    public function run()
    {
        $userIds = User::where('role',20)->pluck('id')->toArray();

        foreach ($userIds as $id) {
            OjtStudent::factory()->create(['user_id' => $id]);
        }
    }
}




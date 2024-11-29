<?php

namespace Database\Seeders;

use App\Models\OjtCompany;
use App\Models\User;
use Illuminate\Database\Seeder;

class OjtCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $userIds = User::where('role',4)->pluck('id')->toArray();

        foreach ($userIds as $id) {
            OjtCompany::factory()->create(['user_id' => $id]);
        }
    }
}

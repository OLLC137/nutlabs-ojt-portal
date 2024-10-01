<?php

namespace Database\Seeders;

use App\Models\Public\OjtCompany;
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
        OjtCompany::factory()->count(50)->create();
    }
}

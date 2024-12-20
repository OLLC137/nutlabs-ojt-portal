<?php

namespace Database\Seeders;

use App\Models\OjtJobListing;
use Illuminate\Database\Seeder;

class OjtJobListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OjtJobListing::factory()->count(150)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\OjtContactPerson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OjtContactPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OjtContactPerson::factory()->count(150)->create();

    }
}

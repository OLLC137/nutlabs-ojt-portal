<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'super admin user',
            'username'=>'superadmin',
            'email' => 'superadmin@example.com',
            'role' => 0
        ]);
        User::factory()->create([
            'name' => 'admin user',
            'username'=>'admin',
            'email' => 'admin@example.com',
            'role' => 1
        ]);
        User::factory()->create([
            'name' => 'ojt head user',
            'username'=>'ojthead',
            'email' => 'ojthead@example.com',
            'role' => 2
        ]);
        User::factory()->create([
            'name' => 'ojt coordinator user',
            'username'=>'ojtcoordinator',
            'email' => 'ojtcoordinator@example.com',
            'role' => 3
        ]);
        User::factory()->create([
            'name' => 'student 1',
            'username'=>'student',
            'email' => 'student1@example.com',
            'role' => 20
        ]);
        User::factory()->create([
            'name' => 'student 2',
            'username'=>'student2',
            'email' => 'student2@example.com',
            'role' => 20
        ]);
        User::factory()->create([
            'name' => 'student 3',
            'username'=>'student3',
            'email' => 'studemt3@example.com',
            'role' => 20
        ]);


        $this->call(OjtCompanySeeder::class);
        $this->call(OjtContactPersonSeeder::class);
        $this->call(OjtJobListCategorySeeder::class);
        $this->call(OjtJobListingSeeder::class);
        //FOR REQS
        $this->call(OjtStudentSeeder::class);
        // $this->call(OjtRequirementSeeder::class);
    }
}

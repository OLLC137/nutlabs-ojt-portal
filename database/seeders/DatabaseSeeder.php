<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin and other fixed roles
        User::factory()->create([
            'name' => 'super admin user',
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'role' => 0
        ]);

        User::factory()->create([
            'name' => 'admin user',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'role' => 1
        ]);

        User::factory()->create([
            'name' => 'ojt head user',
            'username' => 'ojthead',
            'email' => 'ojthead@example.com',
            'role' => 2
        ]);

        // Seed OJT Coordinator Users with specific usernames
        User::factory()->create([
            'username' => 'CITojtcoordinator',
            'role' => 3
        ]);

        User::factory()->create([
            'username' => 'COEojtcoordinator',
            'role' => 3
        ]);

        User::factory()->create([
            'username' => 'CICSojtcoordinator',
            'role' => 3
        ]);

        User::factory()->create([
            'username' => 'CAFADojtcoordinator',
            'role' => 3
        ]);

        // Seed 50 Company Users
        for ($i = 1; $i <= 50; $i++) {
            User::factory()->create([
                'username' => 'company' . $i,
                'role' => 4
            ]);
        }

        // Seed 100 Student Users
        for ($i = 1; $i <= 100; $i++) {
            User::factory()->create([
                'username' => 'student' . $i,
                'role' => 20
            ]);
        }

        // Call additional seeders
        $this->call([
            OjtCompanySeeder::class,
            OjtJobListCategorySeeder::class,
            OjtJobListingSeeder::class,
            OjtStudentSeeder::class,
            OjtRequirementSeeder::class,
            OjtCoordinatorSeeder::class, // Ensure this comes after the User seeder
        ]);
    }
}

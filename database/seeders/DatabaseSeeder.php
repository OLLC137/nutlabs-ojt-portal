<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\OjtCompany;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed superadmin user
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
        // Seed Ojt Head User
        User::factory()->create([
            'name' => 'ojt head user',
            'username' => 'ojthead',
            'email' => 'ojthead@example.com',
            'role' => 2
        ]);
        // Seed Ojt Coordinator User
        User::factory()->create([
            'name' => 'ojt coordinator user',
            'username' => 'ojtcoordinator',
            'email' => 'ojtcoordinator@example.com',
            'role' => 3
        ]);
        // Seed 50 Company Users
        for ($i = 1; $i <= 50; $i++) {
            User::factory()->create([
                'username' => 'company' . $i,
                'role' => 4
            ]);
        }
        //Seed 100 Student Users
        for ($i = 1; $i <= 100; $i++) {
            User::factory()->create([
                'username' => 'student' . $i,
                'role' => 20
            ]);
        }

        $this->call(OjtCompanySeeder::class);
        $this->call(OjtJobListCategorySeeder::class);
        $this->call(OjtJobListingSeeder::class);
        $this->call(OjtStudentSeeder::class);
        $this->call(OjtRequirementSeeder::class);
        $this->call(OjtStudentSeeder::class);
        $this->call(OjtApplicantSeeder::class);
    }
}

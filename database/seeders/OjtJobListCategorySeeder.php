<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OjtJobListCategorySeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ["name" => "Automation", "icon" => "homepage/category-icons/car-vehicle-transport-svgrepo-com.svg"],
            ["name" => "Engineering", "icon" => "homepage/category-icons/engineering-helmet-cog-svgrepo-com.svg"],
            ["name" => "Hospitality", "icon" => "homepage/category-icons/hotel-svgrepo-com.svg"],
            ["name" => "Tourism", "icon" => "homepage/category-icons/vacation-tourism-luggage-svgrepo-com.svg"],
            ["name" => "Medicine", "icon" => "homepage/category-icons/pills-medicine-svgrepo-com.svg"],
            ["name" => "Technology", "icon" => "homepage/category-icons/computer-essential-web-svgrepo-com.svg"],
            ["name" => "Law", "icon" => "homepage/category-icons/law-svgrepo-com.svg"],
            ["name" => "Education", "icon" => "homepage/category-icons/education-svgrepo-com.svg"],
            ["name" => "Finance", "icon" => "homepage/category-icons/finance-history-money-svgrepo-com.svg"],
            ["name" => "Manufacturing", "icon" => "homepage/category-icons/factory-svgrepo-com.svg"],
            ["name" => "Construction", "icon" => "homepage/category-icons/construction-dump-dumper-svgrepo-com.svg"],
            ["name" => "Business", "icon" => "homepage/category-icons/business-building-svgrepo-com.svg"],
            ["name" => "Marketing", "icon" => "homepage/category-icons/store-dukan-svgrepo-com.svg"],
            ["name" => "Communications", "icon" => "homepage/category-icons/antenna-communications-svgrepo-com.svg"],
            ["name" => "Arts", "icon" => "homepage/category-icons/art-design-paint-pallet-format-text-svgrepo-com.svg"],
            ["name" => "Entertainment", "icon" => "homepage/category-icons/theatre-cinema-entertainment-show-masks-svgrepo-com.svg"],
            ["name" => "Agriculture", "icon" => "homepage/category-icons/agriculture-food-corn-svgrepo-com.svg"],
            ["name" => "Logistics", "icon" => "homepage/category-icons/logistics-truck-ultrathin-vehicle-outline-svgrepo-com.svg"],
            ["name" => "Human Resources", "icon" => "homepage/category-icons/users-people-svgrepo-com.svg"],
            ["name" => "Environmental", "icon" => "homepage/category-icons/agriculture-ecology-forest-garden-leaf-plant-8-svgrepo-com.svg"]
        ];

        foreach ($categories as $category) {
            DB::table('ojt_job_list_categories')->insert([
                'cat_name' => $category['name'],
                'cat_icon' => $category['icon'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

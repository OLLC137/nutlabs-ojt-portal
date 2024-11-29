<?php

namespace Database\Factories;

use App\Models\OjtJobListCategory;
use App\Models\OjtCompany;
use App\Models\OjtJobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OjtJobListings
 */
class OjtJobListingFactory extends Factory
{

    protected $model = OjtJobListing::class;

    public function definition()
    {
        $companyIds = OjtCompany::pluck('id')->toArray();
        $companyCategories = OjtJobListCategory::pluck('id')->toArray();


        $companyId = $this->faker->randomElement($companyIds);
        $randomDigits = str_pad($this->faker->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT);
        $jobRef = sprintf('OJT-%d-%s', $companyId, $randomDigits);

        return [
            'company_id' => $companyId,
            'job_ref' => $jobRef,
            'job_list' => $this->faker->jobTitle,
            'job_desc' => $this->faker->paragraph(10),
            'job_category' => $this->faker->randomElement($companyCategories),
            'job_programs' => implode(', ', $this->faker->randomElements([
                "Fine Arts and Design",
                "BS Architecture",
                "BS Chemical Engineering",
                "BS Civil Engineering",
                "BS Computer Engineering",
                "BS Electrical Engineering",
                "BS Aerospace Engineering",
                "BS Biomedical Engineering",
                "BS Electronics Engineering",
                "BS Mechatronics Engineering",
                "BS Industrial Engineering",
                "BS Automotive Engineering",
                "BS Mechanical Engineering",
                "BS Computer Science",
                "BS Information Technology"
            ]
            , rand(0, 3))),
        ];
    }
}

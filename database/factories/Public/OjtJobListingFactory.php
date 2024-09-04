<?php

namespace Database\Factories\Public;

use App\Models\OjtContactPerson;
use App\Models\OjtJobListCategory;
use App\Models\Public\OjtCompany;
use App\Models\Public\OjtJobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Public\OjtJobListings>
 */
class OjtJobListingFactory extends Factory
{

    protected $model = OjtJobListing::class;

    public function definition()
    {
        $companyIds = OjtCompany::pluck('id')->toArray();
        $contactIds = OjtContactPerson::pluck('id')->toArray();
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
            'job_person' => $this->faker->randomElement($contactIds),
            'job_status' => $this->faker->boolean(50),
        ];
    }
}

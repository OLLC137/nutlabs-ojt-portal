<?php

namespace App\Livewire\Homepage;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class JobListingDisplay extends Component
{
    public $jobListings = [];

    public function mount()
    {
        $this->jobListings = DB::table('ojt_job_listings')
            ->join('ojt_companies', 'ojt_job_listings.company_id', '=', 'ojt_companies.id')
            ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
            ->select(
                'ojt_job_listings.id as job_id',
                'ojt_job_listings.job_list as job_list',
                'ojt_job_list_categories.id as job_category_id', // Include category ID
                'ojt_job_list_categories.cat_name as job_category', // Select cat_name instead of job_category
                'ojt_job_listings.job_desc as job_desc',
                'ojt_job_listings.job_status as job_status',
                'ojt_job_listings.job_ref as job_ref',
                'ojt_companies.co_name as company_name',
                'ojt_companies.co_address as location'
            )
            ->where('job_status', '1')
            ->inRandomOrder() // Randomize the query results
            ->limit(6)
            ->get();
    }

    #[On('viewJob')]
    public function viewJob($id){
        return redirect()->route('joblist', ['id' => $id]);
    }

    #[On('openMobile')]
    public function openMobile($id){
        return redirect()->route('jobpreview', ['id' => $id]);
    }

    public function render()
    {
        return view('livewire.homepage.job-listing-display', [
            'jobListings' => $this->jobListings,
        ]);
    }

    public function getColorForCategoryId($categoryId) {
        // Define a list of colors
        $colors = [
            'blue', 'orange', 'yellow', 'green', 'red', 'purple', 'navy', 'green', 'gray', 'silver',
            'brown', 'black', 'pink', 'skyblue', 'gold', 'purple', 'green', 'gray', 'lightblue', 'green'
        ];

        // Calculate the index based on categoryId
        $index = ($categoryId - 1) % count($colors);

        // Build the style string with background-color and optional color
        $style = 'background-color: ' . $colors[$index] . ';';
        if (in_array($colors[$index], ['navy', 'black', 'purple', 'brown', 'blue','red','green'])) {
            $style .= ' color: white;'; // Add white text for dark backgrounds
        }

        return $style;
    }
}

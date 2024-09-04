<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Public\OjtJobListing;
use Illuminate\Support\Facades\DB;

class PartnerIndustry extends Component
{
    public $category = [];

    public function mount()
    {
        $this->fetchCategoryData();
    }

    public function fetchCategoryData()
    {
        // Fetch job categories for active and inactive jobs
        $jobs = OjtJobListing::join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
            ->select('ojt_job_list_categories.cat_name as job_category', 'job_status', DB::raw('COUNT(*) as jobs_count'))
            ->groupBy('ojt_job_list_categories.cat_name', 'job_status')
            ->get();

        // Format the data for the chart
        $this->category = $jobs->map(function ($item) {
            return [
                'category' => $item->job_category,
                'jobs_count' => $item->jobs_count,
                'job_status' => $item->job_status
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.partner-industry', [
            'category' => $this->category,
        ]);
    }
}

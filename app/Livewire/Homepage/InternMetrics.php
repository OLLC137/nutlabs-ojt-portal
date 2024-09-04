<?php

namespace App\Livewire\Homepage;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class InternMetrics extends Component
{
    public $listingsCount;
    public $listingCategoriesCount;

    public function render()
    {
        $this->listingsCount = DB::table('ojt_job_listings')->count();
        $this->listingCategoriesCount = DB::table('ojt_job_listings')
            ->distinct('job_category')
            ->count('job_category');

        return view('livewire.homepage.intern-metrics', [
            'listingsCount' => $this->listingsCount,
            'listingsCategoriesCount' => $this->listingCategoriesCount,
        ]);
    }
}
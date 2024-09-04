<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JobListingCard extends Component
{
    public $jobListing;

    public function __construct($jobListing)
    {
        $this->jobListing = $jobListing;
    }

    public function render()
    {
        return view('components.job-listing-card');
    }
}

<?php

namespace App\Livewire\Homepage;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CompanyCategoryCard extends Component
{

    public $categories;

    public function cardClick($job_category){
        return redirect()->route('joblist', ['category' => $job_category]);
    }

    public function render()
    {
        $this->categories = DB::table('ojt_job_listings')
            ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
            ->select('ojt_job_list_categories.id', 'ojt_job_list_categories.cat_name', 'ojt_job_list_categories.cat_icon', DB::raw('count(*) as count'))
            ->groupBy('ojt_job_list_categories.id', 'ojt_job_list_categories.cat_name', 'ojt_job_list_categories.cat_icon')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        return view('livewire.homepage.company-category-card', [
            'categories' => $this->categories,
        ]);
    }
}

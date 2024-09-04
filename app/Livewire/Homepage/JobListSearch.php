<?php

namespace App\Livewire\Homepage;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class JobListSearch extends Component
{
    public $search;
    public $category;
    public $location;
    public $categories;

    public function mount()
    {
        $this->search = request()->input('search', '');
        $this->category = request()->input('category', '');
        $this->location = request()->input('location', '');

        $this->categories = DB::table('ojt_job_list_categories')
        ->orderBy('cat_name')
        ->pluck('cat_name', 'id');
    }

    public function doSearch(){
        $this->dispatch('search', 
        search: $this->search,
        category: $this->category,
        location: $this->location); 

    }

    public function render()
    {
        return view('livewire.homepage.job-list-search');
    }
}

<?php

namespace App\Livewire\Homepage;

use Livewire\Component;

class CompanySearchBar extends Component
{
    public $searchQuery;

    public function search()
    {
        $this->validate([
            'searchQuery' => 'required'
        ]);

        return redirect()->route('joblist', ['search' => $this->searchQuery]);
    }

    public function render()
    {
        return view('livewire.homepage.company-search-bar');
    }
}

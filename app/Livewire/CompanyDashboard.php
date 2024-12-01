<?php

namespace App\Livewire;

use App\Models\OjtCompany;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyDashboard extends Component
{
    public function render()
    {
        $userId = Auth::id();
        $company = OjtCompany::where('user_id', $userId)->first();



        return view('livewire.company-dashboard', ['company' => $company]);
    }
}

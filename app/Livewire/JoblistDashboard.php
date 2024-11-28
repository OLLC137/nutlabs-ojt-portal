<?php

namespace App\Livewire;

use App\Models\OjtApplicant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class JoblistDashboard extends Component
{
    public function render()
    {
        return view('livewire.joblist-dashboard');
    }
}

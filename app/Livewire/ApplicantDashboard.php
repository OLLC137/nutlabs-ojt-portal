<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;

class ApplicantDashboard extends Component
{
    public $totalApplicants = 0;
    public $departmentData = [];

    public function mount()
    {
        $this->loadApplicantData();
    }

    public function loadApplicantData()
    {
        $user = Auth::user();

        // Check if user is a company (role 4)
        if ($user && $user->role === 4) {
            // Fetch applicants for the logged-in company
            $applicants = Applicant::with('student')
                ->where('company_id', $user->id)
                ->get();

            // Calculate total applicants
            $this->totalApplicants = $applicants->count();
            if ($this->totalApplicants > 0) {
                // Group applicants by department and count
                $this->departmentData = $applicants->groupBy(function ($applicant) {
                    return $applicant->student->stud_department;
                })->map(function ($group) {
                    return $group->count();
                })->toArray();
            } else {
                $this->departmentData = [];
            }
        } else {
            $this->totalApplicants = 0;
            $this->departmentData = [];
        }
    }

    public function render()
    {
        return view('livewire.applicant-dashboard', [
            'departmentData' => $this->departmentData,
            'totalApplicants' => $this->totalApplicants,
        ]);
    }
}

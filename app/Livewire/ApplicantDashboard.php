<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OjtApplicant;
use App\Models\OjtCompany;
use App\Models\OjtJobListing;
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
            $companyId = OjtCompany::where('user_id', $user->id)->first()->id;
            $jobListIds = OjtJobListing::where('company_id', $companyId)->pluck('id')->toArray();
            $applicants = OjtApplicant::whereIn('joblist_id', $jobListIds)->where('status', '!=', 3)->get();

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

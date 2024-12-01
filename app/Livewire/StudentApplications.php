<?php

namespace App\Livewire;

use App\Models\OjtApplicant;
use App\Models\OjtDownloadable;
use App\Models\OjtStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StudentApplications extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selectedApplicationId;
    public $selectedApplication;
    public $jobInfo;
    public $jobPrograms;

    public $selectedResumeFile;
    public $selectedCoverFile;

    public function updatedSelectedApplicationId()
    {
        if ($this->selectedApplicationId) {
            $this->selectedApplication = OjtApplicant::where('id', $this->selectedApplicationId)->first();
            $this->jobInfo = DB::table('ojt_job_listings')
                ->join('ojt_companies', 'ojt_job_listings.company_id', '=', 'ojt_companies.id')
                ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
                ->where('ojt_job_listings.id', $this->selectedApplication->joblist_id)
                ->select(
                    'ojt_job_listings.id as job_id',
                    'ojt_job_listings.job_list as job_list',
                    'ojt_job_list_categories.id as job_category_id', // Include category ID
                    'ojt_job_list_categories.cat_name as job_category', // Select cat_name instead of job_category
                    'ojt_job_listings.job_desc as job_desc',
                    'ojt_job_listings.job_ref as job_ref',
                    'ojt_job_listings.job_slots as job_slots',
                    'ojt_companies.co_name as company_name',
                    'ojt_companies.co_address as location',
                    'ojt_job_listings.job_programs as job_programs'
                )
                ->first();
            $this->jobPrograms = explode(',', $this->jobInfo->job_programs);
            if ($this->selectedApplication->resume_mode == 2) {
                $this->selectedResumeFile = OjtDownloadable::where('id', $this->selectedApplication->resume_file_id)->first();
            } else $this->selectedResumeFile = null;
            if ($this->selectedApplication->cover_mode == 1) {
                $this->selectedCoverFile = OjtDownloadable::where('id', $this->selectedApplication->cover_file_id)->first();
            } else $this->selectedCoverFile = null;
        }
    }
    public function downloadFile($id)
    {
        $file = OjtDownloadable::where('id', $id)
                                    ->first();

        $filePath = storage_path('app/' . $file->file_path);
        return response()->download($filePath, $file->file_original_name);
    }
    public function render()
    {
        $user = Auth::user();
        $studentId = OjtStudent::where('user_id', $user->id)->first()->id;
        $totalApplications = OjtApplicant::where('student_id', $studentId)->count();
        $applications = OjtApplicant::where('student_id', $studentId)
            ->join('ojt_job_listings', 'ojt_job_listings.id', '=', 'ojt_applicants.joblist_id')
            ->whereNull('ojt_job_listings.deleted_at')
            ->join('ojt_companies', 'ojt_companies.id', '=', 'ojt_job_listings.company_id')
            ->select('ojt_applicants.*', 'ojt_job_listings.job_list', 'ojt_companies.co_name')
            ->orderBy('ojt_applicants.status', 'asc')
            ->paginate(4);

        return view('livewire.student-applications', [
            'applications' => $applications,
            'totalApplications' => $totalApplications,
        ]);
    }
}

<?php

namespace App\Livewire;

use App\Models\OjtRequirement;
use App\Models\OjtStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;

use Livewire\WithFileUploads;


class StudentJoblist extends Component
{
    use WithFileUploads;

    #[Url()] public $id;
    public $jobInfo;
    public $jobPrograms;

    public $resumeSelect;
    public $selectedResumeFileName;

    public $resumeFile;
    public $temporaryUploadedResume;
    public $originalResumeName;

    public $coverSelect;

    public $coverFile;
    public $temporaryUploadedCover;
    public $originalCoverName;

    public $writeCover;

    public function updatedResumeSelect()
    {
        if ($this->resumeSelect == 'useResume') {
            $student = OjtStudent::where('user_id', Auth::id())->first(); // Get the student associated with the user

            $requirement = OjtRequirement::where('student_id', $student->id)
                ->where('req_id', 3)
                ->where('locked_at', '!=', null)
                ->first(); // Get the requirement
            if ($requirement){
                $this->selectedResumeFileName = $requirement->req_orig_name;

            } else {
                $this->selectedResumeFileName = 'No Uploaded Resume';
            }
        }
    }

    public function updatedResumeFile()
    {
        if ($this->resumeFile) {
            // Store the uploaded file temporarily
            $this->temporaryUploadedResume = $this->resumeFile->store('temp');
            // Store the original file name
            $this->originalResumeName = $this->resumeFile->getClientOriginalName();
        }
    }

    public function updatedCoverFile()
    {
        if ($this->coverFile) {
            // Store the uploaded file temporarily
            $this->temporaryUploadedCover = $this->coverFile->store('temp');
            // Store the original file name
            $this->originalCoverName = $this->coverFile->getClientOriginalName();
        }
    }
    public function clearResumeFile()
    {
        // Clear the temporary file
        $this->resumeFile = null;
        $this->temporaryUploadedResume = null;
    }
    public function clearCoverFile()
    {
        // Clear the temporary file
        $this->coverFile = null;
        $this->temporaryUploadedCover = null;
    }

    public function render()
    {
        if ($this->id) {
            $this->jobInfo = DB::table('ojt_job_listings')
                ->join('ojt_companies', 'ojt_job_listings.company_id', '=', 'ojt_companies.id')
                ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
                ->where('ojt_job_listings.id', $this->id)
                ->select(
                    'ojt_job_listings.id as job_id',
                    'ojt_job_listings.job_list as job_list',
                    'ojt_job_list_categories.id as job_category_id', // Include category ID
                    'ojt_job_list_categories.cat_name as job_category', // Select cat_name instead of job_category
                    'ojt_job_listings.job_desc as job_desc',
                    'ojt_job_listings.job_ref as job_ref',
                    'ojt_companies.co_name as company_name',
                    'ojt_companies.co_address as location',
                    'ojt_job_listings.job_programs as job_programs'
                )
                ->first();
            $this->jobPrograms = explode(',', $this->jobInfo->job_programs);
        }

        return view('livewire.student-joblist');
    }
}

<?php

namespace App\Livewire;

use App\Models\OjtApplicant;
use App\Models\OjtDownloadable;
use App\Models\OjtRequirement;
use App\Models\OjtStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class StudentJobListJob extends Component
{
    use WithFileUploads;

    public $id;
    public $jobInfo;
    public $jobPrograms;
    public $jobSlots;

    public $appliedStatus = true;

    public $resumeSelect;
    public $selectedResumeFileId;
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
        if ($this->resumeSelect == 1) {
            $student = OjtStudent::where('user_id', Auth::id())->first(); // Get the student associated with the user

            $requirement = OjtRequirement::where('student_id', $student->id)
                ->where('req_id', 3)
                ->where('locked_at', '!=', null)
                ->first(); // Get the requirement
            if ($requirement) {
                $this->selectedResumeFileName = $requirement->req_orig_name;
                $this->selectedResumeFileId = $requirement->id;
            } else {
                $this->selectedResumeFileName = null;
            }
        }
    }

    public function updatedResumeFile()
    {
        $this->validate([
            'resumeFile' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($this->resumeFile) {
            // Store the uploaded file temporarily
            $this->temporaryUploadedResume = $this->resumeFile->store('temp');
            // Store the original file name
            $this->originalResumeName = $this->resumeFile->getClientOriginalName();
        }
    }

    public function updatedCoverFile()
    {
        $this->validate([
            'coverFile' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);
        if ($this->coverFile) {
            // Store the uploaded file temporarily
            $this->temporaryUploadedCover = $this->coverFile->store('temp');
            // Store the original file name
            $this->originalCoverName = $this->coverFile->getClientOriginalName();
        }
    }
    public function clearResumeFile()
    {
        // Remove the stored temp file
        Storage::delete($this->temporaryUploadedResume);
        // Clear the temporary file
        $this->resumeFile = null;
        $this->temporaryUploadedResume = null;
    }
    public function clearCoverFile()
    {
        // Remove the stored temp file
        Storage::delete($this->temporaryUploadedCover);
        // Clear the temporary file
        $this->coverFile = null;
        $this->temporaryUploadedCover = null;
    }

    public function updatedId()
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
                    'ojt_job_listings.job_slots as job_slots',
                    'ojt_companies.co_name as company_name',
                    'ojt_companies.co_address as location',
                    'ojt_job_listings.job_programs as job_programs'
                )
                ->first();
            $this->jobPrograms = explode(',', $this->jobInfo->job_programs);
            $this->jobSlots = ($this->jobInfo->job_slots - OjtApplicant::where('joblist_id', $this->jobInfo->job_id)->where('status', 1)->count());

            $studentId = OjtStudent::where('user_id', Auth::id())->first()->id;
            $this->appliedStatus = !OjtApplicant::where('joblist_id', $this->jobInfo->job_id)->where('student_id', $studentId)->exists();
        }
    }

    public function submittable()
    {
        if (!$this->resumeSelect || !$this->coverSelect) return false;
        if ($this->resumeSelect == 1 && !$this->selectedResumeFileName) return false;
        if ($this->resumeSelect == 2 && !$this->temporaryUploadedResume) return false;
        if ($this->coverSelect == 1 && !$this->temporaryUploadedCover) return false;
        if (!$this->appliedStatus) return false;
        if ($this->jobSlots == 0) return false;
        return true;
    }

    public function submitApplication()
    {
        $coverFileId = null;
        $resumeFileId = null;
        if ($this->coverSelect == 1) {
            $filepath = 'application_files/' . basename($this->temporaryUploadedCover);
            Storage::move($this->temporaryUploadedCover, $filepath);
            $newFile = OjtDownloadable::create([
                'file_path' => $filepath,
                'file_name' => basename($filepath),
                'file_original_name' => $this->originalCoverName,
                'file_type' => 'cover letter',
            ]);
            $coverFileId = $newFile->id;
        }
        if ($this->coverSelect == 2) {
            $this->validate([
                'writeCover' => 'required|string|max:2000',
            ]);
        } else {
            $this->writeCover = null;
        }
        if ($this->resumeSelect == 1) {
            $resumeFileId = $this->selectedResumeFileId;
        }
        if ($this->resumeSelect == 2) {
            $filepath = 'application_files/' . basename($this->temporaryUploadedResume);
            Storage::move($this->temporaryUploadedResume, $filepath);
            $newFile = OjtDownloadable::create([
                'file_path' => $filepath,
                'file_name' => basename($filepath),
                'file_original_name' => $this->originalResumeName,
                'file_type' => 'resume',
            ]);
            $resumeFileId = $newFile->id;
        }

        $student = OjtStudent::where('user_id', Auth::id())->first();
        $applicantData = [
            'status' => 2,
            'student_id' => $student->id,
            'joblist_id' => $this->id,
            'application_date' => now(),
            'resume_mode' => $this->resumeSelect,
            'resume_file_id' => $resumeFileId,
            'cover_mode' => $this->coverSelect,
            'cover_file_id' => $coverFileId,
            'cover_text' => $this->writeCover,
        ];
        OjtApplicant::create($applicantData);
        session()->flash('status', 'Successfully submitted application.');
        return redirect()->route('student-joblist');
    }
    public function return()
    {
        return redirect()->route('student-joblist');
    }
    public function mount($id)
    {
        $this->id = $id;
        $this->updatedId();
    }
    public function render()
    {
        return view('livewire.student-job-list-job');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OjtApplicant;
use App\Models\OjtCompany;
use App\Models\OjtDownloadable;
use App\Models\OjtJobListing;
use App\Models\OjtRequirement;
use Illuminate\Support\Facades\Auth;

class ApplicantTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchQuery = '';
    public $applicantId;
    public $selectedResumeFile;
    public $selectedCoverFile;

    public function mount() // Default to null
    {
        $this->applicantId = $applicantId ?? session()->pull('applicantId'); // Use session if not provided
    }

    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->applicantId) {
            $applicant = OjtApplicant::join('ojt_students', 'ojt_students.id', '=', 'ojt_applicants.student_id')
                ->join('ojt_job_listings', 'ojt_job_listings.id', '=', 'ojt_applicants.joblist_id')
                ->where('ojt_applicants.id', $this->applicantId)->first();

            if ($applicant->resume_mode == 1) {
                $this->selectedResumeFile = OjtRequirement::where('id', $applicant->resume_file_id)->first();
            } else if ($applicant->resume_mode == 2) {
                $this->selectedResumeFile = OjtDownloadable::where('id', $applicant->resume_file_id)->first();
            } else $this->selectedResumeFile = null;

            if ($applicant->cover_mode == 1) {
                $this->selectedCoverFile = OjtDownloadable::where('id', $applicant->cover_file_id)->first();
            } else $this->selectedCoverFile = null;
            return view('livewire.applicant-table', [
                'applicant' => $applicant,
            ]);
        } else {
            $user = Auth::user();

            $companyId = OjtCompany::where('user_id', $user->id)->first()->id;
            $jobListIds = OjtJobListing::where('company_id', $companyId)->pluck('id')->toArray();
            $query = OjtApplicant::query();

            // Apply search query if it exists
            if (!empty($this->searchQuery)) {
                $searchQuery = strtolower($this->searchQuery);
                $query->whereHas('student', function ($q) use ($searchQuery) {
                    $q->whereRaw('LOWER(stud_first_name) LIKE ?', ['%' . $searchQuery . '%'])
                        ->orWhereRaw('LOWER(stud_last_name) LIKE ?', ['%' . $searchQuery . '%'])
                        ->orWhereRaw('LOWER(stud_sr_code) LIKE ?', ['%' . $searchQuery . '%']);
                });
            }
            // Exclude applicants with a status of 1 (accepted)
            $applicants = $query->whereIn('joblist_id', $jobListIds)
                ->where('status', '!=', 3)
                ->orderBy('status', 'desc')
                ->orderBy('created_at', 'desc')
                ->paginate(10, ['*'], 'applicants-page');

            return view('livewire.applicant-table', [
                'applicants' => $applicants,
            ]);
        }
    }
    public function downloadFile($id)
    {
        $file = OjtDownloadable::where('id', $id)
            ->first();

        $filePath = storage_path('app/' . $file->file_path);
        return response()->download($filePath, $file->file_original_name);
    }
    public function downloadRequirement($id)
    {
        $file = OjtRequirement::where('id', $id)
            ->first();

        $filePath = storage_path('app/' . $file->req_file_path);
        return response()->download($filePath, $file->req_orig_name);
    }
    public function clearSearch()
    {
        $this->searchQuery = '';
    }
    public function selectApplicant($id)
    {
        $this->applicantId = $id;
    }
    public function checkFull()
    {
        $application = OjtApplicant::where('id', $this->applicantId)->first();
        $joblist = OjtJobListing::where('id', $application->joblist_id)->first();

        $applicants = OjtApplicant::where('joblist_id', $joblist->id)->where('status', 1)->count();
        $slots = $joblist->job_slots;

        if ($applicants == $slots) {
            OjtJobListing::where('id', $joblist->id)->update(['job_status' => false]);
        }
    }

    public function accept()
    {
        session()->flash('status', 'Successfully accepted applicant.');
        OjtApplicant::where('id', $this->applicantId)->update(['status' => 1]);
        $this->checkFull();
    }
    public function reject()
    {
        session()->flash('status', 'Successfully rejected applicant.');
        OjtApplicant::where('id', $this->applicantId)->update(['status' => 3]);
    }
}

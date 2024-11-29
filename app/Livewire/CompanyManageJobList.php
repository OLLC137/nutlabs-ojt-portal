<?php

namespace App\Livewire;

use App\Models\OjtCompany;
use App\Models\OjtJobListCategory;
use App\Models\OjtJobListing;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyManageJobList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $company_id;
    public $company_name;
    public $joblist;

    public $inputJobList;
    public $selectedCategoryId;
    public $inputDescription;
    public $inputPrograms;
    public $inputSlots;
    public $jobActiveStatus = true;

    public $confirmDeletion = false;

    public $categoryGroup;
    public $categorySearchTerm;
    public $selectedCategoryName;
    public $isCategoryOpen = false;

    public function mount() {}

    public function render()
    {
        $this->categoryGroup = OjtJobListCategory::query()
            ->select('id as id', "cat_name as name")
            ->whereRaw('LOWER(cat_name) like ?', ['%' . strtolower($this->categorySearchTerm) . '%'])
            ->get();

        $company = OjtCompany::where('user_id', Auth::id())->first();

        $this->company_id = $company->id;
        $this->company_name = $company->co_name;

        $query = OjtJobListing::query()
            ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
            ->select(
                'ojt_job_listings.id',
                'job_ref',
                'job_list',
                'ojt_job_list_categories.cat_name as job_category',
                'job_status'
            )
            ->orderBy('job_ref', 'asc')
            ->where('ojt_job_listings.company_id', $this->company_id);
        $jobListings = $query->paginate(5, pageName: 'jobListPage');
        return view('livewire.company-manage-job-list', ['jobListings' => $jobListings]);
    }

    public function selectJob($id)
    {
        $this->joblist = $id;
        $jobList = OjtJobListing::join('ojt_companies', 'ojt_companies.id', '=', 'ojt_job_listings.company_id')
            ->join('ojt_job_list_categories', 'ojt_job_list_categories.id', '=', 'ojt_job_listings.job_category')
            ->where('ojt_job_listings.id', $this->joblist)->first();

        $this->inputJobList = $jobList->job_list;
        $this->selectedCategoryId = $jobList->job_category;
        $this->selectedCategoryName = $jobList->cat_name;
        $this->inputPrograms = $jobList->job_programs;
        $this->inputDescription = $jobList->job_desc;
        $this->inputSlots = $jobList->job_slots;
        $this->jobActiveStatus = $jobList->job_status;
    }

    public function categoryDisplayNone()
    {
        if ($this->isCategoryOpen) return '';
        else return 'display: none; !important';
    }
    public function toggleCategory()
    {
        $this->isCategoryOpen = !$this->isCategoryOpen;
    }
    public function closeCategory()
    {
        $this->isCategoryOpen = false;
    }
    public function selectCategoryId($id, $name)
    {
        $this->selectedCategoryId = $id;
        $this->selectedCategoryName = $name;
        $this->categorySearchTerm = '';
        $this->closeCategory();
    }
    public function updateJobList()
    {
        $this->validate([
            'inputJobList' => 'required|string|max:225',
            'selectedCategoryId' => 'required',
            'inputPrograms' => 'string|max:1024',
            'inputDescription' => 'required|string|max:5000',
            'inputSlots' => 'required|int'
        ]);

        OjtJobListing::find($this->joblist)
            ->update([
                'company_id' => $this->company_id,
                'job_list' => $this->inputJobList,
                'job_desc' => $this->inputDescription,
                'job_programs' => $this->inputPrograms,
                'job_category' => $this->selectedCategoryId,
                'job_slots' => $this->inputSlots,
                'job_status' => $this->jobActiveStatus
            ]);

        $this->reset('inputJobList');
        $this->reset('selectedCategoryId');
        $this->reset('inputPrograms');
        $this->reset('inputDescription');
        $this->reset('inputSlots');
        $this->reset('jobActiveStatus');
        $this->selectedCategoryName = '';

        $this->joblist = null;

        $this->mount();
        session()->flash('status', 'Information successfully saved.');
    }
    public function deleteJobList()
    {
        $jobList = OjtJobListing::find($this->joblist);
        if ($jobList) {
            $jobList->delete();
            session()->flash('status', 'Job List Successfully Deleted.');
            $this->confirmDeletion = false;
            $this->reset('inputJobList');
            $this->reset('selectedCategoryId');
            $this->reset('inputPrograms');
            $this->reset('inputDescription');
            $this->reset('jobActiveStatus');
            $this->selectedCategoryName = '';
            $this->joblist = null;
        }
    }

    public function addJobList()
    {
        $this->reset('inputJobList');
        $this->reset('selectedCategoryId');
        $this->reset('inputPrograms');
        $this->reset('inputDescription');
        $this->reset('inputSlots');
        $this->reset('jobActiveStatus');
        $this->selectedCategoryName = '';
        $this->joblist = true;
    }

    public function createJobList()
    {
        $this->validate([
            'inputJobList' => 'required|string|max:225',
            'selectedCategoryId' => 'required',
            'inputPrograms' => 'string|max:1024',
            'inputDescription' => 'required|string|max:5000',
            'inputSlots' => 'required|int'
        ]);

        $lastJob = OjtJobListing::where('job_ref', 'like', "OJT-{$this->company_id}-%")
            ->orderBy('id', 'desc')
            ->first();
        if ($lastJob) {
            $lastNumber = explode('-', $lastJob->job_ref)[2];
            $nextNumber = intval($lastNumber) + 1;
        } else {
            $nextNumber = 1; // If no previous job, start with 1
        }

        $uniqueNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT); // Format as 4-digit with leading zeros

        $jobData = [
            'company_id' => $this->company_id,
            'job_ref' => "OJT-{$this->company_id}-{$uniqueNumber}",
            'job_list' => $this->inputJobList,
            'job_programs' => $this->inputPrograms,
            'job_desc' => $this->inputDescription,
            'job_category' => $this->selectedCategoryId,
            'job_slots' => $this->inputSlots,
            'job_status' => $this->jobActiveStatus
        ];

        OjtJobListing::create($jobData);

        $this->reset('inputJobList');
        $this->reset('selectedCategoryId');
        $this->reset('inputPrograms');
        $this->reset('inputDescription');
        $this->reset('inputSlots');
        $this->reset('jobActiveStatus');
        $this->selectedCategoryName = '';
        $this->closeCategory();

        $this->joblist = null;
        session()->flash('status', 'Information successfully saved.');
    }
}

<?php

namespace App\Livewire;

use App\Models\OjtApplicant;
use App\Models\OjtCompany;
use App\Models\OjtJobListing;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ManageJobList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Url] public $search = '';
    #[Url] public $company;
    public $searchBar = '';
    public $byCompany = true;
    public $jobId;
    public function render()
    {
        if ($this->jobId) {
            $jobList = DB::table('ojt_job_listings')
            ->join('ojt_companies', 'ojt_job_listings.company_id', '=', 'ojt_companies.id')
            ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
            ->where('ojt_job_listings.id', $this->jobId)
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
            $jobPrograms = explode(',', $jobList->job_programs);

            $applicants = OjtApplicant::where('joblist_id', $this->jobId);

            return view('livewire.manage-job-list', [
                'jobInfo' => $jobList,
                'jobPrograms' => $jobPrograms,
                'totalApplicants' => $applicants->get()->count(),
                'acceptedApplicants' => $applicants->where('status', 1)->get()->count(),
            ]);
        }
        if ($this->company) {
            $query = OjtJobListing::query()
                ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
                ->join('ojt_companies', 'ojt_companies.id', '=', 'ojt_job_listings.company_id')
                ->select(
                    'ojt_job_listings.id',
                    'job_ref',
                    'job_list',
                    'ojt_job_list_categories.cat_name as job_category',
                    'job_status',
                    'ojt_companies.co_address as location'
                )
                ->orderBy('job_ref', 'asc')
                ->where('ojt_job_listings.company_id', $this->company);

            $jobListings = $query->paginate(5, pageName: 'jobListPage');

            $companyName = OjtCompany::query()
                ->where('id', $this->company)
                ->select('co_name', 'co_address')
                ->first();

            return view('livewire.manage-job-list', [
                'jobListings' => $jobListings,
                'companyName' => $companyName->co_name,
                'companyLocation' => $companyName->co_address,
            ]);
        }
        if (!$this->byCompany) {
            $query = OjtJobListing::query()
                ->join('ojt_companies', 'ojt_companies.id', '=', 'ojt_job_listings.company_id')
                ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
                ->select(
                    'ojt_job_listings.id',
                    'job_ref',
                    'co_name',
                    'job_list',
                    'ojt_job_list_categories.cat_name as job_category',
                    'job_status'
                );

            if ($this->search != '') {
                $searchTerm = '%' . strtolower($this->search) . '%';
                $query->whereRaw('LOWER(job_ref) LIKE ?', [$searchTerm])
                    ->orWhereRaw('LOWER(job_list) LIKE ?', [$searchTerm]);
            }

            $jobListings = $query->paginate(20, pageName: 'page');

            return view('livewire.manage-job-list', ['jobListings' => $jobListings]);
        }
        $query = OjtCompany::query()
            ->select('*');

        if ($this->search != '') {
            $searchTerm = '%' . strtolower($this->search) . '%';
            $query->whereRaw('LOWER(co_name) LIKE ?', [$searchTerm]);
        }

        $companies = $query->paginate(10, pageName: 'page');

        return view('livewire.manage-job-list', [
            'companies' => $companies,
        ]);
    }

    public function doSearch()
    {
        $this->search = $this->searchBar;
        $this->resetPage(); // Reset pagination to show results from page 1
    }
    public function selectCompany($id)
    {
        $this->company = $id;
        $this->resetPage(pageName: 'jobListPage');
    }

    public function setByCompany($value)
    {
        $this->byCompany = $value;
        $this->resetPage();
    }

    public function selectJob($id)
    {
        $this->jobId = $id;
    }
}

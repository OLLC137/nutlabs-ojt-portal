<?php

namespace App\Livewire;

use App\Models\OjtJobListCategory;
use App\Models\Public\OjtCompany;
use App\Models\Public\OjtJobListing;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ManageJobList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Url]public $search = '';
    #[Url]public $company;
    public $searchBar ='';
    public $byCompany = true;
    #[Url]public $addJobList = false;
    public $editJobList = 0;

    public $contactPeople = [];

    public $inputJobList;
    public $selectedCategoryId;
    public $inputDescription;
    public $selectedCompanyId;
    public $selectedContact;
    public $jobActiveStatus;

    public $confirmDeletion = false;

    public function mount(){
        if($this->editJobList){
            $jobList = OjtJobListing::join('ojt_companies','ojt_companies.id','=','ojt_job_listings.company_id')
            ->join('ojt_job_list_categories','ojt_job_list_categories.id','=','ojt_job_listings.job_category')
            ->where('ojt_job_listings.id', $this->editJobList)->first();

            $this->inputJobList = $jobList->job_list;
            $this->selectedCategoryId = $jobList->job_category;
            $this->selectedCategoryName = $jobList->cat_name;
            $this->inputDescription = $jobList->job_desc;
            $this->selectedCompanyId = $jobList->company_id;
            $this->selectedCompanyName = $jobList->co_name;
            $this->selectedContact = $jobList->job_person;
            $this->jobActiveStatus = $jobList->job_status;
        } else {
            $this->resetPage(pageName: 'jobListPage');
            $this->resetPage();

        }
    }


    public function render()
    {
        if($this->editJobList){
            $this->categoryGroup = OjtJobListCategory::query()
            ->select('id as id', "cat_name as name")
            ->whereRaw('LOWER(cat_name) like ?', ['%' . strtolower($this->categorySearchTerm) . '%'])
            ->get();
            $this->companyGroup = OjtCompany::query()
            ->select('id as id', "co_name as name")
            ->whereRaw('LOWER(co_name) like ?', ['%' . strtolower($this->companySearchTerm) . '%'])
            ->get();


            return view('livewire.manage-job-list');
        }
        if($this->addJobList && $this->company){
            $this->selectedCompanyId = $this->company;

            $this->selectedCompanyName = OjtCompany::query()
            ->where('id',$this->company)
            ->select('co_name')
            ->first()->co_name;

            $this->categoryGroup = OjtJobListCategory::query()
            ->select('id as id', "cat_name as name")
            ->whereRaw('LOWER(cat_name) like ?', ['%' . strtolower($this->categorySearchTerm) . '%'])
            ->get();

            return view('livewire.manage-job-list');
        }
        if($this->company){
            $query = OjtJobListing::query()
            ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
            ->select(
                'ojt_job_listings.id',
                'job_ref',
                'job_list',
                'ojt_job_list_categories.cat_name as job_category',
                'job_status')
            ->orderBy('job_ref','asc')
            ->where('ojt_job_listings.company_id', $this->company);

            $jobListings = $query->paginate(5, pageName: 'jobListPage');

            $companyName = OjtCompany::query()
            ->where('id',$this->company)
            ->select('co_name')
            ->first();

            return view('livewire.manage-job-list', ['jobListings'=>$jobListings, 'companyName'=>$companyName->co_name]);
        }
        if(!$this->byCompany){
            $query = OjtJobListing::query()
            ->join('ojt_companies','ojt_companies.id','=','ojt_job_listings.company_id')
            ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
            ->select(
                'ojt_job_listings.id',
                'job_ref',
                'co_name',
                'job_list',
                'ojt_job_list_categories.cat_name as job_category',
                'job_status')
            ->orderBy('job_ref','asc');

                if($this->search != '') {
                    $searchTerm = '%' . strtolower($this->search) . '%';
                    $query->whereRaw('LOWER(job_ref) LIKE ?', [$searchTerm])
                    ->orWhereRaw('LOWER(job_list) LIKE ?', [$searchTerm]);
                }
        
            $jobListings = $query->paginate(20, pageName: 'page');
        
            return view('livewire.manage-job-list', ['jobListings'=>$jobListings]);
        }
        if($this->addJobList){
            $this->categoryGroup = OjtJobListCategory::query()
            ->select('id as id', "cat_name as name")
            ->whereRaw('LOWER(cat_name) like ?', ['%' . strtolower($this->categorySearchTerm) . '%'])
            ->get();
            $this->companyGroup = OjtCompany::query()
            ->select('id as id', "co_name as name")
            ->whereRaw('LOWER(co_name) like ?', ['%' . strtolower($this->companySearchTerm) . '%'])
            ->get();
            return view('livewire.manage-job-list');

        }
        $query = OjtCompany::query()
        ->select('*');

        if($this->search != '') {
            $searchTerm = '%' . strtolower($this->search) . '%';
            $query->whereRaw('LOWER(co_name) LIKE ?', [$searchTerm]);
        }

        $companies = $query->paginate(10, pageName: 'page');

        return view('livewire.manage-job-list', ['companies'=>$companies]);
    }

    public function doSearch(){
        $this->search = $this->searchBar;
        $this->resetPage(); // Reset pagination to show results from page 1
    }
    public function selectCompany($id){
        $this->company = $id;
        $this->resetPage(pageName: 'jobListPage');
    }

    public function setByCompany($value){
        $this->byCompany = $value;
        $this->resetPage();
    }
    public function goToJobList(){
        $this->byCompany = true;
        $this->addJobList = true;
    }

    public function goBackAdd(){

        $this->reset('inputJobList');
        $this->reset('selectedCategoryId');
        $this->reset('inputDescription');
        $this->reset('selectedCompanyId');
        $this->reset('selectedContact');
        $this->reset('contactPeople');
        $this->selectedCompanyName = "";
        $this->selectedCategoryName = "";
        $this->closeCategory();
        $this->closeCompany();

        $this->editJobList=false;
        $this->addJobList=false;
    }
    
    public function createJobList(){
        $this->validate([
            'inputJobList' => 'required|string|max:225',
            'selectedCategoryId' => 'required',
            'inputDescription' =>'required|string|max:1024',
            'selectedCompanyId' =>'required',
            'selectedContact' => 'required'
        ]);

        $lastJob = OjtJobListing::where('job_ref','like',"OJT-{$this->selectedCompanyId}-%")
                ->orderBy('id','desc')
                ->first();
        if ($lastJob) {
            $lastNumber = explode('-', $lastJob->job_ref)[2];
            $nextNumber = intval($lastNumber) + 1;
        } else {
            $nextNumber = 1; // If no previous job, start with 1
        }

        $uniqueNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT); // Format as 4-digit with leading zeros


        $jobData = [
            'company_id' => $this->selectedCompanyId,
            'job_ref' => "OJT-{$this->selectedCompanyId}-{$uniqueNumber}",
            'job_list' => $this->inputJobList,
            'job_desc' => $this->inputDescription,
            'job_category' => $this->selectedCategoryId,
            'job_person' => $this->selectedContact,
            'job_status' => 1
        ];

        OjtJobListing::create($jobData);


        $this->reset('inputJobList');
        $this->reset('selectedCategoryId');
        $this->reset('inputDescription');
        $this->reset('selectedCompanyId');
        $this->reset('selectedContact');
        $this->selectedCategoryName = '';
        $this->selectedCompanyName = '';
        $this->closeCategory();
        $this->closeCompany();

        $this->addJobList=false;
        $this->mount();
        
        session()->flash('status', 'Information successfully saved.');
    }

    public function selectJob($id){
        $this->editJobList = $id;
        $this->mount();

    }

    // category Drop Down

    public $categoryGroup;
    public $categorySearchTerm;
    public $selectedCategoryName;

    public $isCategoryOpen = false;

    public function categoryDisplayNone(){
        if($this->isCategoryOpen) return '';
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

    // company Drop Down

    public $companyGroup;
    public $companySearchTerm;
    public $selectedCompanyName;

    public $isCompanyOpen = false;

    public function companyDisplayNone(){
        if($this->isCompanyOpen) return '';
        else return 'display: none; !important';
    }
    public function toggleCompany()
    {
        $this->isCompanyOpen = !$this->isCompanyOpen;
    }
    public function closeCompany()
    {
        $this->isCompanyOpen = false;
    }
    public function selectCompanyId($id)
    {
        $this->selectedCompanyId = $id;
        $this->selectedCompanyName = OjtCompany::query()
            ->where('id',$id)
            ->select('co_name')
            ->first()->co_name;
        $this->companySearchTerm = '';
        $this->selectedContact = null;
        $this->closeCompany();
    }

    public function updateJobList(){
        $this->validate([
            'inputJobList' => 'required|string|max:225',
            'selectedCategoryId' => 'required',
            'inputDescription' =>'required|string|max:1024',
            'selectedCompanyId' =>'required',
            'selectedContact' => 'required'
        ]);

        OjtJobListing::find($this->editJobList)
        ->update([
            'company_id' => $this->selectedCompanyId,
            'job_list' => $this->inputJobList,
            'job_desc' => $this->inputDescription,
            'job_category' => $this->selectedCategoryId,
            'job_person' => $this->selectedContact,
            'job_status' => $this->jobActiveStatus
        ]);

        $this->reset('inputJobList');
        $this->reset('selectedCategoryId');
        $this->reset('inputDescription');
        $this->reset('selectedCompanyId');
        $this->reset('selectedContact');
        $this->selectedCategoryName = '';

        $this->addJobList=false;
        $this->editJobList=null;

        $this->mount();
        session()->flash('status', 'Information successfully saved.');
    }

    public function deleteJobList(){
        $jobList = OjtJobListing::find($this->editJobList);

        if ($jobList) {
            $jobList->delete();
            session()->flash('status', 'Company Successfully Deleted.');
            $this->confirmDeletion=false;
            $this->goBackAdd();
        }
    }
}

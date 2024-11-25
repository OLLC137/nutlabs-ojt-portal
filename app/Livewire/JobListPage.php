<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
class JobListPage extends Component
{
    use WithPagination;

    #[Url] public $id;
    #[Url] public $search;
    #[Url] public $category;
    #[Url] public $location;
    #[Url] public $program;
    public $jobInfo;
    public $jobPrograms;


    public function render()
    {
        // Initial query without search filters
        $query = DB::table('ojt_job_listings')
        ->join('ojt_companies', 'ojt_job_listings.company_id', '=', 'ojt_companies.id')
        ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
        ->select(
            'ojt_job_listings.id as job_id',
            'ojt_job_listings.job_list as job_list',
            'ojt_job_listings.job_programs as job_programs',
            'ojt_job_list_categories.id as job_category_id', // Include category ID
            'ojt_job_list_categories.cat_name as job_category', // Select cat_name instead of job_category
            'ojt_job_listings.job_status as job_status',
            'ojt_companies.co_name as company_name',
            'ojt_companies.co_address as location'
        )
        ->orderBy('ojt_job_listings.job_status', 'desc');

        // Apply search filters if they exist
        if ($this->search) {
            $searchTerm = '%' . strtolower($this->search) . '%';
            $query->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(ojt_job_listings.job_list) LIKE ?', [$searchTerm])
                        ->orWhereRaw('LOWER(ojt_companies.co_name) LIKE ?', [$searchTerm]);
            });
        }
        if ($this->location) {
            $query->whereRaw('LOWER(ojt_companies.co_address) LIKE ?', ['%' . strtolower($this->location) . '%']);
        }
        if ($this->category) {
            $query->whereRaw('LOWER(ojt_job_list_categories.cat_name) = ?', [strtolower($this->category)]);
        }
        if ($this->program) {
            $programTerm = '%' . strtolower($this->program) . '%';
            $query->where(function ($query) use ($programTerm) {
                $query->whereRaw('LOWER(ojt_job_listings.job_programs) LIKE ?', [$programTerm]);
            });
        }

        // Paginate the results
        $jobListings = $query->paginate(20);

        // Check if the current page number is greater than the last page
        if ($jobListings->currentPage() > $jobListings->lastPage()) {
            abort(404); // Page not found, return 404 response
        }

        // Update job info if $this->id is set
        if ($this->id) {
            $jobExists = DB::table('ojt_job_listings')
                ->where('id', $this->id)
                ->exists();

            if (!$jobExists) {
                abort(404); // Job not found, return 404 response
            }

            $this->updateJobInfo($this->id);
        }

        return view('livewire.job-list-page', [
            'jobListings' => $jobListings
        ]);
    }

    #[On('view-job')]
    public function viewJob($id){
        $this->id = $id;
        $this->updateJobInfo($id);
    }

    #[On('search')]
    public function doSearch($search, $category, $location, $program){
        $this->search = $search;
        $this->category = $category;
        $this->location = $location;
        $this->program = $program;
        $this->id = null;

        $this->resetPage(); // Reset pagination to show results from page 1
    }

    public function applyJob($id){
        return redirect()->route('student-joblist', ['id' => $id]);
    }

    public function updateJobInfo($jobId){
        $this->jobInfo = DB::table('ojt_job_listings')
        ->join('ojt_companies', 'ojt_job_listings.company_id', '=', 'ojt_companies.id')
        ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
        ->where('ojt_job_listings.id', $jobId)
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

    public function getColorForCategoryId($categoryId) {
        // Define a list of colors
        $colors = [
            'blue', 'orange', 'yellow', 'green', 'red', 'purple', 'navy', 'green', 'gray', 'silver',
            'brown', 'black', 'pink', 'skyblue', 'gold', 'purple', 'green', 'gray', 'lightblue', 'green'
        ];

        // Calculate the index based on categoryId
        $index = ($categoryId - 1) % count($colors);

        // Build the style string with background-color and optional color
        $style = 'background-color: ' . $colors[$index] . ';';
        if (in_array($colors[$index], ['navy', 'black', 'purple', 'brown', 'blue','red','green'])) {
            $style .= ' color: white;'; // Add white text for dark backgrounds
        }

        return $style;
    }

    public function searchProgram($program){
        return redirect()->route('joblist', ['program' => $program]);
    }
}

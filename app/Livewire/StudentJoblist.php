<?php

namespace App\Livewire;

use App\Models\OjtApplicant;
use App\Models\OjtRequirement;
use App\Models\OjtDownloadable;
use App\Models\OjtJobListing;
use App\Models\OjtStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\WithPagination;

class StudentJoblist extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $category;
    public $location;
    public $program;
    public $categories;

    public function selectJob($id)
    {
        return redirect('/student-joblist/' . $id);
    }
    public function doSearch(){

    }
    public function resetSearch(){
        $this->reset(['search', 'category', 'location', 'program']);
    }
    public function render()
    {
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

        // Apply search filters if they exist
        if ($this->search) {
            $searchTerm = '%' . strtolower($this->search) . '%';
            $query->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(ojt_job_listings.job_list) LIKE ?', [$searchTerm])
                    ->orWhereRaw('LOWER(ojt_companies.co_name) LIKE ?', [$searchTerm])
                    ->orWhereRaw('LOWER(ojt_job_listings.job_ref) LIKE ?', [$searchTerm]);
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

        $this->categories = DB::table('ojt_job_list_categories')
            ->orderBy('cat_name')
            ->pluck('cat_name', 'id');
        return view('livewire.student-joblist', [
            'jobListings' => $query->paginate(10),
        ]);
    }
}

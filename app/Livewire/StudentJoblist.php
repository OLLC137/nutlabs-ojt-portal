<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;

class StudentJoblist extends Component
{
    #[Url()] public $id;
    public $jobInfo;
    public $jobPrograms;

    public $resumeSelect = 'useResume';
    public $coverSelect = 'uploadCover';

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

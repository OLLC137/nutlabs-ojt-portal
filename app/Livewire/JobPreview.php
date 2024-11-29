<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Url;


class JobPreview extends Component
{
    public $jobInfo;
    public $jobPrograms;
    #[Url] public $id;

    public function mount(){
        if($this->id == null){
            return redirect()->route('joblist');
        }
    }

    public function render()
    {
        $this->updateJobInfo($this->id);

        return view('livewire.job-preview');
    }

    public function applyJob($id){
        return redirect()->route('student-joblist-job', ['id' => $id]);
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

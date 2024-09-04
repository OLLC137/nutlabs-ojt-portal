<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Url;


class JobPreview extends Component
{
    public $jobInfo;
    #[Url] public $id = 1;

    
    public function render()
    {
        $this->updateJobInfo($this->id);

        return view('livewire.job-preview');
    }

    public function updateJobInfo($jobId){
        $this->jobInfo = DB::table('ojt_job_listings')
        ->join('ojt_companies', 'ojt_job_listings.company_id', '=', 'ojt_companies.id')
        ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
        ->join('ojt_contact_people', 'ojt_job_listings.job_person','=','ojt_contact_people.id')
        ->where('ojt_job_listings.id', $jobId)
        ->select(
            'ojt_job_listings.id as job_id', 
            'ojt_job_listings.job_list as job_list', 
            'ojt_job_list_categories.id as job_category_id', // Include category ID
            'ojt_job_list_categories.cat_name as job_category', // Select cat_name instead of job_category
            'ojt_job_listings.job_desc as job_desc',
            'ojt_job_listings.job_ref as job_ref',
            'ojt_contact_people.contact_name as job_person',
            'ojt_contact_people.contact_position as position',
            'ojt_contact_people.contact_email as job_email',
            'ojt_contact_people.contact_contact as job_contact',
            'ojt_companies.co_name as company_name',
            'ojt_companies.co_address as location'
        )
        ->first();
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
}

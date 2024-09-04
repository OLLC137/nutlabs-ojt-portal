<?php

namespace App\Livewire\Homepage;

use Livewire\Attributes\On;
use Livewire\Component;

class JobListCard extends Component
{
    public $jobId;
    public $jobList;
    public $jobCategory;
    public $categoryStyle;
    public $companyName;
    public $address;
    public $status;

    protected $listeners = ['openMobile', 'viewJob'];
    
    public function render()
    {
        return view('livewire.homepage.job-list-card');
    }
    public function mount($jobId, $jobList, $jobCategory, $categoryStyle, $companyName, $address, $status){
        $this->jobId = $jobId;
        $this->jobList = $jobList;
        $this->jobCategory = $jobCategory;
        $this->categoryStyle = $categoryStyle;
        $this->companyName = $companyName;
        $this->address = $address;
        $this->status = $status;
    }
    #[On('viewJob')]
    public function viewJob($id){
        if($this->status == 1){
            $this->dispatch('view-job', id: $id); 
        } 
    }

    #[On('openMobile')]
    public function openMobile($id){
        return redirect()->route('jobpreview', ['id' => $id]);
    }
}

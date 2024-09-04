<?php

namespace App\Livewire;

use App\Models\OjtRequirement;
use App\Models\OjtStudent;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class StudentRequirementManager extends Component
{
    public $reqId;

    #[On('confirm-submit')]
    public function confirmSubmit($id){
        $this->reqId = $id;
    }

    public function submit(){
        $this->dispatch('submit-confirmed', id: $this->reqId);
    }

    public function render(){
        return view('livewire.student-requirement-manager');
    }
}

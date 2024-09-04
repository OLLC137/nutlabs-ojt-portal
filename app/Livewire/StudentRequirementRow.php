<?php

namespace App\Livewire;

use App\Models\OjtRequirement;
use Livewire\Attributes\On;
use Livewire\Component;

class StudentRequirementRow extends Component
{
    public $reqId;
    public $requirementName;
    public $requirementStatus;
    public $requirement;
    public $studentId;
    public $isSubmitted = false;
    public $isExempted = false;

    public function mount()
    {
        $this->requirementName = OjtRequirement::REQUIREMENTS[$this->reqId];
    }

    public function render()
    {
        $this->requirement = OjtRequirement::where('student_id', $this->studentId)
                                ->where('req_id', $this->reqId)
                                ->whereNotNull('locked_at')
                                ->first();
        if($this->requirement){
            $this->isSubmitted = true;
            if($this->requirement->req_file_name == "exempted") $this->isExempted = true;
        }
        

        return view('livewire.student-requirement-row');
    }

    public function downloadFile()
    {
        $filePath = storage_path('app/' . $this->requirement->req_file_path);
        return response()->download($filePath, $this->requirement->req_orig_name);
    }

    public function deleteFile(){
        $this->dispatch('confirm-delete', id: $this->reqId);
    }

    public function unlockFile(){
        $this->dispatch('confirm-unlock', id: $this->reqId);
    }
    public function exemptFile(){
        $this->dispatch('confirm-exempt', id: $this->reqId);
    }

    #[On('delete-confirmed')]
    public function confirmedDelete($id)
    {
        if ($id == $this->reqId){
            $filePath = storage_path('app/' . $this->requirement->req_file_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Delete record from database
            $this->requirement->delete();
            // Reset variables
            $this->isSubmitted = false;
        }
    }

    #[On('unlock-confirmed')]
    public function confirmedUnlock($id)
    {
        if ($id==$this->reqId){
            if($this->requirement->req_file_name == "exempted") $this->requirement->delete();
            else $this->requirement->update(['locked_at'=>null]);

            $this->isSubmitted = false;
        }
    }
    #[On('exempt-confirmed')]
    public function confirmedExempt($id)
    {
        if ($id==$this->reqId){
            $requirement = OjtRequirement::where('student_id', $this->studentId)
            ->where('req_id', $this->reqId)
            ->first();

            if($requirement){
                $requirement->delete();
            }
            OjtRequirement::create([
                'student_id' => $this->studentId,
                'req_id' => $this->reqId,
                'req_file_name' => "exempted",
                'req_orig_name' => "exempted",
                'req_file_path' => "exempted",
                'locked_at' => now(),
            ]);

            $this->isSubmitted = true;
        }
    }
}

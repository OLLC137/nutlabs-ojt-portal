<?php

namespace App\Livewire;

use App\Models\OjtStudent;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ManageStudentFiles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $searchBar;
    #[Url]public $studentId;
    public $requirementIdBuffer;

    public function render()
    {
        $students = null;
        $student = null;
        if($this->studentId){
            $student = OjtStudent::where('id', $this->studentId)
            ->select(
                'stud_sr_code as sr_code',
                'stud_first_name as first_name',
                'stud_last_name as last_name',
                'stud_department as department',
                'stud_email as email'
            )->first();

        } else {
            $searchTerms = explode(' ', strtolower($this->searchBar));

            $students = OjtStudent::select(
                'id as id',
                'stud_sr_code as sr_code',
                'stud_first_name as first_name',
                'stud_last_name as last_name',
                'stud_department as department'
            );
            foreach ($searchTerms as $term) {
                $students = $students->where(function($query) use ($term) {
                    $query->whereRaw('LOWER(stud_first_name) like ?', ['%' . $term . '%'])
                        ->orWhereRaw('LOWER(stud_last_name) like ?', ['%' . $term . '%'])
                        ->orWhereRaw('LOWER(stud_sr_code) like ?', ['%' . $term . '%']);
                });
            }
        
            $students = $students->orderBy('sr_code', 'asc')->paginate(20);
        }
        return view('livewire.manage-student-files',['students'=>$students,'student'=>$student]);
    }

    #[On('confirm-delete')]
    public function confirmDelete($id){
        $this->requirementIdBuffer = $id;
    }   
    #[On('confirm-unlock')]
    public function confirmUnlock($id){
        $this->requirementIdBuffer = $id;
    }
    #[On('confirm-exempt')]
    public function confirmexempt($id){
        $this->requirementIdBuffer = $id;
    }

    public function delete(){
        $this->dispatch('delete-confirmed', id: $this->requirementIdBuffer);
    }
    public function unlock(){
        $this->dispatch('unlock-confirmed', id: $this->requirementIdBuffer);
    }
    public function exempt(){
        $this->dispatch('exempt-confirmed', id: $this->requirementIdBuffer);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OjtStudent;
use Livewire\WithPagination;

class DeleteCv extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchQuery = '';
    public $deleteStudentId;

    public function confirmDelete($studentId)
    {
        $this->deleteStudentId = $studentId;
    }

    public function delete()
    {
        $student = OjtStudent::find($this->deleteStudentId);

        if ($student) {

            $student -> delete();

            session()->flash('status', 'Student Successfully Archived.');

            return $this->redirect('/delete-cv-page');
        }

        // Clear the stored student id
    $this->deleteStudentId = null;
    }

    public function render()
    {
        $query = OjtStudent::query();

         // Apply search filter if search query is provided
        if (!empty($this->searchQuery)) {
            $searchQuery = strtolower($this->searchQuery);
            $query->where(function($q) use ($searchQuery) {
                $q->whereRaw('LOWER(stud_sr_code) LIKE ?', ['%' . $searchQuery . '%'])
                ->orWhereRaw('LOWER(stud_first_name) LIKE ?', ['%' . $searchQuery . '%'])
                ->orWhereRaw('LOWER(stud_last_name) LIKE ?', ['%' . $searchQuery . '%']);
            });
        }

         // Paginate results
        $students = $query->paginate(10, ['*'], 'students-page');


        return view('livewire.delete-cv', ['students' => $students]);
    }

    public function triggerSearch()
    {
        // Method to handle search button click
    }

    // Optional: add a method to clear search query
    public function clearSearch()
    {
        $this->searchQuery = '';
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Applicant;
use Livewire\WithPagination;

class ApplicantTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $searchQuery = '';
    public $applicantIdToDelete;

    public function confirmDelete($applicantId)
    {
        $this->applicantIdToDelete = $applicantId;
    }

    public function delete()
    {
        $applicant = Applicant::find($this->applicantIdToDelete);

        if ($applicant) {
            $applicant->delete();
            session()->flash('status', 'Applicant Successfully Deleted.');
        }

        $this->applicantIdToDelete = null; // Clear the stored applicant id
    }

    public function render()
    {
        $query = Applicant::query();

        if ($this->searchQuery) { // Check if searchQuery is not empty
            $searchQuery = strtolower($this->searchQuery);
            $query->where(function ($q) use ($searchQuery) {
                $q->whereRaw('LOWER(stud_first_name) LIKE ?', ['%' . $searchQuery . '%'])
                  ->orWhereRaw('LOWER(stud_last_name) LIKE ?', ['%' . $searchQuery . '%'])
                  ->orWhereRaw('LOWER(stud_sr_code) LIKE ?', ['%' . $searchQuery . '%']);
            });
        }

        $applicants = $query->paginate(10, ['*'], 'applicants-page');

        return view('livewire.applicant-table', ['applicants' => $applicants]);
    }

    public function clearSearch()
    {
        $this->searchQuery = '';
    }
}

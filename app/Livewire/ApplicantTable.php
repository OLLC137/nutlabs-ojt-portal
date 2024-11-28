<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OjtApplicant;
use Illuminate\Support\Facades\Auth;
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
        $applicant = OjtApplicant::find($this->applicantIdToDelete);

        if ($applicant) {
            $applicant->delete();
            session()->flash('status', 'Applicant Successfully Deleted.');
        }

        $this->applicantIdToDelete = null; // Clear the stored applicant id
    }

    public function render()
{
    $user = Auth::user();

    // Check if the user is a company user with role 4
    if ($user && $user->role === 4) {
        $query = OjtApplicant::where('company_id', $user->id);
    } else {
        $query = OjtApplicant::query();
    }

    if ($this->searchQuery) {
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

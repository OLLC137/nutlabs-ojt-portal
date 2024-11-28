<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;

class ApplicantTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchQuery = '';
    public $applicantIdToDelete;
    public $actionType;
    public $successMessage;

    public function search()
    {
        $this->resetPage();
    }

    public function confirmAction($applicantId, $type)
    {
        $this->applicantIdToDelete = $applicantId;
        $this->actionType = $type;
    }

    public function executeAction()
    {
        $applicant = Applicant::find($this->applicantIdToDelete);

        if ($applicant) {
            if ($this->actionType === 'accept') {
                $applicant->update(['status' => 1]);
                $this->successMessage = 'Applicant successfully accepted.';
            } elseif ($this->actionType === 'delete') {
                $applicant->delete();
                $this->successMessage = 'Applicant successfully deleted.';
            }

            $this->resetPage();
        }

        $this->applicantIdToDelete = null;
        $this->actionType = null;
    }

    public function render()
    {
        $user = Auth::user();

        $query = $user && $user->role === 4
            ? Applicant::where('company_id', $user->id)
            : Applicant::query();

        // Apply search query if it exists
        if (!empty($this->searchQuery)) {
            $searchQuery = strtolower($this->searchQuery);
            $query->whereHas('student', function ($q) use ($searchQuery) {
                $q->whereRaw('LOWER(stud_first_name) LIKE ?', ['%' . $searchQuery . '%'])
                  ->orWhereRaw('LOWER(stud_last_name) LIKE ?', ['%' . $searchQuery . '%'])
                  ->orWhereRaw('LOWER(stud_sr_code) LIKE ?', ['%' . $searchQuery . '%']);
            });
        }

        // Exclude applicants with a status of 1 (accepted)
        $applicants = $query->where('status', '!=', 1)->paginate(10, ['*'], 'applicants-page');

        return view('livewire.applicant-table', [
            'applicants' => $applicants,
        ]);
    }

    public function clearSearch()
    {
        $this->searchQuery = '';
    }
}

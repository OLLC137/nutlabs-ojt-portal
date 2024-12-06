<?php

namespace App\Livewire;

use App\Models\OjtStudent;
use App\Models\OjtCoordinator;
use App\Models\OjtAccomplishment;
use App\Models\JournalEditRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ManageJournalRequests extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchBar;
    public $acc_accomplishment;
    public $requestReason;
    public $acc_hours;
    public $requestDate;
    public $status;
    public $confirmDeletionID2;

    #[Url] public $requestId;

    public function render()
    {
        // Get the logged-in OJT Coordinator's department
        $coordinator = OjtCoordinator::where('user_id', Auth::id())->first();
        if (!$coordinator) {
            abort(403, 'Unauthorized access'); // Prevent access if the user is not an OJT Coordinator
        }
        $department = $coordinator->department;
        $searchTerms = explode(' ', strtolower($this->searchBar));

        if ($this->requestId) {
            $request = JournalEditRequest::join('ojt_students', 'journal_edit_requests.student_id', '=', 'ojt_students.id')
                ->select(
                    'journal_edit_requests.*',
                    'ojt_students.stud_first_name as first_name',
                    'ojt_students.stud_last_name as last_name',
                )
                ->where('journal_edit_requests.id', $this->requestId)->first();
            return view(
                'livewire.manage-journal-requests',
                ['request' => $request]
            );
        } else {
            $requests = JournalEditRequest::join('ojt_students', 'journal_edit_requests.student_id', '=', 'ojt_students.id')
                ->where('ojt_students.stud_department', $department) // Filter by department
                ->select(
                    'journal_edit_requests.*',
                    'ojt_students.stud_first_name as first_name',
                    'ojt_students.stud_last_name as last_name',
                    'ojt_students.stud_department as department'
                )
                ->when($searchTerms, function ($query, $searchTerms) {
                    foreach ($searchTerms as $term) {
                        $query->where(function ($q) use ($term) {
                            $q->whereRaw('LOWER(stud_first_name) like ?', ['%' . $term . '%'])
                                ->orWhereRaw('LOWER(stud_last_name) like ?', ['%' . $term . '%'])
                                ->orWhereRaw('LOWER(stud_sr_code) like ?', ['%' . $term . '%']);
                        });
                    }
                })
                ->where('status', 'pending')
                ->orderBy('requested_date', 'asc')
                ->paginate(20);

            return view('livewire.manage-journal-requests', [
                'requests' => $requests
            ]);
        }
    }

    public function acceptJournalRequest($requestId)
    {
        $journalRequest = JournalEditRequest::where('id', $requestId)->first();
        $findExisting = OjtAccomplishment::where('student_id', $journalRequest->student_id)
            ->where('acc_date', $journalRequest->requested_date)
            ->first();
        if ($journalRequest) {
            if ($findExisting) {
                $findExisting->update([
                    'acc_accomplishments' => $journalRequest->acc_accomplishments,
                    'acc_hours' => $journalRequest->acc_hours,
                ]);
            } else {
                OjtAccomplishment::create([
                    'student_id' => $journalRequest->student_id,
                    'acc_accomplishments' => $journalRequest->acc_accomplishments,
                    'acc_hours' => $journalRequest->acc_hours,
                    'acc_date' => $journalRequest->requested_date,
                ]);
            }
            $journalRequest->update(['status' => 'approved']);
            $this->reset('requestId');
            session()->flash('message', 'Journal request accepted and stored successfully.');
        } else {
            session()->flash('error', 'No valid journal request found for the student.');
        }
    }

    public function deleteJournalRequest($id)
    {
        // Fetch the latest journal request for the current student
        $journalRequest = JournalEditRequest::where('id', $id)
            ->latest()
            ->first();

        if ($journalRequest) {
            $journalRequest->delete();
            $journalRequest->update(['status' => 'rejected']);
        }
        $this->reset('requestId');
        session()->flash('message', 'Journal request rejected successfully.');
    }
}

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
    public $studentId;
    public $requirementIdBuffer;
    public $acc_accomplishment;
    public $requestReason;
    public $acc_hours;
    public $requestDate;
    public $status;
    public $confirmDeletionID2;

    public function render()
    {
        $students = null;
        $student = null;

        $this->requestReason = null; // Reset requestReason
        $this->acc_accomplishment = null;
        $this->acc_hours = null;
        $this->requestDate = null;
        // $this->status = null;

        // Get the logged-in OJT Coordinator's department
        $coordinator = OjtCoordinator::where('user_id', Auth::id())->first();
        if (!$coordinator) {
            abort(403, 'Unauthorized access'); // Prevent access if the user is not an OJT Coordinator
        }

        $department = $coordinator->department;
        if($this->studentId){
            $student = OjtStudent::where('id', $this->studentId)
            ->where('stud_department', $department) // Restrict to same department
            ->select(
                'stud_sr_code as sr_code',
                'stud_first_name as first_name',
                'stud_last_name as last_name',
                'stud_department as department',
                'stud_email as email',
            )->first();

        // Fetch the latest requestReason from the JournalEditRequest table
        $journalRequest = JournalEditRequest::where('student_id', $this->studentId)
        ->latest()
        ->first();

        if ($journalRequest) {
            $this->requestReason = $journalRequest->reason;
            $this->acc_accomplishment = $journalRequest->acc_accomplishments;
            $this->acc_hours = $journalRequest->acc_hours;
            $this->requestDate = $journalRequest->requested_date;
            $this->status = $journalRequest->status;
        }

        } else {
            $searchTerms = explode(' ', strtolower($this->searchBar));

            $students = OjtStudent::select(
                'ojt_students.id as id',
                'stud_sr_code as sr_code',
                'stud_first_name as first_name',
                'stud_last_name as last_name',
                'stud_department as department'
            )
            ->join('journal_edit_requests', 'ojt_students.id', '=', 'journal_edit_requests.student_id') // Join with journal requests
            ->where('stud_department', $department) // Filter by department
            ->when($searchTerms, function ($query, $searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->where(function ($q) use ($term) {
                        $q->whereRaw('LOWER(stud_first_name) like ?', ['%' . $term . '%'])
                            ->orWhereRaw('LOWER(stud_last_name) like ?', ['%' . $term . '%'])
                            ->orWhereRaw('LOWER(stud_sr_code) like ?', ['%' . $term . '%']);
                    });
                }
            })
            ->distinct() // Ensure no duplicate students
            ->orderBy('sr_code', 'asc')
            ->paginate(20);
            // $students = $students->orderBy('sr_code', 'asc')->paginate(20);
        }
        return view('livewire.manage-journal-requests',[
            'journal_edit_requests' => JournalEditRequest::latest(),
            'students'=>$students,
            'student'=>$student,
            // 'jobInfo' => $jobList,
        ]);
    }

    public function acceptJournalRequest($studentId)
    {
        $journalRequest = JournalEditRequest::where('student_id', $studentId)->latest()->first();

        if ($journalRequest) {
            OjtAccomplishment::create([
                'student_id' => $studentId,
                'acc_accomplishments' => $journalRequest->acc_accomplishments,
                'acc_hours' => $journalRequest->acc_hours,
                'acc_date' => now()->format('Y-m-d'),
            ]);

            $journalRequest->update(['status' => 'approved']);

            session()->flash('message', 'Journal request accepted and stored successfully.');
        } else {
            session()->flash('error', 'No valid journal request found for the student.');
        }
    }


    public function confirmDeletion($studentId){
        $this->confirmDeletionID2 = $studentId;

    }

    public function deleteJournalRequest()
    {
        // Fetch the latest journal request for the current student
        $journalRequest = JournalEditRequest::where('student_id', $this->confirmDeletionID2)
        ->latest()
        ->first();

        if ($journalRequest) {
            $journalRequest->delete();
            $journalRequest->update(['status' => 'rejected']);

            $remainingRequests = JournalEditRequest::where('student_id', $this->confirmDeletionID2)->count();

            if ($remainingRequests == 0) {
                $this->removeStudentFromList($this->confirmDeletionID2);
                session()->flash('message', 'Journal request deleted successfully, and no more requests are left for this student.');
            } else {
                session()->flash('message', 'Journal request deleted successfully.');
            }
            // $this->studentId = $this->studentId->filter(function ($studentId) {
            //     return $studentId->id !== $this->confirmDeletionID;
            // });
            session()->flash('message', 'Journal request deleted successfully.');
        } else {
            session()->flash('error', 'Journal request not found.');
        }

        $this->confirmDeletionID2 = null;
    }
    public function removeStudentFromList($studentId)
    {
        $this->studentId = $this->studentId->filter(function ($student) use ($studentId) {
            return $student->id !== $studentId;
        });

        $this->resetPage();
    }
}

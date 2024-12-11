<?php

namespace App\Livewire;

use App\Models\OjtStudent;
use App\Models\JournalEditRequest;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class JournalRequest extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $student_id;
    public $acc_accomplishments;
    public $acc_hours;
    public $requestDate;
    public $requestReason;

    public $editID;
    public $confirmDeletionID;

    protected $rules = [
        'acc_hours' => 'required|numeric|min:1',
        'acc_accomplishments' => 'required|min:10|max:255',
        'requestDate' => 'required|date|before:today',
        'requestReason' => 'required|min:10|max:255',
    ];

    public function create()
    {
        $this->validate([
            'requestDate' => 'required|date|before:today',
            'requestReason' => 'required|min:10|max:255',
            'acc_accomplishments' => 'required|min:10|max:255',
            'acc_hours' => 'required|numeric|min:1',
        ]);

        JournalEditRequest::create([
            'student_id' => $this->student_id,
            'requested_date' => $this->requestDate,
            'reason' => $this->requestReason,
            'acc_accomplishments' => $this->acc_accomplishments,
            'acc_hours' => $this->acc_hours
        ]);

        return redirect('/request')->with('message', 'Request submitted to OJT Coordinator.');
    }
    public function mount()
    {
        $currentUserId = Auth::id();
        $student = OjtStudent::where('user_id', $currentUserId)->first();
        $this->student_id = $student ? $student->id : null;

        if (session()->has('editID')) {
            $this->editID = session('editID');
        }
        if ($this->editID) {
            $accomplishment = JournalEditRequest::where('id', $this->editID)->first();
            $this->acc_accomplishments = $accomplishment->acc_accomplishments;
            $this->requestDate = $accomplishment->requested_date;
            $this->acc_hours = $accomplishment->acc_hours;
            $this->requestReason = $accomplishment->reason;
        }
    }

    public function updateRequest($id)
    {
        return redirect('/request')->with('editID', $id);
    }
    public function cancelEdit()
    {
        return redirect('/request');
    }
    public function editRequest()
    {
        $this->validate([
            'requestDate' => 'required|date|before:today',
            'requestReason' => 'required|min:10|max:255',
            'acc_accomplishments' => 'required|min:10|max:255',
            'acc_hours' => 'required|numeric|min:1',
        ]);
        JournalEditRequest::where('student_id', $this->student_id)
            ->where('id', $this->editID)
            ->first()
            ->update([
                'requested_date' => $this->requestDate,
                'reason' => $this->requestReason,
                'acc_accomplishments' => $this->acc_accomplishments,
                'acc_hours' => $this->acc_hours,
                'status' => 'pending'
            ]);

        return redirect('/request')->with('message', 'Request Updated.');
    }
    public function confirmDelete($id)
    {
        $this->confirmDeletionID = $id;
    }
    public function deleteAccomplishment()
    {
        JournalEditRequest::find($this->confirmDeletionID)->delete();
        return redirect('/request')->with('message', 'Accomplishment Deleted.');
    }
    public function render()
    {
        $requests = JournalEditRequest::where('student_id', $this->student_id)
            ->whereIn('status', ['pending', 'rejected'])
            ->orderBy('requested_date', 'desc')
            ->paginate(5);

        return view('livewire.journal-request', [
            'requests' => $requests
        ]);
    }
}

<?php

namespace App\Livewire;

use App\Models\OjtStudent;
use App\Models\JournalEditRequest;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class JournalRequest extends Component
{
    public $student_id;
    public $acc_accomplishments;
    public $acc_hours;
    public $requestDate;
    public $requestReason;
    public $status;

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

    public function updateStatus()
    {
        $this->validate([
            'status' => [
                'required',
                Rule::in(['Pending', 'Rejected', 'Approved'])
            ],
        ]);

        $request = JournalEditRequest::findOrFail($this->requestId);
        $request->update([
            'status' => $this->status,
            'updated_at' => now(),
        ]);

        session()->flash('message', 'Status updated successfully!');
    }

    public function mount()
    {
        $currentUserId = Auth::id();
        $student = OjtStudent::where('user_id', $currentUserId)->first();
        $this->student_id = $student ? $student->id : null;

        if (session()->has('editID')) {
            $editID = session('editID');
            $journalPost = \App\Models\OjtAccomplishment::where('id', $editID)
            ->where('student_id', $this->student_id)
            ->first();

        if ($journalPost) {
            $this->acc_accomplishments = $journalPost->acc_accomplishments;
            $this->acc_hours = $journalPost->acc_hours;
            $this->requestDate = $journalPost->acc_date;
        }
        }

        // $this->requestDate = now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.journal-request');
    }
}

<?php

namespace App\Livewire;

use App\Models\JournalEditRequest;
use Livewire\Component;

class JournalRequest extends Component
{
    public $acc_date;
    public $editID;
    public $requestDate;
    public $requestReason;

    protected $rules = [
        'requestDate' => 'required|date|before:today',
        'requestReason' => 'required|min:10|max:255',
    ];

    public function requestEditForPreviousDay()
    {
        $this->validate([
            'requestDate' => 'required|date|before:today',
            'requestReason' => 'required|min:10|max:255',
        ]);

        JournalEditRequest::create([
            'student_id' => $this->student_id,
            'requested_date' => $this->requestDate,
            'reason' => $this->requestReason,
            'status' => 'pending',
        ]);

        $this->reset(['requestDate', 'requestReason']);

        session()->flash('message', 'Request submitted to OJT Coordinator.');
    }


    public function render()
    {
        return view('livewire.journal-request');
    }
}

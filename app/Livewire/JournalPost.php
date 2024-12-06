<?php

namespace App\Livewire;

use App\Models\OjtAccomplishment;
use App\Models\OjtStudent;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class JournalPost extends Component
{
    public $acc_accomplishments;
    public $acc_date;
    public $acc_hours;
    public $student_id;
    public $search;
    public $editID;
    public $editTextField;

    public $confirmDeletionID;

    public $isTodayDone;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'student_id' => 'required',
        'acc_date' => 'required|date',
        'acc_accomplishments' => 'required|min:10|max:255',
        'acc_hours' => 'required|numeric|min:1',
    ];
    public function create()
    {
        $validated = $this->validate();
        OjtAccomplishment::create($validated);

        return redirect('/posting')->with('message', 'Accomplishment Saved.');
    }

    public function mount()
    {
        $currentUserId = Auth::id();
        $student = OjtStudent::where('user_id', $currentUserId)->first();
        $this->student_id = $student ? $student->id : null;

        $this->acc_date = now()->format('Y-m-d');
        if (session()->has('editID')) {
            $this->editID = session('editID');
        }
        if ($this->editID) {
            $accomplishment = OjtAccomplishment::where('id', $this->editID)->first();
            $this->acc_accomplishments = $accomplishment->acc_accomplishments;
            $this->acc_date = $accomplishment->acc_date;
            $this->acc_hours = $accomplishment->acc_hours;
        }
    }

    public function updateJournalPost($journal_postsID)
    {
        $journal = OjtAccomplishment::where('id', $journal_postsID)->first();
        if ($journal->acc_date == now()->format('Y-m-d'))
            return redirect('/posting')->with('editID', $journal_postsID);
        else
            return redirect('/request')->with('editID', $journal_postsID);
    }

    public function confirmDeletion($id)
    {
        $this->confirmDeletionID = $id;
    }
    public function deleteJournalPost()
    {
        OjtAccomplishment::find($this->confirmDeletionID)->delete();
        return redirect('/posting')->with('message', 'Accomplishment Deleted.');
    }

    public function cancelEdit()
    {
        return redirect('/posting');
    }

    public function editJournal()
    {
        $validated = $this->validate();
        OjtAccomplishment::where('student_id', $this->student_id)
            ->where('id', $this->editID)
            ->first()
            ->update($validated);

        return redirect('/posting')->with('message', 'Accomplishment Updated.');
    }

    public function checkToday()
    {
        if (OjtAccomplishment::where('student_id', $this->student_id)
            ->where('acc_date', now()->format('Y-m-d'))
            ->exists()
        ) return true;
        else return false;
    }

    public function render()
    {
        if (!$this->editID)
            $this->isTodayDone = $this->checkToday();

        return view('livewire.journal-post', [
            'ojt_accomplishments' => OjtAccomplishment::where('student_id', $this->student_id)
                ->orderBy('acc_date', 'desc')
                ->where('acc_accomplishments', 'like', "%{$this->search}%")
                ->paginate(3)
        ]);
    }
}

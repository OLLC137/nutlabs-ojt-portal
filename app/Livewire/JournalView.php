<?php

namespace App\Livewire;

use App\Models\JournalPost;
use App\Models\OjtAccomplishment;
use App\Models\OjtStudent;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class JournalView extends Component
{
    public $categories=10;
    
    public function render()
    {
        $currentUserId = Auth::id();
        
        $student = OjtStudent::where('user_id', $currentUserId)->first();
        
        $studentId = $student ? $student->id : 0; 

        $accomplishments = OjtAccomplishment::with('student')
            ->where('student_id', $studentId)
            ->get();

        $journal_posts = OjtAccomplishment::where('student_id', $studentId)
            ->oldest()
            ->get();

        return view('livewire.journal-view', [
            'student' => $student,
            'ojt_accomplishments' => $journal_posts,
            'accomplishments' => $accomplishments,
        ]);
    }
}

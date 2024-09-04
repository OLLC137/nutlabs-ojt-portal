<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OjtStudent;
use App\Models\OjtRequirement;
use Illuminate\Support\Facades\DB;

class OngoingIntern extends Component
{
    public $intern;
    public $totalOngoingInterns;

    public function mount()
{
    // Subquery to find students who have completed all 10 requirements
    $studentsWithAllRequirements = OjtStudent::select('ojt_students.id')
        ->join('ojt_requirements', 'ojt_students.id', '=', 'ojt_requirements.student_id')
        ->whereIn('ojt_requirements.req_id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
        ->whereNotNull('ojt_requirements.locked_at') // Only include locked requirements
        ->groupBy('ojt_students.id')
        ->havingRaw('COUNT(DISTINCT ojt_requirements.req_id) = 10');

    // Main query to count the number of students per department who have completed all 10 requirements
    $this->intern = OjtStudent::select('stud_department', DB::raw('COUNT(*) as students_count'))
        ->whereIn('id', $studentsWithAllRequirements)
        ->groupBy('stud_department')
        ->get()
        ->map(function ($item) {
            return [
                'department' => $item->stud_department,
                'students_count' => $item->students_count
            ];
        })
        ->toArray();
         // Calculate the total number of ongoing interns
         $this->totalOngoingInterns = array_sum(array_column($this->intern, 'students_count'));
}

    public function render()
    {
        return view('livewire.ongoing-intern', ['intern' => $this->intern, 'totalOngoingInterns' => $this->totalOngoingInterns]);
    }
}

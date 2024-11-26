<?php

namespace App\Livewire;

use App\Models\OjtStudent;
use App\Models\OjtCoordinator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ManageStudentFiles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchBar;
    public $studentId;
    public $requirementIdBuffer;

    public function render()
    {
        $students = null;
        $student = null;

        // Get the logged-in OJT Coordinator's department
        $coordinator = OjtCoordinator::where('user_id', Auth::id())->first();
        if (!$coordinator) {
            abort(403, 'Unauthorized access'); // Prevent access if the user is not an OJT Coordinator
        }

        $department = $coordinator->department;

        if ($this->studentId) {
            $student = OjtStudent::where('id', $this->studentId)
                ->where('stud_department', $department) // Restrict to same department
                ->select(
                    'stud_sr_code as sr_code',
                    'stud_first_name as first_name',
                    'stud_last_name as last_name',
                    'stud_department as department',
                    'stud_email as email'
                )
                ->first();
        } else {
            $searchTerms = explode(' ', strtolower($this->searchBar));

            $students = OjtStudent::select(
                'id as id',
                'stud_sr_code as sr_code',
                'stud_first_name as first_name',
                'stud_last_name as last_name',
                'stud_department as department'
            )
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
                ->orderBy('sr_code', 'asc')
                ->paginate(20);
        }

        return view('livewire.manage-student-files', ['students' => $students, 'student' => $student]);
    }

    // Other methods remain unchanged
}

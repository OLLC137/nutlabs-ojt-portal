<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OjtStudent;
use Illuminate\Support\Facades\DB;

class DepartmentEnrolled extends Component
{
    public $departments;

    public function mount()
    {
        $this->departments = OjtStudent::select('stud_department', DB::raw('COUNT(*) as students_count'))
            ->groupBy('stud_department')
            ->get()
            ->map(function ($item) {
                return [
                    'department' => $item->stud_department,
                    'students_count' => $item->students_count
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.department-enrolled');
    }
}

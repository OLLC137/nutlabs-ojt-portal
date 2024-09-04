<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OjtRequirement;
use Illuminate\Support\Facades\DB;

class PendingRequirements extends Component
{
    public $pendingRequirements = [];

    public function mount()
    {
        $this->fetchPendingRequirements();
    }

    public function fetchPendingRequirements()
    {
        // Fetch the total number of students
        $totalStudents = DB::table('ojt_students')->count();

        // Fetch the count of students who have uploaded each requirement
        $uploadedCounts = OjtRequirement::select('req_id', DB::raw('count(*) as count'))
        ->whereNotNull('ojt_requirements.locked_at')
        ->groupBy('req_id')
        ->pluck('count', 'req_id')
        ->toArray();

        // Calculate pending counts for each requirement
        foreach (OjtRequirement::REQUIREMENTS as $id => $name) {
            $uploadedCount = $uploadedCounts[$id] ?? 0;
            $this->pendingRequirements[$id] = $totalStudents - $uploadedCount;
        }
    }

    public function render()
    {
        return view('livewire.pending-requirements', [
            'pendingRequirements' => $this->pendingRequirements
        ]);
    }
}

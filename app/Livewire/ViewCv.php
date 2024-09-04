<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OjtStudent;
use Illuminate\Support\Facades\Auth;

class ViewCv extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $roleMap = [
        0 => 'Super Administrator',
        1 => 'Admin',
        2 => 'OJT_Head',
        3 => 'OJT_Coordinator',
        20 => 'Student',
    ];

    public $searchQuery = '';

    public function mount()
    {
        // Optional: any initialization logic if needed
    }

    public function render()
    {
        $currentUser = Auth::user();
        $userRoleInteger = $currentUser->role;
        $userRole = $this->roleMap[$userRoleInteger] ?? 'Unknown';

        $query = OjtStudent::query();

        // Apply restrictions based on the mapped role
        if ($userRole === 'Student') {
            $query->where('user_id', $currentUser->id);
        }

       // Apply search filter if search query is provided
        if (!empty($this->searchQuery)) {
        $searchQuery = strtolower($this->searchQuery);
        $query->where(function($q) use ($searchQuery) {
            $q->whereRaw('LOWER(stud_sr_code) LIKE ?', ['%' . $searchQuery . '%'])
            ->orWhereRaw('LOWER(stud_first_name) LIKE ?', ['%' . $searchQuery . '%'])
            ->orWhereRaw('LOWER(stud_last_name) LIKE ?', ['%' . $searchQuery . '%']);
        });
    }

        $query->orderBy('id');

        // Paginate results
        $students = $query->paginate(10, ['*'], 'students-page');


        return view('livewire.view-cv', ['students' => $students]);
    }

    public function triggerSearch()
    {
        // Method to handle search button click
    }

    // Optional: add a method to clear search query
    public function clearSearch()
    {
        $this->searchQuery = '';
    }
}

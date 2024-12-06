<?php

namespace App\Livewire;

use App\Models\OjtRequirement;
use App\Models\OjtStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

use Livewire\WithFileUploads;

class RequirementCard extends Component
{
    use WithFileUploads;

    public $reqId;
    public $requirement;
    public $requirementFile;
    public $isUploaded = false;
    public $filename;
    public $isLocked = false;
    public $isExempted = false;
    public $fileUrl;

    protected $listeners = ['fileUploaded' => '$refresh'];

    public function uploadFile()
    {
        $this->validate([
            'requirementFile' => 'required|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        // Get the original file name
        $originalFileName = $this->requirementFile->getClientOriginalName();

        // Store the file and get the file path
        $filePath = $this->requirementFile->store('intern_files', 'public');

        $fileUrl = asset('storage/' . $filePath);

        // Get the updated file name (hashed name)
        $updatedFileName = basename($filePath);

        $currentUserId = Auth::id(); //get user id
        $student = OjtStudent::where('user_id', $currentUserId)->first(); //get student from user id
        $studentId = $student ? $student->id : null; //get student id from stuent

        OjtRequirement::create([
            'student_id' => $studentId,
            'req_id' => $this->reqId,
            'req_file_name' => $updatedFileName,
            'req_orig_name' => $originalFileName,
            'req_file_path' => $filePath,
            'req_file_url' => $fileUrl
        ]);
    }

    public function mount($reqId = null)
    {
        $this->reqId = $reqId;
        $this->requirement = OjtRequirement::REQUIREMENTS[$reqId];
    }

    public function downloadFile()
    {
        $currentUserId = Auth::id();
        $student = OjtStudent::where('user_id', $currentUserId)->first();
        $studentId = $student->id;
        $requirement = OjtRequirement::where('student_id', $studentId)
            ->where('req_id', $this->reqId)
            ->first();

        $filePath = storage_path('app/public/' . $requirement->req_file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $requirement->req_orig_name);
    }

    public function deleteFile()
    {
        $currentUserId = Auth::id();
        $student = OjtStudent::where('user_id', $currentUserId)->first();
        $studentId = $student->id;
        $requirement = OjtRequirement::where('student_id', $studentId)
            ->where('req_id', $this->reqId)
            ->first();

        if (Storage::disk('public')->exists($requirement->req_file_path)) {
            // Delete the file
            Storage::disk('public')->delete($requirement->req_file_path);
        }

        // Delete record from database
        $requirement->delete();

        // Reset variables
        $this->isUploaded = false;
        $this->filename = null;
        $this->reset('requirementFile');
        $this->dispatch('requirementRemoved', id: $this->reqId);
    }

    public function submit()
    {
        $this->dispatch('confirm-submit', id: $this->reqId);
    }

    #[On('submit-confirmed')]
    public function confirmedSubmit($id)
    {
        if ($id == $this->reqId) {
            $currentUserId = Auth::id(); //get user id
            $student = OjtStudent::where('user_id', $currentUserId)->first(); //get student from user id
            $studentId = $student ? $student->id : null; //get student id from student
            $requirement = OjtRequirement::where('student_id', $studentId)
                ->where('req_id', $this->reqId)
                ->first(); // Get the requirement

            $requirement->update(['locked_at' => now()]);
            $this->isLocked = true;
        }
    }


    public function render()
    {
        $currentUserId = Auth::id(); // Get the current user ID of logged in person
        $student = OjtStudent::where('user_id', $currentUserId)->first(); // Get the student associated with the user

        $studentId = $student->id; // Get the student ID
        $requirement = OjtRequirement::where('student_id', $studentId)
            ->where('req_id', $this->reqId)
            ->first(); // Get the requirement

        if ($requirement) {
            // Requirement exists, set the filename to original file name
            $this->filename = $requirement->req_orig_name;
            $this->isUploaded = true;
            $this->fileUrl = $requirement->req_file_url;
            $this->dispatch('hasRequirement', id: $this->reqId);
            if ($requirement->locked_at) $this->isLocked = true;
            if ($requirement->req_file_name == "exempted") $this->isExempted = true;
        } else {
            // Requirement does not exist
            $this->isUploaded = false;
            $this->filename = null;
        }

        return view('livewire.requirement-card');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\OjtCompanyFile;
use App\Models\Public\OjtCompany;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CompanyFilesUpload extends Component
{
    use WithPagination, WithFileUploads;

    public $fileName;
    public $requirementFile;
    public $selectedCompany;
    public $fileIdToDelete;
    public $companyList = OjtCompany::class;

    protected $rules = [
        'fileName' => 'required|string|max:255',
        'requirementFile' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        'selectedCompany' => 'required|exists:ojt_companies,id',
    ];

    protected $listeners = ['categorySelected' => 'setSelectedCompany'];

    public function mount()
    {
        $this->selectedCompany = Session::get('selectedCompany', '');
    }

    public function setSelectedCompany($companyId)
    {
        $this->selectedCompany = $companyId;
        Session::put('selectedCompany', $companyId);
        $this->loadCompanyFiles();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'selectedCompany') {
            Session::put('selectedCompany', $this->selectedCompany);
            $this->loadCompanyFiles();
        }
    }

    public function loadCompanyFiles()
    {
        $this->resetPage();
    }

    public function uploadFile()
    {
        try {
            $this->validate();
            // Get the original file name
            $originalFileName = $this->requirementFile->getClientOriginalName();
            // Store the file and get the stored file name and path
            $filePath = $this->requirementFile->store('company-files');
            $storedFileName = basename($filePath);
            $userId = Auth::id();
            // Create a new file record in the database
            OjtCompanyFile::create([
                'file_name' => $storedFileName, // Store the actual file name
                'file_path' => $filePath, // Store the file path
                'file_type' => $this->fileName, // Use the input field value as file type
                'file_original_name' => $originalFileName, // Add the original file name here
                'company_id' => $this->selectedCompany,
                'uploaded_by' => $userId,
            ]);
            $this->reset(['fileName', 'requirementFile']);
            $this->dispatch('saved');
            $this->loadCompanyFiles(); // Reload files after upload
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('validation-error');
            throw $e;
        }
    }
    public function confirmDelete($fileId)
    {
        $this->fileIdToDelete = $fileId;
    }

    public function deleteFile()
{
    $file = OjtCompanyFile::find($this->fileIdToDelete);

    if ($file) {
        // Delete the file from the storage
        Storage::delete($file->file_path);

        // Check if the file exists in livewire-tmp and delete it
        $tmpFilePath = 'livewire-tmp/' . basename($file->file_path);
        if (Storage::exists($tmpFilePath)) {
            Storage::delete($tmpFilePath);
        }

        // Delete the file record from the database
        $file->delete();

        session()->flash('status', 'File Successfully Deleted.');
    }

    // Clear the stored file id
    $this->fileIdToDelete = null;
}
    public function downloadFile($fileId)
    {
        $file = OjtCompanyFile::findOrFail($fileId);
        return Storage::download($file->file_path, $file->file_original_name);
    }

    public function render()
    {
        $companies = OjtCompany::all();
        $ojt_company_files = collect();

        if ($this->selectedCompany) {
            $ojt_company_files = OjtCompanyFile::where('company_id', $this->selectedCompany)->latest()->get();
        }

        return view('livewire.company-files-upload', [
            'ojt_company_files' => $ojt_company_files,
            'companies' => $companies
        ]);
    }
}

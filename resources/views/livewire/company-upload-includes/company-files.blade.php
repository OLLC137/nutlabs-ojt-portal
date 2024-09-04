<div class="col-md-12 grid-margin stretch-card">
    
    <div class="shadow p-3 mb-5 bg-white rounded m-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="company_file_name mb-0">{{ $company_file->file_type }}</h3>
                
            </div>
            <p class="original-file-name-head text-left mb-1 fw-bold">Original Name:</p>
            <div class="original-file-name-text text-left mb-1">{{ $company_file->file_original_name }}</div>
            <div class="file-path-text text-left mb-1 fw-bold">File path:</div>
            <p class="text-left mb-3 fst-italic fs-15">{{ $company_file->file_path }}<i class="mdi mdi-file"></i></p>
            
            <div class="d-flex justify-content-center flex-wrap">
                <button class="btn btn-success btn-icon-text btn-sm mx-2 my-1" wire:click="downloadFile({{ $company_file->id }})">
                    Download
                    <i class="mdi mdi-download btn-icon-append"></i>
                </button>
                <button class="btn btn-danger btn-icon-text btn-sm mx-2 my-1"  data-bs-toggle="modal" data-bs-target="#deleteModal2" wire:click="confirmDelete({{ $company_file->id }})">
                    Delete
                    <i class="mdi mdi-delete-forever btn-icon-append"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container company-upload-file-container">
    <select class="form-select mb-3 w-25" wire:model.lazy="selectedCompany" aria-label=".form-select-lg example">
        <option selected value="">Select Company</option>
        @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->co_name }}</option>
        @endforeach
    </select>

    @if (!$selectedCompany)
        <div class="alert alert-info">
            Select a company to view.
        </div>
    @else
        <div class="company-upload-section d-flex flex-row h-1 ms-0">
            <div class="upload-file mx-2 mt-3 d-flex flex-row">
                <input class="company-upload-file-box bg-light form-control" type="file"
                    wire:model.defer="requirementFile" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
            </div>
            <div class="company-file-name-box mt-3">
                <input wire:model.defer="fileName" class="form-control" placeholder="File name">
            </div>
            <button wire:click="uploadFile" class="btn btn-danger mt-3" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="uploadFile">Upload</span>
                <span wire:loading wire:target="uploadFile">Uploading...</span>
            </button>
        </div>

        <div x-data="{ show: false }" x-show.transition.opacity.duration.1500ms="show" x-init="$wire.on('saved', () => {
            show = true;
            setTimeout(() => { show = false; }, 4000)
        })">
            <div class="mt-3 alert alert-success">
                File Uploaded Successfully.
            </div>
        </div>

        <div x-data="{ showError: false }" x-show.transition.opacity.duration.1500ms="showError" x-init="$wire.on('validation-error', () => {
            showError = true;
            setTimeout(() => { showError = false; }, 4000)
        })">
            @error('fileName')
                <div class="mt-3 alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
            @enderror
            @error('requirementFile')
                <div class="mt-3 alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="card mt-3">
            <div class="card-body p-5">
                @if ($ojt_company_files->isEmpty())
                    <div class="alert alert-info">
                        This company doesn't have any files.
                    </div>
                @else
                    <div class="row mt-4">
                        @foreach ($ojt_company_files as $company_file)
                            <div class="col d-flex align-items-stretch">
                                @include('livewire.company-upload-includes.company-files', [
                                    'company_file' => $company_file,
                                ])
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div wire:ignore.self class="modal fade" id="deleteModal2" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to delete this file?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.stop="deleteFile" class="btn btn-danger" data-bs-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

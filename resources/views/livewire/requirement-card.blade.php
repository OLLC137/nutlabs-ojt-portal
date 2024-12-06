<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4>
                {{ $requirement }}
                @if ($isLocked)
                    <x-template.icon>lock</x-template>
                @endif
            </h4>
            @if (!$isUploaded)
                <form wire:submit.prevent="uploadFile">
                    <x-template.input type="file" text="" wire:model="requirementFile"
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></x-template.input>
                    <button class="btn btn-primary btn-icon-text btn-sm" type="submit" color="primary">
                        Upload
                        <i class="mdi mdi-upload btn-icon-append"></i>
                    </button>
                    @error('requirementFile')
                        <div class="mt-2 alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </form>
            @elseif($isExempted)
                <div class="alert alert-info">This requirement is exempted by your OJT coordinator.</div>
            @else
                <p>{{ $filename }} <i class="mdi mdi-file"></i></p>
                <button class="btn btn-info btn-icon-text btn-sm" color="primary" wire:click="downloadFile">
                    Download
                    <i class="mdi mdi-download btn-icon-append"></i>
                </button>
                {{$test}}
                <a href={{$fileUrl}} target="_blank">
                    <button class="btn btn-info btn-icon-text btn-sm" color="primary">
                        <i class="mdi mdi-eye btn-icon"></i>
                    </button>
                </a>
                @if (!$isLocked)
                    <button class="btn btn-primary btn-icon-text btn-sm" color="primary" wire:click="deleteFile">
                        Delete
                        <i class="mdi mdi-delete-forever btn-icon-append"></i>
                    </button>
                @endif
            @endif
        </div>
        @if (!$isLocked && $isUploaded)
            <div class="pb-4 px-3 d-flex">
                <button wire:click="submit" class="col btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#submitModal">Submit</button>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.transition = "opacity 0.5s";
                flashMessage.style.opacity = 0;
                setTimeout(function() {
                    flashMessage.remove();
                }, 500);
            }
        }, 3000);
    });
</script>

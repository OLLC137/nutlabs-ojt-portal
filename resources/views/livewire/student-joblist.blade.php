<div>
    @if (!$id)
        <h1>Job Listings</h1>
    @else
        <button wire:click='$set("id", null)' class="btn btn-primary btn-icon-text btn-small mb-2">
            <x-template.icon class="btn-icon-prepend">subdirectory-arrow-left</x-template.icon>
            back
        </button>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 p-4 border">
                            <div class="d-flex align-items-center justify-content-between">
                                <h1>{{ $jobInfo->job_list }}</h1>
                                <h4 class="bg-primary text-white p-1 rounded">{{ $jobInfo->job_category }}</h4>
                            </div>
                            <p class="display-5 font-weight-bold mb-0">{{ $jobInfo->company_name }}</p>
                            <p class="">
                                <x-template.icon>map-marker-outline</x-template.icon>
                                {{ $jobInfo->location }}
                            </p>
                            <div class="mb-4">
                                {!! $jobInfo->job_desc !!}
                            </div>
                            @if (!empty($jobPrograms) && count(array_filter($jobPrograms)) > 0)
                                <p class="font-weight-bold">Recommended Programs</p>
                                <div class="d-flex flex-row text-white flex-wrap">
                                    @foreach ($jobPrograms as $program)
                                        <p class="bg-secondary p-1 mx-1 rounded">
                                            <x-template.icon>tag-outline</x-template.icon>
                                            {{ $program }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-xl-6 p-4 border">
                            <div class="mb-4">
                                <h2>Resumé</h2>
                                <div class="my-0" wire:click="$set('resumeSelect', 1)">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="resumeSelect"
                                            value=1>
                                        Use resumé from requirements
                                    </label>
                                </div>
                                @if ($resumeSelect == 1)
                                    <div class="d-flex mt-2 px-4">
                                        <p class="font-weight-bold">
                                            @if ($selectedResumeFileName)
                                                {{ $selectedResumeFileName }}
                                                <x-template.icon>file</x-template.icon>
                                            @else
                                                No Uploaded Resume
                                            @endif
                                        </p>
                                    </div>
                                @endif
                                <div class="my-0" wire:click="$set('resumeSelect', 2)">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="resumeSelect"
                                            value=2>
                                        Upload new resumé
                                    </label>
                                </div>
                                @if ($resumeSelect == 2)
                                    <div class="d-inline-flex flex-column  mt-2 px-4">
                                        @if ($temporaryUploadedResume)
                                            <span
                                                class="font-weight-bold">{{ $originalResumeName }}<x-template.icon>file</x-template.icon></span>
                                            <span class="mb-4 mt-2" role="button"
                                                wire:click='clearResumeFile '><u>Upload New File</u></span>
                                        @else
                                            <x-template.input type="file" text="" wire:model="resumeFile"
                                                class="mb-1" accept=".doc, .docx, .pdf"
                                                style=""></x-template.input>
                                            <p style="font-size: 12px" class="mt-0">Accepted file types: .doc, .docx,
                                                .pdf (2MB limit).</p>
                                        @endif
                                        @error('resumeFile')
                                            <span class="error">
                                                Make sure the file is of correct type and under 2MB.
                                            </span>
                                        @enderror
                                    </div>
                                @endif
                                <div class="my-0" wire:click="$set('resumeSelect', 3)">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="resumeSelect"
                                            value=3>
                                        Do not include a resumé
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h2>Cover Letter</h2>
                                <div class="my-0" wire:click="$set('coverSelect', 1)">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="coverSelect" value=1>
                                        Upload Cover Letter
                                    </label>
                                </div>
                                @if ($coverSelect == 1)
                                    <div class="d-inline-flex flex-column  mt-2 px-4">
                                        @if ($temporaryUploadedCover)
                                            <span
                                                class="font-weight-bold">{{ $originalCoverName }}<x-template.icon>file</x-template.icon></span>
                                            <span class="mb-4 mt-2" role="button"
                                                wire:click='clearCoverFile '><u>Upload New File</u></span>
                                        @else
                                            <x-template.input type="file" text="" wire:model="coverFile"
                                                accept=".doc, .docx, .pdf"
                                                style=""></x-template.input>
                                            <p style="font-size: 12px" class="mt-0">Accepted file types: .doc, .docx,
                                                .pdf (2MB limit).</p>
                                        @endif
                                        @error('coverFile')
                                            <span class="error">
                                                Make sure the file is of correct type and under 2MB.
                                            </span>
                                        @enderror
                                    </div>
                                @endif
                                <div class="my-0" wire:click="$set('coverSelect', 2)">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="coverSelect" value=2>
                                        Write a Cover Letter
                                    </label>
                                </div>
                                @if ($coverSelect == 2)
                                    <div class="d-flex mt-2 px-4">
                                        <textarea class="form-control" wire:model="writeCover" rows="10"></textarea>
                                    </div>
                                    @error('writeCover')
                                        <span class="error">Please write your cover letter here.</span>
                                    @enderror
                                @endif
                                <div class="my-0" wire:click="$set('coverSelect', 3)">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="coverSelect" value=3>
                                        Do not include a Cover Letter
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button wire:click="submitApplication" class="btn btn-success"
                                    @disabled(!$this->submittable())>Submit Application</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

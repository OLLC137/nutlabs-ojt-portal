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
                            <div>
                                <p class="font-weight-bold">Provided Files</p>
                                <div class="d-block">
                                    <button
                                        class="btn btn-sm btn-info rounded">Requirement.pdf<x-template.icon>download</x-template.icon></button>
                                    <button
                                        class="btn btn-sm btn-info rounded">Requirement.pdf<x-template.icon>download</x-template.icon></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 p-4 border">
                            <div class="mb-4">
                                <h2>Resumé</h2>
                                <div class="my-0" wire:click="$set('resumeSelect', 'useResume')">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="resumeSelect"
                                            value="useResume">
                                        Use resumé from requirements
                                    </label>
                                </div>
                                @if ($resumeSelect == 'useResume')
                                    <div class="d-flex mt-2 px-4">
                                        <p class="font-weight-bold">
                                            {{$selectedResumeFileName}}
                                            @if ($selectedResumeFileName != 'No Uploaded Resume')
                                            <x-template.icon>file</x-template.icon>
                                            @endif
                                            </p>
                                    </div>
                                @endif
                                <div class="my-0" wire:click="$set('resumeSelect', 'uploadResume')">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="resumeSelect"
                                            value="uploadResume">
                                        Upload new resumé
                                    </label>
                                </div>
                                @if ($resumeSelect == 'uploadResume')
                                    <div class="d-inline-flex flex-column  mt-2 px-4">
                                        @if ($temporaryUploadedResume)
                                            <span class="font-weight-bold">{{ $originalResumeName }}<x-template.icon>file</x-template.icon></span>
                                            <span class="mb-4 mt-2" role="button" wire:click='clearResumeFile '><u>Upload New File</u></span>
                                        @else
                                            <x-template.input type="file" text="" wire:model="resumeFile"
                                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                                style=""></x-template.input>
                                        @endif
                                        @error('resumeFile')
                                            <div class="mt-2 alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @endif
                                <div class="my-0" wire:click="$set('resumeSelect', 'noResume')">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="resumeSelect"
                                            value="noResume">
                                        Do not include a resumé
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h2>Cover Letter</h2>
                                <div class="my-0" wire:click="$set('coverSelect', 'uploadCover')">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="coverSelect"
                                            value="uploadCover">
                                        Upload Cover Letter
                                    </label>
                                </div>
                                @if ($coverSelect == 'uploadCover')
                                    <div class="d-inline-flex flex-column  mt-2 px-4">
                                        @if ($temporaryUploadedCover)
                                            <span class="font-weight-bold">{{ $originalCoverName }}<x-template.icon>file</x-template.icon></span>
                                            <span class="mb-4 mt-2" role="button" wire:click='clearCoverFile '><u>Upload New File</u></span>
                                        @else
                                            <x-template.input type="file" text="" wire:model="coverFile"
                                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                                style=""></x-template.input>
                                        @endif
                                        @error('coverFile')
                                            <div class="mt-2 alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @endif
                                <div class="my-0" wire:click="$set('coverSelect', 'writeCover')">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="coverSelect"
                                            value="writeCover">
                                        Write a Cover Letter
                                    </label>
                                </div>
                                @if ($coverSelect == 'writeCover')
                                    <div class="d-flex mt-2 px-4">
                                        <textarea class="form-control" wire:model="writeCover" rows="10"></textarea>
                                    </div>
                                @endif
                                <div class="my-0" wire:click="$set('coverSelect', 'noCover')">
                                    <label>
                                        <input class="form-check-input" type="radio" wire:model="coverSelect"
                                            value="noCover">
                                        Do not include a Cover Letter
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

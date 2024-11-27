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

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

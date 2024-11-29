<div>
    @if ($totalApplications > 0)
        <h3>You Have {{ $totalApplications > 1 ? $totalApplications . ' Applications' : '1 Application' }}</h3>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Job List Name</th>
                            <th>Company</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr style="cursor: pointer"
                                wire:click="$set('selectedApplicationId', {{ $application->id }})">
                                <td>{{ $application->application_date }}</td>
                                <td>{{ $application->job_list }}</td>
                                <td>{{ $application->co_name }}</td>
                                <td>
                                    @switch($application->status)
                                        @case(1)
                                            <span class="badge badge-success">Accepted</span>
                                        @break

                                        @case(2)
                                            <span class="badge badge-warning">Pending</span>
                                        @break

                                        @case(3)
                                            <span class="badge badge-danger">Rejected</span>
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $applications->links() }}
        <div class="mt-4">
            @if ($selectedApplicationId)
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
                                <div class="d-flex">
                                    <h3 style="margin-right: 10px">Application Status: </h3>
                                    @switch($selectedApplication->status)
                                        @case(1)
                                            <h4 class="badge-success p-1 rounded">Accepted</h4>
                                        @break

                                        @case(2)
                                            <h4 class="badge-warning p-1 rounded">Pending</h4>
                                        @break

                                        @case(3)
                                            <h4 class="badge-danger p-1 rounded">Rejected</h4>
                                        @break
                                    @endswitch
                                </div>
                                <div class="mb-4">
                                    <h4>Resumé</h4>
                                    @switch($selectedApplication->resume_mode)
                                        @case(1)
                                            <p><u>Using Resumé From Upload Requirements</u></p>
                                            <a href="{{ route('intern-requirements') }}"><button
                                                    class="btn btn-primary btn-sm">go to requirements</button></a>
                                        @break

                                        @case(2)
                                            <button wire:click='downloadFile({{ $selectedResumeFile->id }})' class="btn btn-sm btn-primary">Download
                                                <x-template.icon>download</x-template.icon></button>
                                            {{$selectedResumeFile->file_original_name}}
                                        @break

                                        @case(3)
                                            No Resume Submitted
                                        @break
                                    @endswitch
                                </div>
                                <div class="mb-4">
                                    <h4>Cover Letter</h4>
                                    @switch($selectedApplication->cover_mode)
                                        @case(1)
                                            <button wire:click='downloadFile({{ $selectedCoverFile->id }})' class="btn btn-sm btn-primary">Download
                                                <x-template.icon>download</x-template.icon></button>
                                            {{$selectedCoverFile->file_original_name}}
                                        @break

                                        @case(2)
                                            <p style="white-space: pre-wrap;">{!! $selectedApplication->cover_text !!}</p>
                                        @break

                                        @case(3)
                                            No Cover Letter Submitted
                                        @break
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p>click on a row to view details</p>
            @endif
        </div>
    @else
        <h3 class="mb-2">Looks like you don't have any applications</h3>
        <a href="{{ route('student-joblist') }}" class="btn btn-primary">Apply Now</a>
    @endif
</div>

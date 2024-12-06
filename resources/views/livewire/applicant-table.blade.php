<div>
    @if ($applicantId)
        @if (session('status'))
            <div id="flash-message" class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div wire:ignore.self class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="rejectModalLabel">Are you sure you want to reject this
                            application?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" wire:click='reject' class="btn btn-danger"
                            data-bs-dismiss="modal">Reject</button>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="acceptModalLabel">Are you sure you want to accept this
                            application?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" wire:click='accept' class="btn btn-success"
                            data-bs-dismiss="modal">Accept</button>
                    </div>
                </div>
            </div>
        </div>
        <button wire:click="$set('applicantId', null)" class="btn btn-primary btn-icon-text btn-small">
            <x-template.icon class="btn-icon-prepend">subdirectory-arrow-left</x-template.icon>
            back
        </button>
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <h4>Student Details</h4>
                            <p>
                                Name: {{ $applicant->stud_first_name }} {{ $applicant->stud_last_name }}
                                <br>
                                Department: {{ $applicant->stud_department }}
                                <br>
                                Email: {{ $applicant->stud_email }}
                                <br>
                                Contact Number: {{ $applicant->stud_student_telephone }}
                            </p>
                        </div>
                        <div>
                            <h4>Job Details</h4>
                            <h5 class="mx-4">{{ $applicant->job_list }}</h5>
                            <div class="border border2 px-4" style="height: 400px; overflow-y: auto">
                                <p>{!! $applicant->job_desc !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-between">
                            <h4 class="mt-lg-0 my-4">Application Information</h4>
                            <h4 class="mt-lg-0 my-4">
                                Status:
                                @switch($applicant->status)
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
                            </h4>
                        </div>
                        <div class="mb-4">
                            <h5>Resumé</h5>
                            @switch($applicant->resume_mode)
                                @case(1)
                                    <button wire:click='downloadRequirement({{ $selectedResumeFile->id }})'
                                        class="btn btn-sm btn-primary">Download
                                        <x-template.icon>download</x-template.icon></button>
                                    <a href={{ $this->selectedResumeFile->req_file_url }} target="_blank">
                                        <button class="btn btn-info btn-icon-text btn-sm" color="primary">
                                            <i class="mdi mdi-eye btn-icon"></i>
                                        </button>
                                    </a>
                                    <p>{{ $selectedResumeFile->req_orig_name }}</p>
                                @break

                                @case(2)
                                    <button wire:click='downloadFile({{ $selectedResumeFile->id }})'
                                        class="btn btn-sm btn-primary">Download
                                        <x-template.icon>download</x-template.icon></button>
                                    <a href={{ $this->selectedResumeFile->file_url }} target="_blank">
                                        <button class="btn btn-info btn-icon-text btn-sm" color="primary">
                                            <i class="mdi mdi-eye btn-icon"></i>
                                        </button>
                                    </a>
                                    <p>{{ $selectedResumeFile->file_original_name }}</p>
                                @break

                                @case(3)
                                    <p style="margin-bottom: 36px">No Resume Submitted</p>
                                @break
                            @endswitch
                        </div>
                        <div class="mb-4">
                            <h5>Cover Letter</h5>
                            @switch($applicant->cover_mode)
                                @case(1)
                                    <button wire:click='downloadFile({{ $selectedCoverFile->id }})'
                                        class="btn btn-sm btn-primary">Download
                                        <x-template.icon>download</x-template.icon></button>
                                    <a href={{ $this->selectedCoverFile->file_url }} target="_blank">
                                        <button class="btn btn-info btn-icon-text btn-sm" color="primary">
                                            <i class="mdi mdi-eye btn-icon"></i>
                                        </button>
                                    </a>
                                    <p>{{ $selectedCoverFile->file_original_name }}</p>
                                @break

                                @case(2)
                                    <div class="border border-2 px-4"
                                        style="white-space: pre-wrap; height: 435px; overflow-y: auto">
                                        <p>{{ $applicant->cover_text }}</p>
                                    </div>
                                @break

                                @case(3)
                                    No Cover Letter Submitted
                                @break
                            @endswitch
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        @if ($applicant->status == 2)
                            <button data-bs-toggle="modal" data-bs-target="#rejectModal"
                                class="btn btn-danger mx-1">Reject</button>
                            <button data-bs-toggle="modal" data-bs-target="#acceptModal"
                                class="btn btn-success mx-1">Accept</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <h1>Applicant List</h1>
        <!-- Search bar -->
        <div class="mb-3">
            <div class="input-group" role="search">
                <input type="text" id="searchInput" placeholder="Search by SR-Code or Name" class="form-control"
                    wire:model.debounce.500ms="searchQuery" wire:keydown.enter="search">

                <div class="input-group-append">
                    <button class="btn btn-primary" wire:click="search">
                        <i class="mdi mdi-magnify"></i> Search
                    </button>
                </div>
                <button class="btn btn-sm clear-button" wire:click="clearSearch">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
        </div>

        <!-- Applicants Table -->
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Applicant List</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SR-Code</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Department</th>
                                    <th>Year Level</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($applicants as $applicant)
                                    <tr role="button" wire:click="selectApplicant({{ $applicant->id }})">
                                        <td>{{ $applicant->student->stud_sr_code }}</td>
                                        <td>{{ $applicant->student->stud_first_name }}</td>
                                        <td>{{ $applicant->student->stud_last_name }}</td>
                                        <td>{{ $applicant->student->stud_department }}</td>
                                        <td>{{ $applicant->student->stud_year_level }}</td>
                                        <td>
                                            @switch($applicant->status)
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
                    {{ $applicants->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set the timer for 5 seconds (5000 milliseconds)
        setTimeout(function() {
            // Find the flash message element
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                // Fade out and remove the flash message
                flashMessage.style.transition = "opacity 0.5s";
                flashMessage.style.opacity = 0;
                setTimeout(function() {
                    flashMessage.remove();
                }, 500); // Match this time with the CSS transition duration
            }
        }, 3000); // Duration to show the message
    });
</script>

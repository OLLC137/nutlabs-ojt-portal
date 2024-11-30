<div class="container">
    @if (!$studentId)
    <h1>Manage Journal Requests</h1>
    <div class="d-flex flex-row col-sm-4 my-2">
        <div class="d-flex flex-row align-items-center w-100">
            <input type="text" class="form-control" placeholder="Search Student/SR-Code" wire:model.live="searchBar">
            @if ($this->searchBar != '')
            <x-template.icon wire:click="$set('searchBar', '')" style="margin: 0 0 0 -1.6em; cursor: pointer;" class="text-danger">close</x-template.icon>
            @endif
        </div>
    </div>
    <div class="card my-2">
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SR Code</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr style="cursor: pointer" wire:click="$set('studentId',{{ $student->id }})">
                        <td>{{ $student->sr_code }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->department }}</td>
                        <td>{{ $status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        {{ $students->links() }}
    @else

    <button wire:click="$set('studentId',null)" class="btn btn-primary btn-icon-text btn-small mb-2">
        <x-template.icon class="btn-icon-prepend">subdirectory-arrow-left</x-template.icon>
    back
    </button>

    @if(session()->has('message'))
            <div class="alert alert-success mt-4" x-data="{ show: false }"
                x-show.transition.opacity.duration.1500ms="show"
                x-init="show = true; setTimeout(() => { show = false; }, 4000)">
                    {{ session('message') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger mt-4" x-data="{ show: false }"
                x-show.transition.opacity.duration.1500ms="show"
                x-init="show = true; setTimeout(() => { show = false; }, 4000)">
                    {{ session('error') }}
            </div>
        @endif

    <div class="card mt-3">
        <div class="card-body">
            <div class="column">
                <div class="col-xl-8 p-4 border">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1>{{ $student->first_name }} {{ $student->last_name }} </h1>
                        <h4 class="bg-primary text-white p-1 rounded">Pending</h4>
                    </div>
                        <div class="form-group mb-0">
                        <p class="display-5 font-weight-bold mb-0">Number of Hours: {{$acc_hours}}</p>
                        <p class="display-5 font-weight-bold mb-0">Journal Date: {{$requestDate}}</p>
                        <p class=""></p>
                        <div class="mb-4">
                            <p class="display-9 font-weight-bold"> Journal Entry: </p>
                            {!! $acc_accomplishment !!}
                        </div>
                        <div class="mb-4">
                            <p class="display-9 font-weight-bold"> Reason for Request: </p>
                            {!! $requestReason !!}
                        </div>
                        </div>
                    <button type="button" class="btn btn-success" wire:click="acceptJournalRequest({{ $studentId }})" data-bs-dismiss="modal">Accept</button>
                    <button type="button" wire:click="confirmDeletion({{ $studentId }})"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                </div>
            </div>
        </div>

    </div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to permanently delete this request?</h1>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click="deleteJournalRequest"  class="btn btn-primary" data-bs-toggle="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>

    @endif

</div>

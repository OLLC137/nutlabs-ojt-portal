<div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success mt-4" x-data="{ show: false }" x-show.transition.opacity.duration.1500ms="show"
            x-init="show = true;
            setTimeout(() => { show = false; }, 4000)">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger mt-4" x-data="{ show: false }" x-show.transition.opacity.duration.1500ms="show"
            x-init="show = true;
            setTimeout(() => { show = false; }, 4000)">
            {{ session('error') }}
        </div>
    @endif
    @if (!$this->requestId)
        <h1>Manage Journal Requests</h1>
        <div class="d-flex flex-row col-sm-4 my-2">
            <div class="d-flex flex-row align-items-center w-100">
                <input type="text" class="form-control" placeholder="Search Student/SR-Code"
                    wire:model.live="searchBar">
                @if ($this->searchBar != '')
                    <x-template.icon wire:click="$set('searchBar', '')" style="margin: 0 0 0 -1.6em; cursor: pointer;"
                        class="text-danger">close</x-template.icon>
                @endif
            </div>
        </div>
        <div class="card my-2">
            <div class="card-body table-responsive">
                @if ($requests->isEmpty())
                    <p>No Student Journal Requests Found</p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Request Date</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr role="button" wire:click="$set('requestId',{{ $request->id }})">
                                    <td>{{ $request->requested_date }}</td>
                                    <td>{{ $request->first_name }}</td>
                                    <td>{{ $request->last_name }}</td>
                                    <td>{{ $request->department }}</td>
                                    <td>
                                        @switch($request->status)
                                            @case('approved')
                                                <span class="badge badge-success">Accepted</span>
                                            @break

                                            @case('pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @break

                                            @case('rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        {{ $requests->links() }}
    @else
        <button wire:click="$set('requestId',null)" class="btn btn-primary btn-icon-text btn-small mb-2">
            <x-template.icon class="btn-icon-prepend">subdirectory-arrow-left</x-template.icon>
            back
        </button>

        <div class="card mt-3 col-xl-8 ">
            <div class="card-body">
                <div class="p-4 border">
                        <p>Request submitted on {{$request->created_at}}</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="font-weight-bold">Student Name: Oliver Luis </p>
                        <h4 class="bg-warning text-white p-1 rounded">Pending</h4>
                    </div>
                    <div class="form-group mb-0">
                        <p class="font-weight-bold mb-0">Number of Hours: {{$request->acc_hours}}</p>
                        <p class="mb-0">Journal Date: {{$request->requested_date}}</p>
                        <p class=""></p>
                        <div class="mb-4">
                            <p class="display-9 font-weight-bold"> Journal Entry: </p>
                            <div style="height: 230px; overflow-y: auto" class="border border-2 p-2">{!! $request->acc_accomplishments !!}</div>
                        </div>
                        <div class="mb-4">
                            <p class="display-9 font-weight-bold"> Reason for Request: </p>
                            {{ $request->reason }}
                        </div>
                    </div>
                    <button type="button" class="btn btn-success"
                        wire:click="acceptJournalRequest({{ $requestId }})" data-bs-dismiss="modal">Accept</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">Reject</button>
                </div>
            </div>

        </div>
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to permanently delete
                            this request?</h1>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" wire:click="deleteJournalRequest({{ $requestId }})"
                            class="btn btn-primary" data-bs-toggle="modal">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    @endif

</div>

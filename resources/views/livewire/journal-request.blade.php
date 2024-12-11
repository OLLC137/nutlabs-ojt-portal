<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-xl-10 mb-4">
            @if (session()->has('message'))
                <div class="alert alert-success mt-4" x-data="{ show: false }"
                    x-show.transition.opacity.duration.1500ms="show" x-init="show = true;
                    setTimeout(() => { show = false; }, 4000)">
                    {{ session('message') }}
                </div>
            @endif
            <h1>Journal Request</h1>
            <div class="card">
                <div class="card-body">
                    @include('livewire.journal-request-includes.Request-Card')
                    @if (!$editID)
                        <button wire:click.prevent="create" type="submit"
                            class="btn btn-success btn-icon-text col-md-4 mt-3">
                            <i class="mdi mdi-file-check btn-icon-prepend">
                            </i>
                            Submit
                        </button>
                    @else
                        <button wire:click.prevent="editRequest" type="submit"
                            class="btn btn-success btn-icon-text mt-3">
                            <i class="mdi mdi-pencil btn-icon-prepend">edit</i>
                        </button>
                        <button wire:click="cancelEdit" type="submit" class="btn btn-secondary btn-icon-text mt-3">
                            <i class="mdi mdi-close-circle-outline btn-icon-prepend">cancel</i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @if (!$requests->isEmpty())
            <h3 class="text-center">Pending Journal Requests</h3>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Request Date</th>
                            <th>No. of Hours</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td>{{ $request->requested_date }}</td>
                                    <td>{{ $request->acc_hours }}</td>
                                    <td>
                                        {{ \Illuminate\Support\Str::limit($request->reason, 50, '...') }}
                                    </td>
                                    <td>
                                        @switch($request->status)
                                            @case('pending')
                                                <span class="badge badge-success">{{ $request->status }}</span>
                                            @break

                                            @case('rejected')
                                                <span class="badge badge-danger">{{ $request->status }}</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td width="20px"><button wire:click='updateRequest({{ $request->id }})'
                                            class="btn btn-sm btn-icon btn-success"><i
                                                class="mdi mdi-pencil"></i></button></td>
                                    <td width="20px"><button wire:click='confirmDelete({{ $request->id }})'
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="btn btn-sm btn-icon btn-danger"><i
                                                class="mdi mdi-delete"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $requests->links() }}
        @endif
    </div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to permanently delete this
                        accomplishment?</h1>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click.stop="deleteAccomplishment" class="btn btn-primary"
                        data-bs-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    REQUIREMENT ID BUFFER: {{ $requirementIdBuffer }}
    @if (!$studentId)
    <h1>Manage Student Files</h1>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr style="cursor: pointer" wire:click="$set('studentId',{{ $student->id }})">
                        <td>{{ $student->sr_code }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->department }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        {{ $students->links() }}
    @else
    
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to permanently delete this file?</h1>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click.stop="delete"  class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="unlockModal" tabindex="-1" aria-labelledby="unlockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="unlockModalLabel">This will unsubmit the requirement and will not delete the file. Do you wish to proceed?</h1>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click.stop="unlock"  class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="exemptModal" tabindex="-1" aria-labelledby="exemptModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exemptModalLabel">Exempt the selected requirement?</h1>
                </div>
                <div class="modal-body">
                    <p>Exempting this requirement will allow the student to proceed with their OJT.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click.stop="exempt"  class="btn btn-success" data-bs-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <button wire:click="$set('studentId',null)" class="btn btn-primary btn-icon-text btn-small mb-2">
        <x-template.icon class="btn-icon-prepend">subdirectory-arrow-left</x-template.icon>
    back
    </button>
    <div class="card table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>SR Code</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Department</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $student->sr_code }}</td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->department }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <h4 class="my-2">pre-ojt requirements</h4>
    <div class="card mt-2">
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Requirement Name</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=1 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=2 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=3 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=4 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=5 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=6 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=7 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=8 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=9 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=10 />
                </tbody>
            </table>
        </div>
    </div>
    <h4 class="my-2">post-ojt requirements</h4>
    <div class="card mt-2">
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Requirement Name</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=11 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=12 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=13 />
                    <livewire:student-requirement-row studentId="{{ $studentId }}" reqId=14 />
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

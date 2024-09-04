<div>
    <div class="col-md-5 grid-margin" role="search">
                <div class="input-group">
                    <input type="text" wire:model="searchQuery" placeholder="Search Student Name/SR-Code" class="mb-2 form-control" id="searchInput">
                    <div class="input-group-append"> 
                        <x-template.button color="primary" wire:click="triggerSearch"><i class="mdi mdi-magnify"></i></x-template.button>
                    </div>
                    <button class="btn-sm clear-button" wire:click="clearSearch"><i class="mdi mdi-close"></i></button>
                </div>
            </div>
        @if (session('status'))
            <div id="flash-messages" class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    <div class="col-md-12 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title"> Personal Information </x-slot>
                    <div class="table-responsive">
                        <x-template.table :head="['SR-Code', 'Prefix', 'First Name', 'Middle Initial', 'Last name', 'Suffix', 'Department' ]">
                        @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->stud_sr_code }}</td>
                                    <td>{{ $student->stud_prefix }}</td>
                                    <td>{{ $student->stud_first_name }}</td>
                                    <td>{{ $student->stud_middle_initial }}</td>
                                    <td>{{ $student->stud_last_name }}</td>
                                    <td>{{ $student->stud_suffix }}</td>
                                    <td>{{ $student->stud_department }}</td>
                                    <td>
                                        <button  wire:click="confirmDelete({{ $student->id }})" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#deleteModal2">
                                            Archive
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </x-template.table>
                    </div>
            <!-- Pagination controls -->
            <div class="pagination-controls">
                        {{ $students->links() }}
                    </div>
            </x-template.card-body>
        </x-template.card>
    </div>

    <div wire:ignore.self class="modal fade" id="deleteModal2" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to Archive the record of this Student?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.stop="delete"  class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set the timer for 5 seconds (5000 milliseconds)
        setTimeout(function() {
            // Find the flash message element
            var flashMessage = document.getElementById('flash-messages');
            if (flashMessage) {
                // Fade out and remove the flash message
                flashMessage.style.transition = "opacity 0.5s";
                flashMessage.style.opacity = 0;
                setTimeout(function() {
                    flashMessage.remove();
                }, 500); // Match this time with the CSS transition duration
            }
        }, 3000); // Duration to show the message

        if (searchInput) {
            searchInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    // Trigger the Livewire method
                    @this.call('triggerSearch');

                    //clear the search field
                    // setTimeout(function() {
                    //     searchInput.value = '';
                    // },900);
                }
            });
        }
    });
</script>

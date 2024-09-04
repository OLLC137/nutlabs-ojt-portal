<div class="col-md-6">
    @if (session('create-status'))
                        <div id="flash-message" class="alert alert-success">
                            {{ session('create-status') }}
                        </div>
    @endif
    @if (session('update-status'))
                        <div id="flash-message2" class="alert alert-success">
                            {{ session('update-status') }}
                        </div>
    @endif
    @if (session('delete-status'))
                        <div id="flash-message3" class="alert alert-success">
                            {{ session('delete-status') }}
                        </div>
    @endif
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Contact Person Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div>
                            @error('contact_name') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Name</label>
                            <input wire:model="contact_name" type="text" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div>
                            @error('contact_position') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Position</label>
                            <input wire:model="contact_position" type="text" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div>
                            @error('contact_contact') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" class="form-label">Tel.No</label>
                            <input wire:model="contact_contact" type="text" class="form-control" id="exampleInputPassword2">
                        </div>
                        <div>
                            @error('contact_email') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword3" class="form-label">Email</label>
                            <input wire:model="contact_email" type="email" class="form-control" id="exampleInputPassword3">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if ($editingContactId)
                        <button wire:click="update" type="button" class="btn btn-primary">Update</button>
                    @else
                        <button wire:click="save" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-2">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title"> Contact Person </x-slot>
                <div class="table-responsive">
                    <x-template.table :head="['Name', 'Position', 'Tel. No.', 'Email', 'Actions']">
                        @foreach ($contact_person as $contact)
                            <tr>    
                                @if ($editingContactId == $contact->id)
                                    <td><input wire:model="contact_name" type="text" class="form-control"></td>
                                    <td><input wire:model="contact_position" type="text" class="form-control"></td>
                                    <td><input wire:model="contact_contact" type="text" class="form-control"></td>
                                    <td><input wire:model="contact_email" type="email" class="form-control"></td>
                                    <td>
                                        <button wire:click="update" class="btn btn-success btn-sm">Save</button>
                                        <button wire:click="cancelEdit" class="btn btn-secondary btn-sm">Cancel</button>
                                    </td>
                                @else
                                    <td>{{ $contact->contact_name }}</td>
                                    <td>{{ $contact->contact_position }}</td>
                                    <td>{{ $contact->contact_contact }}</td>
                                    <td>{{ $contact->contact_email }}</td>
                                    <td>
                                        <button wire:click="edit({{ $contact->id }})" class="btn btn-primary btn-sm">Edit</button>
                                        <button wire:click="delete({{ $contact->id }})" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </x-template.table>
                </div>
            </x-template.card-body>
        </x-template.card>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            // Select all flash message elements
            var flashMessages = document.querySelectorAll('#flash-message, #flash-message2, #flash-message3');
            flashMessages.forEach(function(flashMessage) {
                if (flashMessage) {
                    // Fade out and remove the flash message
                    flashMessage.style.transition = "opacity 0.5s";
                    flashMessage.style.opacity = 0;
                    setTimeout(function() {
                        flashMessage.remove();
                    }, 500); // Match this time with the CSS transition duration
                }
            });
        }, 3000); // Duration to show the message
    });
</script>
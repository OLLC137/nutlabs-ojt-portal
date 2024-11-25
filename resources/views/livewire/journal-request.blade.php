<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-xl-8 mb-4">
            <div class="card">
                <div class="card-body">
                    @include('livewire.journal-request-includes.Request-Card')
                    @if ($editID)
                    <button wire:click.prevent="editJournal" type="submit"
                            class="btn btn-success btn-icon-text mt-3">
                            <i class="mdi mdi-pencil btn-icon-prepend">edit</i>
                    </button>
                    <button wire:click="cancelEdit" type="submit"
                            class="btn btn-secondary btn-icon-text mt-3">
                            <i class="mdi mdi-close-circle-outline btn-icon-prepend">cancel</i>
                    </button>
                    @else
                    <button wire:click.prevent="create" type="submit"
                        class="btn btn-success btn-icon-text col-md-4 mt-3">
                        <i class="mdi mdi-file-check btn-icon-prepend">
                        </i>
                        Submit
                    </button>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to permanently delete this accomplishment?</h1>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click.stop="deleteJournalPost"  class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>

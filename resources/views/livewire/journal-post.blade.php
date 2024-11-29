<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-xl-8 mb-4">
            <div class="card">
                <div class="card-body">
                    @if(!$isTodayDone)
                    @include('livewire.journal-post-includes.Task-Card')
                    @endif
                    <div class="mt-4">
                        @if($isTodayDone)
                        <h4 class="journalp-accomplishment-header"> Journal for Today is Already Completed </h4>
                        @else
                        <h4 class="journalp-accomplishment-header"> Accomplishments for Today </h4>
                        <div class="form-group mt-2 mb-0">
                            <x-input.rich-text disabled wire:model.debounce="acc_accomplishments"
                                :initial-value="$acc_accomplishments"></x-input.rich-text>
                        </div>
                        @endif
                        @error('acc_accomplishments')
                            <span style="color:red" class="text-xs mt-3 block">{{ $message }}</span>
                        @enderror
                    </div>
                    @if(!$isTodayDone)
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
                    @endif
                </div>
            </div>
        </div>



        <div class="col-xl-4">
            <div class="card mb-3">
                <div class="card-body">
                    <input wire:model.live.debounce.500ms="search" class="form-control search-btn rounded"
                        type="search" placeholder="Search Filter..." aria-label="Search" />
                </div>
            </div>
            @if(session()->has('message'))
                <div class="alert alert-success" x-data="{ show: false }"
                x-show.transition.opacity.duration.1500ms="show"
                x-init="show = true; setTimeout(() => { show = false; }, 4000)">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                @foreach ($ojt_accomplishments as $post)
                    @include('livewire.journal-post-includes.Journal-List')
                @endforeach
            </div>
        </div>
        <div class="container">
            <div class="bg mt-3 mx-2">{{ $ojt_accomplishments->links() }}</div>
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

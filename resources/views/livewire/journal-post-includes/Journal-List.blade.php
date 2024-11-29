<div wire:key="{{ $post->id }}" class="journal-post-content-container">
    <div class="journal-post-content-card card-body">
        <div class="journal-post-content-header row">
            <div class="col col-sm">
                <h4 class="header-date mb-0">{{ $post->acc_date }}</h4>
                <p class="mb-0">{{ $post->acc_hours }} Hours</p>
            </div>
            <div class="col col-sm d-flex justify-content-end">
                <button wire:click="updateJournalPost({{ $post->id }})" class="btn btn-success btn-sm">
                    <x-template.icon>border-color</x-template.icon>
                </button>
                <button wire:click="confirmDeletion({{ $post->id }})" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <x-template.icon>delete</x-template.icon>
                </button>
            </div>
        </div>
        <hr class="hr" />
        <div class="list-group">
            <div class="journal-post-content list-group-item">
                    {!!$post->acc_accomplishments!!}
            </div>
        </div>
    </div>
</div>

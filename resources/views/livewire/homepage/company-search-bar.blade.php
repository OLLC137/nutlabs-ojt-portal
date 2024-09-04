<div class="company-search-container-with-error">
    <form wire:submit.prevent="search"  class="company-search-area">
        <div class="company-search-bar" role="search">
            <input type="text" wire:model="searchQuery" placeholder= 'Search for positions, companies'>
        </div>
        <button type="submit" class="company-search-search-button">
            Go
        </button>

    </form>
    @error('searchQuery')
            <div class="mt-2 alert alert-danger company-search-error">
                Please Input Search Query
            </div>
    @enderror
</div>

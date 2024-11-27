<div class="joblist-search-area">
    <div class="joblist-search">
        <div class="joblist-search-item">
            <label for="search">Search</label>
            <div class="input-container">
                <input type="text" placeholder="Enter Keywords" wire:model="search" wire:keydown.enter="doSearch">
                <button class="clear-button" wire:click="$set('search', '')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="joblist-search-item">
            <label for="category">Categories</label>
            <div class="input-container">
                <select id="category" wire:model="category" placeholder="Any Classifications">
                    <option value="">Any Classification</option>
                    @foreach ($categories as $id => $cat_name)
                    <option value="{{ $cat_name }}">{{ $cat_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="joblist-search-item">
            <label for="location">Program</label>
            <div class="input-container">
                <input type="text" id="location" placeholder="Enter Program Name" wire:model="program" wire:keydown.enter="doSearch">
                <button class="clear-button" wire:click="$set('program', '')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="joblist-search-item">
            <label for="location">Location</label>
            <div class="input-container">
                <input type="text" id="location" placeholder="Enter Suburb, City, or Region" wire:model="location" wire:keydown.enter="doSearch">
                <button class="clear-button" wire:click="$set('location', '')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="joblist-search-item has-button">
            <button class="joblist-search-button" wire:click="doSearch"><x-template.icon>magnify</x-template.icon></button>
        </div>
    </div>
</div>

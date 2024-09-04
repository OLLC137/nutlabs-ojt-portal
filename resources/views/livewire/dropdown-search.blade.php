<div class="position-relative bg-white" wire:click.away="closeDropdown">
    <input wire:click="toggleDropdown" wire:model="selectedItemName" class="form-control text-muted" role="button" placeholder="{{ $dropdownLabel }}" readonly></input>
    <div class="dropdown-box w-100 px-0" style="{{ $this->displayNone() }}">
        <input wire:model.live='searchTerm' class="form-control" type="search" placeholder="Search" aria-label="Search">
        <ul class="dropdown-options w-100 px-0">
            @foreach ($itemGroup as $item)
            <li wire:key="{{ $item->id }}" wire:click="selectItem({{ $item->id }}, '{{ $item->name }}', '{{ $eventName }}')" class="dropdown-option d-flex align-items-center px-2 mx-0" role="button">{{ $item->name }}</li>
            @endforeach
        </ul>
    </div>
</div>

@assets
<style>
.dropdown-box {
    background-color: white;
    position: absolute;
    display: block;
    z-index: 50;
    box-shadow: 0 4px 7px -1px #9f9f9f;
}

.dropdown-box-hide {
    display: none;
}

.dropdown-options {
    max-height: 200px;
    overflow-y: auto;
}

.dropdown-option {
    background: white;
    height: 50px;
}

.dropdown-option:hover {
    background: rgb(211, 211, 211);
}
</style>
@endassets
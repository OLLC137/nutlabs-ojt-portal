<div>
    <div class="container-cardcv">
        <div class="col-md-6 grid-margin">
            <x-template.card>
                <x-template.card-body>
                    <x-slot name="title">Company Information</x-slot>
                    <form wire:submit.prevent="addCompany">

                        @error('co_name') <span class="text-danger">{{ $message }}</span> @enderror
                        <x-template.input view="horizontal" text="{{ __('Company Name') }}" placeholder="Company Name" type="text" wire:model="co_name"></x-template.input>

                        @error('co_address') <span class="text-danger">{{ $message }}</span> @enderror
                        <x-template.input view="horizontal" text="{{ __('Company Address') }}" placeholder="Company Address" type="text" wire:model="co_address"></x-template.input>
                        
                        @error('co_contact_number') <span class="text-danger">{{ $message }}</span> @enderror
                        <x-template.input view="horizontal" text="{{ __('Company Tel. No.') }}" placeholder="Company Tel. No." type="text" wire:model="co_contact_number"></x-template.input>

                        @error('co_email') <span class="text-danger">{{ $message }}</span> @enderror
                        <x-template.input view="horizontal" text="{{ __('Company Email') }}" placeholder="Company Email" type="email" wire:model="co_email"></x-template.input>

                        @error('co_website') <span class="text-danger">{{ $message }}</span> @enderror
                        <x-template.input view="horizontal" text="{{ __('Company Website') }}" placeholder="Company Website" type="text" wire:model="co_website"></x-template.input>

                        <x-template.button type="submit" color="primary">Submit</x-template.button>
                    </form>
                </x-template.card-body>
            </x-template.card>
        </div>
    </div>
    <div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            // Find the flash message element
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                // Fade out and remove the flash message
                flashMessage.style.transition = "opacity 0.5s";
                flashMessage.style.opacity = 0;
                setTimeout(function() {
                    flashMessage.remove();
                }, 500); // Match this time with the CSS transition duration
            }
        }, 3000); // Duration to show the message
    });
</script>

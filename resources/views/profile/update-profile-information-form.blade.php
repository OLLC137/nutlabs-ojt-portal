<x-template.form-section submit="updateProfileInformation">
    <x-slot name="title"> {{ __('Profile Information') }} </x-slot>
    <x-slot name="description">{{ __('Update your account\'s profile information and email address.') }} </x-slot>

    <x-template.input id="name" type="text" text="{{ __('Name') }}" wire:model="state.name" />
    <x-input-error for="name" class="mt-2" />

    <x-template.input id="email" type="text" text="{{ __('Email') }}" wire:model="state.email" />
    <x-input-error for="email" class="mt-2" />

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
    <p class="text-sm mt-2">
        {{ __('Your email address is unverified.') }}

        <x-template.button type="button" color="gray" variant="gradient" wire:click.prevent="sendEmailVerification">
            {{ __('Click here to re-send the verification email.') }}
        </x-template.button>
    </p>

    @if ($this->verificationLinkSent)
    <p class="text-success">
        {{ __('A new verification link has been sent to your email address.') }}
    </p>
    @endif
    @endif


    <x-template.action-message on="saved">
        {{ __('Saved.') }}
    </x-template.action-message>

    <x-template.button type="submit" color="primary" variant="gradient" wire:loading.attr="disabled" wire:target="photo">
        {{ __('Save') }}
    </x-template.button>


</x-template.form-section>
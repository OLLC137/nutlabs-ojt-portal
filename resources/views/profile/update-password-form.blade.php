<x-template.form-section submit="updatePassword">
    <x-slot name="title"> {{ __('Update Password') }} </x-slot>
    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-template.input id="current_password" type="password" text="{{ __('Current Password') }}" wire:model="state.current_password"/>
    <x-template.input-error for="current_password" class="mt-2" />

    <x-template.input id="password" type="password" text="{{ __('Password') }}" wire:model="state.password"/>
    <x-template.input-error for="password" class="mt-2" />

    <x-template.input id="password_confirmation" type="password" text="{{ __('Confirm Password') }}" wire:model="state.password_confirmation"/>
    <x-template.input-error for="password_confirmation" class="mt-2" />

    <x-template.action-message class="me-3" on="saved">{{ __('Saved.') }} </x-template.action-message>
    <x-template.button color="primary" variant="gradient"> {{ __('Save') }} </x-template.button>
</x-template.form-section>
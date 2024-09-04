@props(['InitialValue' => '', 'height' => '200px'])

<div 
    wire:ignore
    {{ $attributes }}
    x-data
    @trix-blur="$dispatch('change', $event.target.value)""
>
    <input id="x" type="hidden" value="{{ $initialValue }}">
    <trix-editor input="x" class="form-control"  
    style="
    height: {{ $height }};
    overflow-x:auto;
    "></trix-editor>
</div>

<style>
    .trix-button--icon-increase-nesting-level,
    .trix-button--icon-attach,
    .trix-button--icon-quote,
    .trix-button--icon-code,
    .trix-button--icon-link,
    .trix-button-group--file-tools,
    .trix-button--icon-decrease-nesting-level { display:none !important; }
</style>
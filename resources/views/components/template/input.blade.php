@php

$class = "form-control";

@endphp


@if(empty($view) || $view != "horizontal")
<div class="form-group">
    <label> {{$text}} </label>
    <input {!! $attributes->merge(['class' => $class]) !!}>
</div>
@else
<div class="form-group row">
    <label class="col-sm-3 col-form-label"> {{ $text }} </label>
    <div class="col-sm-9">
        <input {!! $attributes->merge(['class' => $class]) !!}>
    </div>
</div>
@endif
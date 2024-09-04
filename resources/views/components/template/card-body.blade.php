<div class="card-body">
    @if(isset($title))
    <h4 class="card-title"> {{ $title }} </h4>
    @endif
    @if(isset($description))
    <p class="card-description"> {{ $description }} </p>
    @endif
    <div class="template-demo"> {{ $slot }} </div>
</div>
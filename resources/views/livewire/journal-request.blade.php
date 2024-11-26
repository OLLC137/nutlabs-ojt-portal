<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-xl-10 mb-4">
            @if(session()->has('message'))
                <div class="alert alert-success mt-4" x-data="{ show: false }"
                x-show.transition.opacity.duration.1500ms="show"
                x-init="show = true; setTimeout(() => { show = false; }, 4000)">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    @include('livewire.journal-request-includes.Request-Card')
                    <button wire:click.prevent="create" type="submit"
                        class="btn btn-success btn-icon-text col-md-4 mt-3">
                        <i class="mdi mdi-file-check btn-icon-prepend">
                        </i>
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card container">
    <div class="row">
        <div class='col-sm-6' id="mytextarea2">
            <h4>Request Date: </h4>
            <input type="date" id="requestDate" class="form-control" value="{{ $requestDate }}">
            @error('acc_date')
                <span style="color:red" class="block text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class='mt-4' id="mytextarea">
        <h4 class="journalp-accomplishment-header"> Reason for Request </h4>
            <div class="form-group mt-2 mb-0">
                <x-input.rich-text disabled wire:model.debounce="requestReason"
                    :initial-value="$requestReason"></x-input.rich-text>
            </div>
        </div>
    </div>
</div>

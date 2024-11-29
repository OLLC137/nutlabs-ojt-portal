<div class="card container">
    <div class="row">
        <div class="col-sm-6 form-group">
            <h4> Number of Hours: </h4>
            <input wire:model="acc_hours" class="form-control" type="number " value="8" placeholder="Hours">
            @error('acc_hours')
                <span style="color:red" class="block mt-1 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class='col-sm-6' id="mytextarea2">
            <h4>Request Date: </h4>
            <input wire:model="requestDate" type="date" id="requestDate" class="form-control" value="{{ $requestDate }}">
            @error('requestDate')
                <span style="color:red" class="block text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class='mt-4' id="mytextarea">
            <h4 class="journalp-accomplishment-header"> Accomplishment for Requested Day </h4>
                <div class="form-group mt-2 mb-0">
                    <x-input.rich-text disabled wire:model.debounce="acc_accomplishments"
                        :initial-value="$acc_accomplishments"></x-input.rich-text>
                    @error('acc_accomplishments')
                        <span style="color:red" class="block text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        <div class='mt-4' id="mytextarea">
        <h4 class="journalp-accomplishment-header"> Reason for Request </h4>
            <div class="form-group mt-2 mb-0">
                <input wire:model="requestReason" id="requestDate" class="form-control" type="text" value="{{ $requestDate }}" placeholder="Reason for Request">
                @error('requestReason')
                    <span style="color:red" class="block text-xs">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

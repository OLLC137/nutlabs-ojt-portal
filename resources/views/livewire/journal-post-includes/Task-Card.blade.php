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
            <h4>Date: </h4>
            <input type="date" id="currentDate" class="form-control" value="{{ $acc_date }}" readonly>
            @error('acc_date')
                <span style="color:red" class="block text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

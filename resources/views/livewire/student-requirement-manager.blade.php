<div>
    <div class="container">
        <div class="row">
            <livewire:requirement-card reqId=3>
            <h1>Pre-Ojt Requirements</h1>
            <h4>OJT Requirements</h4>
            <livewire:requirement-card reqId=3>
            <livewire:requirement-card reqId=1>
            <livewire:requirement-card reqId=2>
            <livewire:requirement-card reqId=4>
            <livewire:requirement-card reqId=5>
            <livewire:requirement-card reqId=6>
            <h4>Company Related Requirements</h4>
            <livewire:requirement-card reqId=7>
            <livewire:requirement-card reqId=8>
            <livewire:requirement-card reqId=9>
            <livewire:requirement-card reqId=10>
        </div>
        <div class="row">
            <h1>Post-Ojt Requirements</h1>
            <livewire:requirement-card reqId=11>
            <livewire:requirement-card reqId=12>
            <livewire:requirement-card reqId=13>
            <livewire:requirement-card reqId=14>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="submitModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="submitModalLabel">Are you sure you want to submit this requirement?</h1>
                </div>
                <div class="modal-body">
                    <p>You will not be able to change the file after submission.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click.stop="submit"  class="btn btn-success" data-bs-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="card col-lg-12">
        <div class="card-body">
            <table class="table">
                <tr>
                    <td><strong>Company Name</strong></td>
                    <td><input type="text" wire:model="co_name" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>Company Address</strong></td>
                    <td><input type="text" wire:model="co_address" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>Company Tel. No.</strong></td>
                    <td><input type="text" wire:model="co_contact_number" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>Company Email</strong></td>
                    <td><input type="text" wire:model="co_email" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>Company Website</strong></td>
                    <td><input type="text" wire:model="co_website" class="form-control"></td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <button class="btn mt-4 btn-secondary" wire:click="goToDashboard">Back</button>
        <button class="btn mt-4 btn-primary" wire:click="save">Update</button>
    </div>
</div>



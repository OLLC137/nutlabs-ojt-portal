<div class="row">
    <div class="card col-lg-12">
        <div class="card-body">
            <table class="table">
                <tr>
                    <td><strong>Company Name</td>
                    <td><input type="text" wire:model="co_name" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>Company Address</td>
                    <td><input type="text" wire:model="co_address" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>Company Tel. No.</td>
                    <td><input type="text" wire:model="co_contact_number" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>Company Email</td>
                    <td><input type="text" wire:model="co_email" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>Company Website</td>
                    <td><input type="text" wire:model="co_website" class="form-control"></td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <button class="btn mt-4 btn-primary" wire:click="save">Update</button>
    </div>
</div>

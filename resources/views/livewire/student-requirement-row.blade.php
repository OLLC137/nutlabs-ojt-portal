<tr>
    <td class="col-5">{{ $this->requirementName }}</td>
@if ($this->isSubmitted)
    <td class="col-5 text-success fw-bold">SUBMITTED</td>
    @if(!$isExempted)
    <td>
        <a href={{$this->requirementUrl}} target="_blank">
            <button class="btn btn-info btn-icon-text btn-sm" color="primary">
                <i class="mdi mdi-eye btn-icon"></i>
            </button>
        </a>
    </td>
    <td><button wire:click="downloadFile" class="col-1 btn btn-info btn-icon"><i class="mdi mdi-download"></i></button></td>
    <td><button wire:click="deleteFile" class="col-1 btn btn-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="mdi mdi-delete-forever"></i></button></td>
    @else
    <td></td>
    <td></td>
    @endif
    <td><button wire:click="unlockFile" class="btn btn-success btn-small" data-bs-toggle="modal" data-bs-target="#unlockModal">Unsubmit</button></td>
@else
    <td class="col-5 text-danger fw-bold lh-lg">PENDING</td>
    <td></td>
    <td></td>
    <td></td>
    @if ($reqId == 8)
    <td><button wire:click="exemptFile" class="btn btn-success btn-small" data-bs-toggle="modal" data-bs-target="#exemptModal">Exempt File</button></td>
    @else
    <td></td>
    @endif
@endif
</tr>

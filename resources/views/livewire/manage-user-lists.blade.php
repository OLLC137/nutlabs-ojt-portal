<x-template.table :head="['Name', 'Username', 'Email', 'Role', 'Status', 'Actions']">
    @foreach($userLists as $user)
    <tr class="{{ ($user->email_verified_at == null) ? 'table-warning' : '' }}">
        <td> {{ $user->name }} </td>
        <td> {{ $user->username }} </td>
        <td> {{ $user->email }} </td>
        <td> {{ $roles[$user->role] }} </td>
        <td> {{ (($user->email_verified_at != null) ? "Active" : "Inactive") }} </td>
        @if($user->id != Auth::user()->id)
        <td>
            @if($user->email_verified_at == null)
            <x-template.button color="success" wire:click="activateUser({{ $user->id }})"> Activate </x-template.button>
            @else
            <x-template.button color="warning" wire:click="cancelUser({{ $user->id }})"> Cancel </x-template.button>
            @endif
            <x-template.button color="danger" wire:click="deleteUser({{ $user->id }})"> Delete </x-template.button>
        </td>
        @else
        <td></td>
        @endif
    </tr>
    @endforeach
</x-template.table>
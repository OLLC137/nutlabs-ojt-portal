<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ManageUserLists extends Component
{

    public array $roles = [
        0 => 'Super Administrator',
        1 => 'Admin',
        2 => 'OJT_Head',
        3 => 'OJT_Coordinator',
        20 => 'Student',

    ];

    public function render()
    {
        return view('livewire.manage-user-lists', [
            'userLists' => json_decode(json_encode(User::get()))
        ]);
    }

    public function cancelUser($id)
    {
        User::where('id', $id)->update(['email_verified_at' => null]);
    }

    public function activateUser($id)
    {
        User::where('id', $id)->update(['email_verified_at' => now()]);
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
    }
}

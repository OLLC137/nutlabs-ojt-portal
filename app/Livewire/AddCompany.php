<?php

namespace App\Livewire;

use App\Models\OjtCompany;
use App\Models\OjtContactPerson;
use Livewire\Component;

class AddCompany extends Component
{

    public $co_name;
    public $co_address;
    public $co_contact_number;
    public $co_email;
    public $co_website;

    protected $rules = [
        'co_name' => 'required|string|max:255',
        'co_address' => 'required|string|max:255',
        'co_contact_number' => 'required|string|max:15',
        'co_email' => 'required|email|max:255',
        'co_website' => 'nullable|url|max:255',
    ];

    protected $messages = [
        'co_name.required' => 'The Company Name field is required.',
        'co_address.required' => 'The Company Address field is required.',
        'co_contact_number.required' => 'The Company Tel. No. field is required.',
        'co_email.required' => 'The Company Email field is required.',
        'co_email.email' => 'The Company Email must be a valid email address.',
        'co_website.url' => 'The Company Website must be a valid URL.',
    ];

    public function addCompany()
    {
        $validatedData = $this->validate();

        OjtCompany::create($validatedData);

        session()->flash('status', 'Company successfully created.');

        return $this->redirect('/add-company-page');
    }

    public function render()
    {
        return view('livewire.add-company');
    }
}

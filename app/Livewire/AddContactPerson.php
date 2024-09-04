<?php

namespace App\Livewire;

use App\Models\OjtContactPerson;
use Livewire\Component;

class AddContactPerson extends Component
{
    public $companyId;
    public $contact_person;
    public $editingContactId;
    public $contact_name;
    public $contact_position;
    public $contact_contact;
    public $contact_email;

    public function mount($companyId)
    {
        $this->companyId = $companyId;
        $this->contact_person = OjtContactPerson::where('company_id', $this->companyId)
        ->orderBy('id') // Order by ID in ascending order
            ->get();
    }

    public function save()
    {
        $this->validate([
            'contact_name' => 'required|string|max:255',
            'contact_position' => 'required|string|max:255',
            'contact_contact' => 'required|string|max:255',
            'contact_email' => 'required|string|max:255',
        ]); 

        $contactPersonData = [
            'company_id' => $this->companyId,
            'contact_name' => $this->contact_name,
            'contact_position' => $this->contact_position,
            'contact_contact' => $this->contact_contact,
            'contact_email' => $this->contact_email,
        ];

        OjtContactPerson::create($contactPersonData);

        session()->flash('create-status', 'Contact Person Successfully Created!');

        // Clear input fields after saving
        // $this->reset(['contact_name', 'contact_position', 'contact_contact', 'contact_email']);

        // Refresh the contact person list
        // $this->contact_person = OjtContactPerson::where('company_id', $this->companyId)->get();

         // Redirect to the view-company-page with the selected company ID
        return redirect()->route('view-company-page', ['selectedCompanyId' => $this->companyId]);
    }

    public function edit($contactId)
    {
        $this->editingContactId = $contactId;
        $contact = OjtContactPerson::findOrFail($contactId);
        $this->contact_name = $contact->contact_name;
        $this->contact_position = $contact->contact_position;
        $this->contact_contact = $contact->contact_contact;
        $this->contact_email = $contact->contact_email;
    }

    public function update()
    {
        $this->validate([
            'contact_name' => 'required|string|max:255',
            'contact_position' => 'required|string|max:255',
            'contact_contact' => 'required|string|max:255',
            'contact_email' => 'required|string|max:255',
        ]); 

        $contact = OjtContactPerson::findOrFail($this->editingContactId);
        $contact->update([
            'contact_name' => $this->contact_name,
            'contact_position' => $this->contact_position,
            'contact_contact' => $this->contact_contact,
            'contact_email' => $this->contact_email,
        ]);

        session()->flash('update-status', 'Contact Person Successfully Updated!');

        $this->editingContactId = null;

        // Refresh the contact person list
        // $this->contact_person = OjtContactPerson::where('company_id', $this->companyId)->get();
        
        // Redirect to the view-company-page with the selected company ID
        return redirect()->route('view-company-page', ['selectedCompanyId' => $this->companyId]);
    }

    public function cancelEdit()
    {
        $this->editingContactId = null;
        $this->reset(['contact_name', 'contact_position', 'contact_contact', 'contact_email']);
    }

    public function delete($contactId)
    {
        $contact = OjtContactPerson::find($contactId);

        if ($contact) {
            $contact->delete();
            session()->flash('delete-status', 'Contact Person Successfully Deleted.');
            // Refresh the contact person list
            // $this->contact_person = OjtContactPerson::where('company_id', $this->companyId)->get();

            // Redirect to the view-company-page with the selected company ID
        return redirect()->route('view-company-page', ['selectedCompanyId' => $this->companyId]);
        }
    }

    protected $messages = [
        'contact_name' => 'The Contact Name field is required.',
        'contact_position.required' => 'The Contact Position field is required.',
        'contact_contact.required' => 'The Contact Tel. No. field is required.',
        'contact_email.required' => 'The Contact Email field is required.',
        'contact_email.email' => 'The Contact Email must be a valid email address.',
    ];

    public function render()
    {
        return view('livewire.add-contact-person', [
            'contact_person' => $this->contact_person,
        ]);
    }
}

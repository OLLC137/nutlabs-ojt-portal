<?php

namespace App\Livewire;

use App\Models\OjtCompany;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyEditInfo extends Component
{
    public $co_name;
    public $co_address;
    public $co_contact_number;
    public $co_email;
    public $co_isactive;
    public $co_website;
    public $updateStatus;

    public function save()
    {
        $this->validate([
            'co_name' => 'required|string|max:255',
            'co_address' => 'nullable|string|max:255',
            'co_contact_number' => 'nullable|string|max:255',
            'co_email' => 'nullable|email|max:255',
            'co_isactive' => 'required|boolean',
            'co_website' => 'nullable|url|max:255',
        ]);

        $company = OjtCompany::where('user_id', Auth::id())->first();
        $company->co_name = $this->co_name;
        $company->co_address = $this->co_address;
        $company->co_contact_number = $this->co_contact_number;
        $company->co_email = $this->co_email;
        $company->co_isactive = $this->co_isactive;
        $company->co_website = $this->co_website;
        $company->save();

        session()->flash('update-status', 'Company Successfully Updated.');

        return redirect()->route('dashboard');
    }
    public function goToDashboard()
    {
        return redirect()->route('dashboard');
    }

    public function render()
    {
        $companyDetail = OjtCompany::where('user_id', Auth::id())->first();

        // Set the editable fields
        $this->co_name = $companyDetail->co_name;
        $this->co_address = $companyDetail->co_address;
        $this->co_contact_number = $companyDetail->co_contact_number;
        $this->co_email = $companyDetail->co_email;
        $this->co_isactive = $companyDetail->co_isactive;
        $this->co_website = $companyDetail->co_website;

        return view('livewire.company-edit-info');
    }
}

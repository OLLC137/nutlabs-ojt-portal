<?php

namespace App\Livewire;

use App\Models\OjtContactPerson;
use App\Models\OjtCompany;
use Livewire\Component;
use Livewire\WithPagination;

class ViewCompany extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchQuery = '';
    public $filterStatus = null;
    public $selectedCompanyId = null;
    public $companyDetail;

    public $co_name;
    public $co_address;
    public $co_contact_number;
    public $co_email;
    public $co_isactive;
    public $co_website;

    protected $queryString = ['searchQuery', 'filterStatus', 'selectedCompanyId'];

    public function mount()
    {
        // Ensure filterStatus is set to a valid value
        if ($this->filterStatus === '') {
            $this->filterStatus = null;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        if ($this->filterStatus === '') {
            $this->filterStatus = null;
        }
        $this->resetPage();
    }

    public function setFilter($status)
    {
        $this->filterStatus = $status;
        $this->resetPage();
    }

    public function getStatus($isActive)
    {
        if ($isActive) {
            return '<label class="badge badge-success">Active</label>';
        } else {
            return '<label class="badge badge-primary">Inactive</label>';
        }
    }



    public function selectCompany($companyId)
    {
        $this->selectedCompanyId = $companyId;
    }

    public function triggerSearch()
    {
    }

    public function clearSearch()
    {
        $this->searchQuery = '';
    }

    public function resetCompanyDetail()
    {
        $this->selectedCompanyId = null;
        $this->filterStatus = null;
    }

    public function render()
    {
        $query = OjtCompany::query();

        if ($this->filterStatus !== null) {
            // Ensure filterStatus is a valid boolean
            if (filter_var($this->filterStatus, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null) {
                $query->where('co_isactive', $this->filterStatus);
            }
        }

            // Apply search filter if search query is provided
        if ($this->searchQuery) {
            $searchQuery = strtolower($this->searchQuery);
            $query->whereRaw('LOWER(co_name) LIKE ?', ['%' . $searchQuery . '%']);
        }
        $query->orderBy('co_isactive', 'desc')->orderBy('id');

        $companies = $query->paginate(10);

        if ($this->selectedCompanyId) {
            if (!is_numeric($this->selectedCompanyId)) {
                $this->selectedCompanyId = null;
            } else {
                $this->companyDetail = OjtCompany::findOrFail($this->selectedCompanyId);

                // Set the editable fields
                $this->co_name = $this->companyDetail->co_name;
                $this->co_address = $this->companyDetail->co_address;
                $this->co_contact_number = $this->companyDetail->co_contact_number;
                $this->co_email = $this->companyDetail->co_email;
                $this->co_isactive = $this->companyDetail->co_isactive;
                $this->co_website = $this->companyDetail->co_website;
            }
        }

        return view('livewire.view-company', [
            'companies' => $companies,
        ]);
    }

    public function saveCompanyDetails()
    {
        $this->validate([
            'co_name' => 'required|string|max:255',
            'co_address' => 'nullable|string|max:255',
            'co_contact_number' => 'nullable|string|max:255',
            'co_email' => 'nullable|email|max:255',
            'co_isactive' => 'required|boolean',
            'co_website' => 'nullable|url|max:255',
        ]);

        $company = OjtCompany::findOrFail($this->selectedCompanyId);
        $company->co_name = $this->co_name;
        $company->co_address = $this->co_address;
        $company->co_contact_number = $this->co_contact_number;
        $company->co_email = $this->co_email;
        $company->co_isactive = $this->co_isactive;
        $company->co_website = $this->co_website;
        $company->save();

        session()->flash('update-status', 'Company Successfully Updated.');

        // $this->resetCompanyDetail();

        return $this->redirect('/view-company-page');
    }

    public function delete($companyId)
    {
        $company = OjtCompany::find($companyId);

        if ($company) {
            OjtContactPerson::where('company_id', $company->id)->delete();
            $company->delete();

            session()->flash('status', 'Company Successfully Deleted.');

            return $this->redirect('/view-company-page');
        }
    }
}

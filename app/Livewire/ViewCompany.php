<?php

namespace App\Livewire;

use App\Models\OjtCompany;
use Livewire\Component;
use Livewire\WithPagination;

class ViewCompany extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $searchQuery = '';
    public $filterStatus = null;
    public $co_name;
    public $co_address;
    public $co_contact_number;
    public $co_email;
    public $co_isactive;
    public $co_website;

    protected $queryString = ['searchQuery', 'filterStatus'];

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

    public function triggerSearch()
    {
    }

    public function clearSearch()
    {
        $this->searchQuery = '';
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


        return view('livewire.view-company', [
            'companies' => $companies,
        ]);
    }
}

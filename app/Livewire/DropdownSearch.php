<?php

namespace App\Livewire;

use Livewire\Component;

class DropdownSearch extends Component
{
    public $dropdownLabel = '';
    public $searchTerm='';
    public $itemGroup;
    public $selectedItemName;
    public $isOpen = false;
    public $columnName;
    public $model;
    public $eventName;

    public function render(){
        $modelInstance = new $this->model;

        $this->itemGroup = $modelInstance::query()
        ->select('id as id', "{$this->columnName} as name")
        ->whereRaw('LOWER(' . $this->columnName . ') like ?', ['%' . strtolower($this->searchTerm) . '%'])
        ->get();
        
        return view('livewire.dropdown-search');
    }

    public function selectItem($id, $name, $eventName)
    {
        $this->selectedItemName = $name;
        $this->searchTerm = '';
        $this->closeDropdown();

        $this->dispatch($eventName, id: $id);
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }
    public function closeDropdown()
    {
        $this->isOpen = false;
    }
    public function displayNone(){
        if($this->isOpen) return '';
        else return 'display: none; !important';
    }
}

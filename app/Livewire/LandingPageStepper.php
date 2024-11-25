<?php

namespace App\Livewire;

use Livewire\Component;

class LandingPageStepper extends Component
{

    public $currentStep = 1;
    public $submitted = true;

    public function render()
    {
        return view('livewire.landing-page-stepper');
    }

    public function previousStep()
    {
        $this->currentStep = max($this->currentStep - 1, 1);
    }

    public function nextStep()
    {
        $this->currentStep = min($this->currentStep + 1, 4); // Adjust the maximum step count as needed
    }

    public function goToStep($step)
    {
        $this->currentStep = $step;
    }

    public function getStarted()
    {
        $this->submitted = true;
        return redirect()->route('view-cv-page');
    }
}

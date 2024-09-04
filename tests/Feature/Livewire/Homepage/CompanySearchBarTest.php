<?php

namespace Tests\Feature\Livewire\Homepage;

use App\Livewire\Homepage\CompanySearchBar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CompanySearchBarTest extends TestCase
{
    /** @test */
    public function can_increment_counter()
    {
        Livewire::test(CompanySearchBar::class)
            ->assertSee('Counter: 0') // Check initial counter value
            ->call('increment') // Simulate clicking the increment button
            ->assertSee('Counter: 1'); // Check if counter increments correctly
    }
}

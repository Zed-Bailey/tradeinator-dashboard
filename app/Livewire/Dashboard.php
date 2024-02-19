<?php

namespace App\Livewire;

use App\Services\OandaApi;
use Livewire\Component;

class Dashboard extends Component
{

    protected OandaApi $apiInterface;


    public function mount(
        OandaApi $api
    ): void
    { }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

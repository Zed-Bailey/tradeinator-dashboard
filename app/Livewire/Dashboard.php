<?php

namespace App\Livewire;

use App\Helpers\OandaApi;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Dashboard extends Component
{
//    public Collection $strategies;
    public OandaApi $apiInterface;

    public function mount(OandaApi $api) {
//        $this->strategies = SavedStrategy::all();
//        $this->apiInterface = $api;

    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

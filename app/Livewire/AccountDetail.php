<?php

namespace App\Livewire;

use App\Helpers\OandaApi;
use Livewire\Component;

class AccountDetail extends Component
{
    public string $id;
    protected  OandaApi $api;

    public function mount($id, OandaApi $api){
        $this->id = $id;
        $this->api = $api;
    }

    public function loadAccountSummary() {

    }

    public function render()
    {
        return view('livewire.account-detail');
    }
}

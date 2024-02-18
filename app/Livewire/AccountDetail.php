<?php

namespace App\Livewire;

use App\Helpers\OandaApi;
use Livewire\Component;

class AccountDetail extends Component
{
    public string $id;
    protected  OandaApi $api;

    public mixed $accountSummary = null;
    public mixed $accountDetail;
    public function mount($id, OandaApi $api){
        $this->id = $id;
        $this->api = $api;
        $summaryResponse = OandaApi::get()->getAccountSummary($this->id);
        if($summaryResponse->getStatusCode() == 200) {
            $this->accountSummary = json_decode($summaryResponse->getBody()->getContents());
        }
    }

    public function loadAccountSummary() {

    }

    public function render()
    {
        return view('livewire.account-detail');
    }
}
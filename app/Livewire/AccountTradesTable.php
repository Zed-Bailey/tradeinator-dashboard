<?php

namespace App\Livewire;

use App\Services\OandaApi;
use Livewire\Component;

class AccountTradesTable extends Component
{

    public mixed $data = null;

    public string $accId;

    public function mount(OandaApi $api) {
        $res = $api->getAccountTrades($this->accId);
        if($res->getStatusCode() == 200) {
            $this->data = json_decode($res->getBody()->getContents());
        } else {
            $this->data = [];
            $this->addError('loading_error', 'an error occurred while loading the trades, status code = ' . $res->getStatusCode());
        }
    }



    public function render() {
        return view('livewire.account-trades-table');
    }
}

<?php

namespace App\Livewire\Widgets;

use App\Helpers\OandaApi;
use Livewire\Component;


class AccountsWidget extends Component
{
    protected OandaApi $api;
    public ?array $accounts = null;

    public function mount(OandaApi $api) {
        $this->api = $api;
        $this->reload();
    }
    public function reload(): void
    {
        $a = $this->api->getAccounts();
        if($a->getStatusCode() == 200) {
            $this->accounts = json_decode($a->getBody()->getContents())->accounts;
        }

    }
    public function render() {
        return view('livewire.accounts-widget');
    }

}


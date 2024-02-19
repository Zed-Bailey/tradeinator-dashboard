<?php

namespace App\Livewire\Widgets;

use App\Services\OandaApi;
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
            $this->accounts = collect(json_decode($a->getBody()->getContents())->accounts)->sort()->toArray();
        }

    }
    public function render() {
        return view('livewire.accounts-widget');
    }

}


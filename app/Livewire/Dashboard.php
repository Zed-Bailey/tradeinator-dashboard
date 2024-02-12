<?php

namespace App\Livewire;

use App\Helpers\OandaApi;
use Livewire\Component;

class Dashboard extends Component
{

    protected OandaApi $apiInterface;


    public function mount(
        OandaApi $api
    ): void
    {
//        $this->apiInterface = $api;
//        $res = $api->getCandles('AUD_CHF', 'H1', 10);
//        dump($res->getBody()->getContents());
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

<?php

namespace App\Livewire;

use App\Helpers\OandaApi;
use App\Models\Enums\InstrumentNames;
use Filament\Widgets\ChartWidget;
use Livewire\Component;

class InstrumentPriceChart extends ChartWidget
{



    protected function getData(): array
    {
        $api = OandaApi::get()->getCandles(InstrumentNames::AUD_CHF, count: 10);
        $body = json_decode($api->getBody()->getContents());


        $candles = collect($body->candles);
        $values = $candles->map(function ($candle){

            $sum = collect($candle->mid)->sum();
            return $sum / 4;
        });

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => $values,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];

    }
//    public function mount(OandaApi $api) {
//        $this->api = $api;
//    }


//
//    public function render()
//    {
//        return view('livewire.instrument-price-chart');
//    }

    protected function getType(): string
    {
        return 'line';
    }
}

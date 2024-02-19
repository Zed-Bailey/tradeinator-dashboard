<?php

namespace App\Livewire;

use App\Services\OandaApi;
use App\Models\Enums\InstrumentNames;
use Filament\Widgets\ChartWidget;
use Livewire\Attributes\On;


class InstrumentPriceChartWidget extends ChartWidget
{
    protected static ?string $pollingInterval = '120s';



    public array $record;
    public function mount(): void
    {
//        dump($this->record);
    }

    // listens to the updateChartData event dispatched by the InstrumentPriceChart component
    #[On("updateChartData")]
    public function reload(): void
    {
        // need to refresh data here?
    }

    protected function getData(): array
    {

        $instrument = constant("App\Models\Enums\InstrumentNames::" . $this->record['instrument']);
        $granularity = constant("App\Models\Enums\CandlestickGranularity::" . $this->record['granularity']);

        $api = OandaApi::get()->getCandles($instrument, $granularity, count: 200);
        $body = json_decode($api->getBody()->getContents());


        $candles = collect($body->candles);
        $values = $candles->map(function ($candle){

            $sum = collect($candle->mid)->sum();
            return $sum / 4;
        });
        $labels = $candles->map(function ($c) {
            $time = date_parse($c->time);

            return $time['day'] . '/'. $time['month'] . '/'. $time['year'] . ' ' . $time['hour'] . ':'. $time['minute'];

        });

        return [
            'datasets' => [
                [
                    'label' => "{$instrument->name} {$granularity->name} Currency prices",
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];

    }


    protected function getType(): string
    {
        return 'line';
    }
}

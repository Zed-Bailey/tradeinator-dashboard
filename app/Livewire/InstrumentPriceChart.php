<?php

namespace App\Livewire;

use App\Services\OandaApi;
use App\Models\Enums\CandlestickGranularity;
use App\Models\Enums\InstrumentNames;
use Livewire\Component;
use Livewire\Livewire;

class InstrumentPriceChart extends Component
{
    public string $selectedInstrument;
    public string $selectedGranularity;


    protected OandaApi $api;

    public function mount(OandaApi $api) {
        $this->api = $api;
        $this->selectedInstrument = "AUD_USD";
        $this->selectedGranularity = "M30";
    }


    public function getData() {
        $this->dispatch('updateChartData')->to(InstrumentPriceChartWidget::class);
//        error_log($this->selectedInstrument);
//        error_log($this->selectedGranularity);

    }

    public function render()
    {
        return view('livewire.instrument-price-chart');
    }
}

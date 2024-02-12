<div>
    <form wire:submit="getData" class="flex items-center gap-5">
        <div class="flex flex-col">
            <label for="instrumentSelect">Instruments</label>
            <select id="instrumentSelect" wire:model="selectedInstrument">
                @foreach(\App\Models\Enums\InstrumentNames::cases() as $case)
                    <option value="{{$case->name}}">{{$case->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col">
            <label for="granularitySelect">Granularity</label>
            <select id="granularitySelect" wire:model="selectedGranularity">
                @foreach(\App\Models\Enums\CandlestickGranularity::cases() as $case)
                    <option value="{{$case->name}}">{{$case->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="p-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600">Load</button>
        </div>
    </form>


    @livewire(App\Livewire\InstrumentPriceChartWidget::class, ['record' => ['instrument' => $selectedInstrument, 'granularity' => $selectedGranularity]])

</div>

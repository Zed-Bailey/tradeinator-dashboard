<div class="mt-5 w-full max-w-7xl">
    <a href="/" wire:click class="p-2 border bg-gray-100 hover:bg-gray-200 rounded-lg"><- Back</a>
    <h1 class="my-5 text-2xl">{{$accountSummary->account->alias}}</h1>

    <div class="w-full grid grid-cols-12 space-x-2 space-y-2">
        <div class="col-span-12">
            @livewire(App\Livewire\Widgets\ProfitAndLossWidget::class, ['accountSummary' => $accountSummary])
        </div>

        @foreach($accountSummary->account->positions as $instrumentSummary)
            <div class="col-span-12 mt-5">
                <h2 class="text-lg font-bold">{{$instrumentSummary->instrument}}</h2>
                <hr class="my-2"/>
                @livewire(App\Livewire\Widgets\AccountInstrumentWidget::class, ['instrumentSummary' => $instrumentSummary])
            </div>

        @endforeach

        <div class="col-span-12">
            @livewire('account-trades-table', ['accId' => $id])
        </div>


{{--        <div class="col-span-12 w-full">--}}
{{--            {{json_encode($accountSummary, JSON_PRETTY_PRINT)}}--}}
{{--        </div>--}}

    </div>
</div>


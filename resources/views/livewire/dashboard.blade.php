<div class="w-full max-w-7xl grid grid-cols-12 space-x-2 space-y-2">

    <div class="col-span-12  md:col-span-6">
        @livewire(App\Livewire\Widgets\AccountsWidget::class)
    </div>



    <div class="col-span-12">
        @livewire('strategy-list-table')
    </div>

    <div class="col-span-12">
        <livewire:instrument-price-chart></livewire:instrument-price-chart>

    </div>

</div>

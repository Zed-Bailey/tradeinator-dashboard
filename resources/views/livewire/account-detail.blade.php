<div class="">
    <a href="/" wire:click class="p-2 border bg-gray-100 hover:bg-gray-200 rounded-lg">Back</a>
    <div class="w-full max-w-7xl grid grid-cols-12 space-x-2 space-y-2">
        <div class="col-span-12">
            @livewire(App\Livewire\Widgets\ProfitAndLossWidget::class, ['accountSummary' => $accountSummary])
        </div>
    </div>
</div>


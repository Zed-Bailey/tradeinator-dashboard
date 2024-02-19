<?php

namespace App\Livewire\Widgets;

use Livewire\Component;
use App\Services\OandaApi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
class AccountInstrumentWidget extends BaseWidget
{
    // disable polling
    protected static ?string $pollingInterval = null;

    public mixed $instrumentSummary;

    protected function getStats(): array
    {
        $json = $this->instrumentSummary;
        if($json == null) {
            return [];
        }

        return [
            Stat::make('Long P/L', $json->long->pl),
            Stat::make('Long Unrealised P/L', $json->long->unrealizedPL)
                ->description($json->long->units . ' units'),

            Stat::make('Short P/L', $json->short->pl),
            Stat::make('Short Unrealised P/L', $json->short->unrealizedPL)
                ->description($json->short->units . ' units'),


        ];
    }
}

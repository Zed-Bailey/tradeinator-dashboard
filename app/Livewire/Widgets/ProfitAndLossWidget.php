<?php

namespace App\Livewire\Widgets;

use App\Helpers\OandaApi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProfitAndLossWidget extends BaseWidget
{
    // disable polling
    protected static ?string $pollingInterval = '360s';

    public mixed $accountSummary;

    protected function getStats(): array
    {
        $json = $this->accountSummary;
        if($json == null) {
            return [];
        }

        return [
            Stat::make('P/L', $json->account->pl)
                ->description('accounts profit and loss')
                ->color(floatval($json->account->pl) > 0 ? 'success' : 'danger'),
            Stat::make('Unrealised P/L', $json->account->unrealizedPL)
                ->description('accounts unrealised profit and loss'),
            Stat::make('Open Positions', $json->account->openPositionCount),
            Stat::make('Position Value', $json->account->positionValue),
        ];
    }
}

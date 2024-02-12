<?php

namespace App\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProfitAndLossWidget extends BaseWidget
{
    // disable polling
    protected static ?string $pollingInterval = null;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Trades', '100'),
            Stat::make('P/L', '+$10')
                ->chart([4,5,6,7,8,9,10])
                ->color('success'),
            Stat::make('Avg trade size', '$ 10k')
        ];
    }
}

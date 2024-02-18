<?php

namespace App\Livewire;

use App\Models\SavedStrategy;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class StrategyListTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function render()
    {
        return view('livewire.strategy-list-table');
    }

    function table(Table $table) : Table {
        return $table->query(fn () => SavedStrategy::query())
            ->columns([
                TextColumn::make('SavedStrategyId'),
                TextColumn::make('Slug')
                    ->sortable(),
                TextColumn::make('StrategyName'),
                TextColumn::make('LastUpdated')
                    ->sortable(),
                ToggleColumn::make('')
                    ->afterStateUpdated(function ($record, $state) {
                        // would send rabbit mq message here
                    })
            ])->actions([
                Action::make('view')
//                ->action(function() {
//                    Notification::make()
//                        ->title("View clicked")
//                        ->success()
//                        ->send();
//                })
                    ->url(fn (SavedStrategy $strategy) => route('detail', $strategy))
            ]);
    }
}

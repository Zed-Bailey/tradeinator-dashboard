<?php

namespace App\Widgets;

use App\Helpers\OandaApi;
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


class AccountsWidget extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    function table(Table $table) : Table {
        $json = OandaApi::get()->getAccounts();
        $accounts = json_decode($json->getBody()->getContents());

        return $table

            ->columns([

            ])->actions([
                Action::make('view')
                    ->url(fn ($accId) => '/')
            ]);
    }
}


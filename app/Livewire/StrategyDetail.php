<?php

namespace App\Livewire;

use App\Models\SavedStrategy;
use App\Services\RabbitMqService;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Carbon\Carbon;

class StrategyDetail extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public $id;
    public SavedStrategy $strategy;

    public ?array $data = [];

    public $rawJsonConfig = "";


    public function mount($id): void
    {
        $this->id = $id;
        $this->strategy = SavedStrategy::find($id);
        $this->rawJsonConfig = $this->strategy->Config;
        $this->form->fill();
    }

    public function editStrategyNameAction() : Action {
        return Action::make('editStrategyName')
            ->fillForm([
                'strategyName' => $this->strategy->StrategyName
            ])
            ->form([
                TextInput::make('strategyName')
                ->label('Strategy Name')
                ->required()
            ])
            ->action(function(array $data) {
                $this->strategy->StrategyName = $data['strategyName'];
                $this->strategy->save();
            });
    }

    public function form(Form $form): Form {
        $jsonConfig = json_decode($this->strategy->Config);
        $fields = [];

        foreach ($jsonConfig as $param) {
            switch($param->Type) {
                case "System.Boolean":
                    $fields[] = Checkbox::make($param->PropertyName)
                        ->default($param->Value);

                    break;
                case "System.String":
                    $fields[] = TextInput::make($param->PropertyName)
                        ->default($param->Value)
                        ->required();
                    break;

                case "System.Double":
                case "System.Decimal":
                case "System.Float":
                    $fields[] = TextInput::make($param->PropertyName)
                        ->default($param->Value)
                        ->numeric()
                        ->required();
                    break;

                case "System.Int32":
                    $fields[] = TextInput::make($param->PropertyName)
                    ->default($param->Value)
                    ->numeric()
                    ->step(1)
//                    ->regex('/^-?([0-9]\d*)$/gm')
                    ->required();
                    break;
            }
        }

        return $form
            ->schema($fields)
            ->statePath('data');
    }


    public function render()
    {
        return view('livewire.strategy-detail');
    }


    public function deleteStrategy() {
        $this->strategy->delete();
        redirect('/');
    }

    public function duplicateStrategy() {
        $strategy = SavedStrategy::find($this->id);

        // duplicate the model
        $clonedStrategy = $strategy->replicate();
        $clonedStrategy->CreatedAt = Carbon::now()->toDateTimeString();
        $clonedStrategy->LastUpdated = $clonedStrategy->CreatedAt;
        $clonedStrategy->save();



        $msg = [
            "Slug" => $clonedStrategy->Slug,
            "Id" => $clonedStrategy->SavedStrategyId
        ];

        $rabbitService = app(RabbitMqService::class);
        $rabbitService->publish(json_encode($msg), "update." . $clonedStrategy->Slug);

        Notification::make()
            ->title('Duplicated strategy and published update event to exchange')
            ->success()
            ->send();


        redirect('/');
    }

    public function submitConfigUpdate() {
        $config = json_decode($this->strategy->Config);
        $formState = $this->form->getState();
        foreach($config as $param) {
            $param->Value = $formState[$param->PropertyName];
        }

        $json = json_encode($config);

        $strategy = SavedStrategy::find($this->id);
        $strategy->Config = $json;
        $strategy->LastUpdated = Carbon::now()->toDateTimeString();
        $strategy->save();

        $msg = [
            "Slug" => $this->strategy->Slug,
            "Id" =>$this->id
        ];
        $rabbitService = app(RabbitMqService::class);
        $rabbitService->publish(json_encode($msg), "update." . $this->strategy->Slug);

        Notification::make()
            ->title('Published strategy update event to exchange')
            ->success()
            ->send();

        redirect('/');
    }

    public function updateRawConfig() {
        $strategy = SavedStrategy::find($this->id);
        $strategy->Config = $this->rawJsonConfig;
        $strategy->LastUpdated = Carbon::now()->toDateTimeString();
        $strategy->save();

        Notification::make()
            ->title('Updated Raw Json Config')
            ->success()
            ->send();

        redirect('/');
    }
}

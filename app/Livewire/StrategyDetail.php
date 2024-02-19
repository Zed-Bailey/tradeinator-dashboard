<?php

namespace App\Livewire;

use App\Models\SavedStrategy;
use App\Services\RabbitMqService;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class StrategyDetail extends Component implements HasForms
{
    use InteractsWithForms;

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
//                    ->numeric()
//                    ->step(1)
                    ->regex('/^-?([0-9]\d*)$/gm')
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
        $clonedStrategy->CreatedAt = date('YYYY-MM-DD HH:MM:SS', time());
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
        $strategy->LastUpdated = date('YYYY-MM-DD HH:MM:SS', time());
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
        $strategy->LastUpdated = date('YYYY-MM-DD HH:MM:SS', time());
        $strategy->save();

        Notification::make()
            ->title('Updated Raw Json Config')
            ->success()
            ->send();

        redirect('/');
    }
}

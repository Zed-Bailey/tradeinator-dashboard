<?php

namespace App\Livewire;

use App\Models\SavedStrategy;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class StrategyDetail extends Component implements HasForms
{
    use InteractsWithForms;

    public $id;
    public SavedStrategy $strategy;

    public ?array $data = [];

    public $rawJsonConfig = "";

    public function mount($id) {
        $this->id = $id;
        $this->strategy = SavedStrategy::find($id);
        $this->rawJsonConfig = $this->strategy->Config;
        $this->form->fill();
    }

    public function form(Form $form): Form {
        error_log($this->strategy);
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


    public function submitConfigUpdate() {
        dump($this->form->getState());

    }

    public function updateRawConfig() {

    }
}

<?php

namespace App\Livewire;

use App\Services\OandaApi;
use Illuminate\Support\Collection;
use Livewire\Component;

class AccountTransactionsTable extends Component
{

    protected OandaApi $api;

    public Collection|null $data = null;
    public string $accId;
    public function mount(OandaApi $api) : void {
        $this->api = $api;
        $transactionsResponse = $this->api->getAccountTransactions($this->accId);
        if($transactionsResponse->getStatusCode() == 200) {
            $json = json_decode($transactionsResponse->getBody()->getContents());
            $this->data = collect($json->transactions);
            $this->data = $this->data->sortByDesc(fn($d) => $d->id);
        } else {
            $this->addError('transactions_error', "Failed to load account transactions");
        }
    }

    public function render()
    {
        return view('livewire.account-transactions-table');
    }
}

<?php

namespace App\Helpers;

use App\Models\Enums\CandlestickGranularity;
use App\Models\Enums\InstrumentNames;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class OandaApi
{
    private string $apiKey;
    private Client $client;

    /**
     * Will resolve an instance from the app service container
     * @return OandaApi
     */
    public static function get(): OandaApi {
        return app(OandaApi::class);
    }
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://api-fxpractice.oanda.com/v3/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey
            ]
        ]);
    }

    public function getCandles(InstrumentNames $instrument, CandlestickGranularity $granularity = CandlestickGranularity::H1, int $count = 200): ResponseInterface {
        return $this->client->get(
            'instruments/' . $instrument->name . '/candles',
            [
                'query' => [
                    'count' => $count,
                    'smooth' => 'true'
                ]
            ]
        );
    }

    public function getAccounts() {
        return $this->client->get('accounts');
    }

    public function getAccountDetail(string $accId) {
        return $this->client->get('accounts/'.$accId);
    }

    public function getAccountSummary(string $accId) {
        return $this->client->get('accounts/' . $accId . '/summary');
    }

}

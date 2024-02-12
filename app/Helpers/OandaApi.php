<?php

namespace App\Helpers;

use App\Models\Enums\CandlestickGranularity;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class OandaApi
{
    private string $apiKey;
    private Client $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://api-fxpractice.oanda.com/v3/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey
            ]
        ]);
        dump($this->client);
    }

    public function getCandles(string $instrument, CandlestickGranularity $granularity = CandlestickGranularity::H1, int $count = 200): ResponseInterface {
        return $this->client->get(
            'instruments/' . $instrument . '/candles',
            [
                'query' => [
                    'count' => $count
                ]
            ]
        );
    }

    public function getAccounts() {
        $request = $this->client->request('GET', 'accounts')
            ->withAddedHeader('Authorization', 'Bearer ' . $this->apiKey);

        return $this->client->send($request);
    }

}

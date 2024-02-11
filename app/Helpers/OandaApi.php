<?php

namespace App\Helpers;

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
            'base_uri' => 'https://api-fxpractice.oanda.com/v3/'
        ]);
    }

    public function getAccounts() : ResponseInterface {
        $request = $this->client->request('GET', '/accounts')
            ->withAddedHeader('Authorization', 'Bearer ' . $this->apiKey);

        return $this->client->send($request);
    }

}

<?php

namespace Baselime;

use GuzzleHttp\Client;

class Baselime
{
    private string $apiKey;
    private Client $client;

    public function __construct(string $apiKey)
    {
        $this->client = new Client();
        $this->apiKey = $apiKey;
    }

    public function event(string $service, array $data)
    {
        $this->client->post("https://events.baselime.io/v1/logs", [
            "headers" => [
                "x-api-key" => $this->apiKey,
                "Content-Type" => "application/json",
                "x-service" => $service,
            ],
            "json" => $data,
        ]);
    }
}

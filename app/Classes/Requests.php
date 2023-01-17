<?php

namespace App\Classes;

use GuzzleHttp\Client;
class Requests implements RequestInterface {
    private $client;
    private $baseUri;

    public function __construct(String $baseUri, Client $client)
    {
        $this->client = $client;
        $this->baseUri = $baseUri;
    }   

    public function tokenPage()
    {
        $response = $this->client->get('');

        return (string) $response->getBody();
    }

    public function answerPage(String $token)
    {
        $response = $this->client->post('', [
            'headers' => [
                'Referer' => $this->baseUri,
            ],
            'form_params' => [
                'token' => $token
            ]
        ]);
        
        return (string) $response->getBody();
    }
}
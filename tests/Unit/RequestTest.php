<?php

namespace Tests\Unit;

use App\Classes\Crawler;
use App\Classes\Requests;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{

    public function test_token() {
        $page = 'html content';
        $requests = new Requests('', $this->configureMock($page));

        $crawler = new Crawler();
        $response = $requests->tokenPage($crawler);

        $this->assertEquals($page, $response, 'Response of token page');
    }

    public function test_answer() 
    {
        $page = 'html content response page';
        $requests = new Requests('', $this->configureMock($page));

        $response = $requests->answerPage('123');

        $this->assertEquals($page, $response, 'Response of token page');
    }

    private function configureMock($page) 
    {
        
        $mock = new MockHandler([
            new Response(200, [], $page),
        ]);

        $handlerStack = HandlerStack::create($mock);
        return new Client(['handler' => $handlerStack]);
    }
}

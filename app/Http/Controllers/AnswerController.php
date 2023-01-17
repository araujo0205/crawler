<?php

namespace App\Http\Controllers;

use App\Classes\Crawler;
use App\Classes\Requests;
use GuzzleHttp\Client;

class AnswerController extends Controller
{
    public function index()
    {
        $baseUri = env('ANSWER_BASE_URI');

        $client = new Client([
            'base_uri' => $baseUri,
            'cookies' => true          
        ]);
        $requests = new Requests($baseUri, $client);
        $crawler = new Crawler();

        $tokenPage = $requests->tokenPage($crawler);
        $token = $crawler->token($tokenPage);

        $answerPage = $requests->answerPage($token);
        $answer = $crawler->answer($answerPage);

        return response()->json(['answer' => $answer]);
    }

}

<?php

namespace App\Classes;

use Symfony\Component\DomCrawler\Crawler as CrawlerLib;

class Crawler implements CrawlerInterface {
    function token(String $html)
    {
        if($html == '') {
            throw new \Exception("Html value is empty.", 1);
        }

        $crawler = new CrawlerLib($html);

        $token = $crawler->filter("input[name=token]")->attr('value');

        return $this->convertToken($token);
    }

    function answer(String $html)
    {
        if($html == '') {
            throw new \Exception("Html value is empty.", 1);
        }

        $crawler = new CrawlerLib($html);
        return $crawler->filter("#answer")->first()->html();
    }

    private function convertToken($token)
    {
        $replacements = [
            'a' => "\x7a",
            'b' => "\x79",
            'c' => "\x78",
            'd' => "\x77",
            'e' => "\x76",
            'f' => "\x75",
            'g' => "\x74",
            'h' => "\x73",
            'i' => "\x72",
            'j' => "\x71",
            'k' => "\x70",
            'l' => "\x6f",
            'm' => "\x6e",
            'n' => "\x6d",
            'o' => "\x6c",
            'p' => "\x6b",
            'q' => "\x6a",
            'r' => "\x69",
            's' => "\x68",
            't' => "\x67",
            'u' => "\x66",
            'v' => "\x65",
            'w' => "\x64",
            'x' => "\x63",
            'y' => "\x62",
            'z' => "\x61",
            '0' => "\x39",
            '1' => "\x38",
            '2' => "\x37",
            '3' => "\x36",
            '4' => "\x35",
            '5' => "\x34",
            '6' => "\x33",
            '7' => "\x32",
            '8' => "\x31",
            '9' => "\x30"
        ];

        $token_split =  str_split($token);
        for ($token_split, $t = 0 ; $t < count($token_split); $t++) { 
            $token_split[$t] = $replacements[$token_split[$t]] ?? $token_split[$t];
        }
        return implode($token_split);
    }
}
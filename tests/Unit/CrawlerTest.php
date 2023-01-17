<?php

namespace Tests\Unit;

use App\Classes\Crawler;
use PHPUnit\Framework\TestCase;

class CrawlerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_token_with_html()
    {
        $token = '111';
        $tokenConvert = '888';

        $html = "<html>
                    <body>
                        <input name='token' value='$token'>
                    </body>
                </html>
                ";
        $crawler = new Crawler();

        $tokenResponse = $crawler->token($html);

        $this->assertEquals($tokenConvert, $tokenResponse, 'Find token in input');
    }
    
    public function test_token_without_input()
    {
        $this->expectException(\Exception::class);

        $crawler = new Crawler();
        $crawler->token('');
    }

    public function test_answer_with_html()
    {
        $answer = 42;

        $html = "<html>
                    <body>
                        <span id='answer'>$answer</span>
                    </body>
                </html>
                ";

        $crawler = new Crawler();
        $answerResponse = $crawler->answer($html);

        $this->assertEquals($answer, $answerResponse, 'Find span with answer response');
    }

    public function test_answer_without_html()
    {
        $this->expectException(\Exception::class);

        $crawler = new Crawler();
        $crawler->answer('');
    }
}

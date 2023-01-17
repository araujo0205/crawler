<?php
namespace App\Classes;

interface CrawlerInterface {
    function token(String $html);
    function answer(String $html);
}
<?php

namespace App\Classes;

interface RequestInterface {
    function tokenPage();
    function answerPage(String $token);
}
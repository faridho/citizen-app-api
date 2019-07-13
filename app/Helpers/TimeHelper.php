<?php

namespace App\Helpers;

class TimeHelper
{
    public static function serverElapsedTime()
    {
        $elapsed = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];

        return floor($elapsed * 1000);
    }
}

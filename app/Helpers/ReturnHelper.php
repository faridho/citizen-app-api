<?php

namespace App\Helpers;
use App\Helpers\TimeHelper as TH;
class ReturnHelper
{
    public static function getReturn($status, $message, $result)
    {
        $return = \Response::json(array(
            'status' => $status,
            'message' => $message,
            'data' => $result,
            'elapsed' => TH::serverElapsedTime()
        ));
        
        return $return;
    }
}

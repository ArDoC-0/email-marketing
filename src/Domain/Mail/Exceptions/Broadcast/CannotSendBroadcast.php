<?php

namespace Domain\Mail\Exceptions\Broadcast;

use Carbon\Carbon;
use Exception;

class CannotSendBroadcast extends Exception
{
    
    public static function broadcastAlreadySent(Carbon $date) :self
    {
        return new self("Broadcast already sent at {$date}");
    }
}
<?php
namespace Domain\Mail\Enums\Broadcast;

enum BroadcastStatus: string
{
    case Draft = 'draft';
    case Sent = 'sent';

    public function canSend()
    {
        return match($this) {
            self::Draft => true,
            self::Sent => false
        };
    }
}
<?php

namespace Domain\Subscriber\Enums;

enum SubscriberStatus : string
{
    case InProgress = 'inProgress';
    case Completed = 'completed';
}
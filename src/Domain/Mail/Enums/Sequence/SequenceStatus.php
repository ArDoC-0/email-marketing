<?php

namespace Domain\Mail\Enums\Sequence;

enum SequenceStatus : string
{
    case Draft = 'draft';
    case InProgress = 'inProgress';
    case Published = 'published';
}
<?php

namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Contracts\Sendable;
use Domain\Shared\Models\BaseModel;

class SequenceMail extends BaseModel implements Sendable
{
    public function id() : int
    {
        return $this->id;
    }

    public function type() : string
    {
        return $this::class;
    }
}
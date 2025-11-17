<?php

namespace Domain\Mail\Builder\Sequence;

use Illuminate\Database\Eloquent\Builder;

class SequenceBuilder extends Builder
{
    
    public function whereStatus($status)
    {
        return $this->where('status', $status);
    }
}
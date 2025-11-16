<?php
namespace Domain\Mail\Models\Sequence;

use Domain\Mail\Contracts\Sendable;
use Domain\Shared\Models\BaseModel;

class Sequence extends BaseModel implements Sendable
{
    protected $table = 'sequences';

    protected $fillable = [
        'title',
        'status'
    ];
    
    public function id() : int
    {
        return $this->id;
    }

    public function type() : string
    {
        return $this::class;
    }
}
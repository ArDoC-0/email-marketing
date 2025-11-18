<?php

namespace Domain\Shared\Filters;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

class DateFilters implements Arrayable
{
    public function __construct(
        public Carbon $startDate,
        public Carbon $endDate
    )
    {
        
    }

    public static function thisMonth() : self
    {
        return new self(
            startDate: now()->startOfMonth(),
            endDate: now()
        );
    }

    public static function thisWeek()
    {
        return new self(
            startDate: now()->startOfWeek(),
            endDate: now()
        );
    }

    public static function today()
    {
        return new self(
            startDate: now()->startOfDay(),
            endDate:now()
        );
    }

    public function toArray() : array
    {
        return [
            $this->startDate,
            $this->endDate
        ];
    }
}
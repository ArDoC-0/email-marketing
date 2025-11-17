<?php

namespace Domain\Mail\Contracts;

use Domain\Mail\DataTransferObjects\FilterData;

interface Sendable
{
    /**
     * Id of the sendable
     */
    public function id() : int;

    /**
     * Get sendable subject
     */
    public function subject(): string;

    /**
     * Get sendable content
     */
    public function content(): string;

    /**
     * class in string of the sendable
     */
    public function type() : string;

    /**
     * Get Sendable filters
     */
    public function filters() : FilterData;
}
<?php

namespace Domain\Mail\Contracts;

interface Sendable
{
    /**
     * Id of the sendable
     */
    public function id() : int;

    /**
     * class in string of the sendable
     */
    public function type() : string;

}
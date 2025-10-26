<?php
namespace Domain\Subscriber\DataTransferObjects;

use Domain\Shared\CommonDto\CommonDto;

class TagDto extends CommonDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $title
    )
    {
    }
}
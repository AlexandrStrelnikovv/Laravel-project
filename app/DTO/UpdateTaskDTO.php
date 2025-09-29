<?php

namespace App\DTO;

class UpdateTaskDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $priority,

    )
    {}

    public static function fromArray(array $validData): self
    {
        return new self(
            name: $validData['name'],
            description: $validData['description'],
            priority: $validData['priority'],
        );
    }
}

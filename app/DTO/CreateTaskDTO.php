<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CreateTaskDTO
{

    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $priority,
        public readonly string $executor_user_id,
    )
    {}

    public static function fromArray(array $validData): self
    {
        return new self(
            name: $validData['name'],
            description: $validData['description'],
            priority: $validData['priority'],
            executor_user_id: $validData['executor_user_id'],
        );
    }


}

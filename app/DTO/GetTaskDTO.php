<?php

namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;

class GetTaskDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $status,
        public readonly string $priority,
        public readonly string $created_user_id,
        public readonly string $executor_user_id,
    )
    {}

    public static function fromArray(array $validData): self
    {
        return new self(
            name: $validData['name'],
            description: $validData['description'],
            status: $validData['status'],
            priority: $validData['priority'],
            created_user_id: $validData['created_user_id'],
            executor_user_id: $validData['executor_user_id'],
        );
    }

    public static function fromCollection(Collection $validData): self
    {
        return new self(
            name: $validData->name,
            description: $validData->description,
            status: $validData->status,
            priority: $validData->priority,
            created_user_id: $validData->created_user_id,
            executor_user_id: $validData->executor_user_id,
        );
    }
}

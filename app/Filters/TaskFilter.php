<?php

namespace App\Filters;

class TaskFilter
{
    public static function apply($query, array $filters)
    {
        if (!empty($filters['name']))
        {
            $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }
        if (!empty($filters['priority']))
        {
            $query->where('priority', $filters['priority']);
        }
        if (!empty($filters['status']))
        {
            $query->where('status', $filters['status']);
        }

        return $query->get()->toArray();
    }
}

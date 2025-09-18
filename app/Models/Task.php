<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function executor()
    {
        return $this->belongsTo(User::class, 'created_userId');
    }

    public function created_user()
    {
        return $this->belongsTo(User::class, 'executor_user_id');
    }
}


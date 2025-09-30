<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'priority',
        'status',
        'created_user_Id',
        'executor_user_id',
    ];

    public function executor()
    {
        return $this->belongsTo(User::class, 'created_user_Id');
    }

    public function created_user()
    {
        return $this->belongsTo(User::class, 'executor_user_id');
    }
}


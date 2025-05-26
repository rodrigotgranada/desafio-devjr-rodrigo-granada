<?php

namespace App\Modules\Tasks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'completed',
        'completed_at',
        'user_id'
    ];

    protected $casts = [
        'completed' => 'boolean',
        'due_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Modules\Auth\Models\User::class);
    }

    protected static function newFactory()
    {
        return \App\Modules\Tasks\Database\Factories\TaskFactory::new();
    }
} 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    public $timestamps = false;

    protected $fillable = ['task_id', 'user_id', 'changed_fields'];

    protected $casts = [
        'changed_fields' => 'array',
        'created_at' => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

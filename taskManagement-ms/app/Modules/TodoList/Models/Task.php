<?php

namespace App\Modules\TodoList\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'priority',
        'date_of_completion',
        'status',
        'list_task_id'
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_completion' => 'datetime',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];
    public function listTask()
    {

        return $this->belongsTo(ListTask::class, 'list_task_id', 'id');
    }
}

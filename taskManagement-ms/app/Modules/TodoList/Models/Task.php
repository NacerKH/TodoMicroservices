<?php

namespace App\Modules\TodoList\Models;

use Database\Factories\TaskFactory;
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
        'list_task_id',
        'user_id'
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
   
    protected $appends =['status'];
    protected static function newFactory()
    {
        return TaskFactory::new();
    }  
    
    public function listTask()
    {

        return $this->belongsTo(ListTask::class, 'list_task_id', 'id');
    }

    public function getStatusAttribute()
    {

        return $this->listTask()->first()?->name;
    }
}

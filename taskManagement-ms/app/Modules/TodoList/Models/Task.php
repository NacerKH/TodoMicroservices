<?php

namespace App\Modules\TodoList\Models;

use App\Models\Attachment;
use App\Modules\TodoList\Enum\TaskPriorityEnum;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $with = ['attachments'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_completion' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];
   
    protected $appends =['status' ];
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

    static function userTasks($id)
    {

        return self::with('listTask')->where('user_id',$id)->get();
    }
    
    /**
     * Get the priority  name.
     */
    protected function priority(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>TaskPriorityEnum::getPriorityLevel($value),
        );
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}

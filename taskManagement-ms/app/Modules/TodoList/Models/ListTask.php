<?php

namespace App\Modules\TodoList\Models;

use Database\Factories\listTaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListTask extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',

    ];
    protected static function newFactory()
    {
        return listTaskFactory::new();
    } 
    public function tasks()
    {

        return $this->hasMany(Task::class, 'list_task_id', 'id');
    }

}

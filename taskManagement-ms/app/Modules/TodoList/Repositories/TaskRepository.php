<?php

namespace App\Modules\TodoList\Repositories;

use App\Modules\Concerns\BaseApiRepository;
use App\Modules\TodoList\Contracts\TaskRepositoryInterface;
use App\Modules\TodoList\Models\Task;
use App\Modules\TodoList\Resources\TaskResource;

class TaskRepository  extends BaseApiRepository   implements TaskRepositoryInterface
{
   
   public function index()
   {
         return $this->success("Lists of   Tasks  Retrieved succesffully ", TaskResource::collection(Task::get()) );
    }
 
    public function create(array $data)
    {
        $task = Task::create($data);
        return $this->success("Task Created Successfully",  TaskResource::make($task));
    }
    public function show($resource_id)
    {
        $task = Task::find($resource_id);
        if (!$task) {
            return $this->error("Task Not Found", 404);
        }
        return $this->success("Task Retrieved Successfully",  TaskResource::make($task->load('listTask')));
    }

    public function update($resource_id, array $data)
    {
        $task = Task::find($resource_id);
        if (!$task) {
            return $this->error("Task Not Found", 404);
        }
        $task->update($data);
        return $this->success("Task Updated Successfully",  TaskResource::make($task));
    }
    
    public function  delete($resource_id)
    {
        $task = Task::find($resource_id);
        if (!$task) {
            return $this->error("Task Not Found", 404);
        }
        $task->delete();
        return $this->success("Task Deleted Successfully" );
    }
}

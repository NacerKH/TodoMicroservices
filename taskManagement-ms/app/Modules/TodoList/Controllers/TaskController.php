<?php

namespace App\Modules\TodoList\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TodoList\Models\Task;
use App\Modules\TodoList\Repositories\TaskRepository;
use App\Modules\TodoList\Requests\changePriorityTaskRequest;
use App\Modules\TodoList\Requests\changeStatusTaskRequest;
use App\Modules\TodoList\Requests\TaskRequest;

class TaskController extends Controller
{


    public function __construct(private TaskRepository $taskRepository)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     return $this->taskRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        return $this->taskRepository->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return  $this->taskRepository->show($task->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        return  $this->taskRepository->update($task->id,$request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
       return $this->taskRepository->delete($task->id);

    }


    /**
     * Find the tasks related with user.
     */
    public function findUserTasks()
    {  
    
       return $this->taskRepository->findTaskByUser(request()->user_id);
    }


    /**
     * assign task the specified User id.
     */
    public function assignTask(Task $task)
    {
        $user_assigned_id = request()->get('user_assigned_id');
      
     return   $this->taskRepository->assigneTask($task, $user_assigned_id);
    }

    /**
     * assign task the specified User id.
     */
    public function changeStatus(changeStatusTaskRequest $request, Task $task)
    {
 

        return   $this->taskRepository->ChangeStatus($task, $request->validated());
    }
    
    /**
     * change Priority task .
     */
    public function changePriority(Task $task,changePriorityTaskRequest $request)
    {
      

        return   $this->taskRepository->ChangePriority($task, $request->validated());
    }


}

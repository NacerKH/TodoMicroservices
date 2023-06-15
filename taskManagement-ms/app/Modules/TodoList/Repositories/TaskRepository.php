<?php

namespace App\Modules\TodoList\Repositories;

use App\Modules\Concerns\BaseApiRepository;
use App\Modules\TodoList\Contracts\TaskRepositoryInterface;
use App\Modules\TodoList\Events\AssignedTaskEvent;
use App\Modules\TodoList\Events\ChangeStatusTaskEvent;
use App\Modules\TodoList\Models\Task;
use App\Modules\TodoList\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

class TaskRepository extends BaseApiRepository implements TaskRepositoryInterface
{
    /**
     * Get a list of tasks.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success("Lists of Tasks Retrieved successfully", TaskResource::collection(Task::get()));
    }

    /**
     * Create a new task.
     *
     * @param  array  $data
     * @return JsonResponse
     */
    public function store(array $data): JsonResponse
    {
        $task = Task::create($data);
        return $this->success("Task Created Successfully", TaskResource::make($task));
    }

    /**
     * Show a specific task.
     *
     * @param  mixed  $resource_id
     * @return JsonResponse
     */
    public function show($resource_id): JsonResponse
    {
        $task = Task::find($resource_id);
        if (!$task) {
            return $this->error("Task Not Found", 404);
        }
        return $this->success("Task Retrieved Successfully", TaskResource::make($task->load('listTask')));
    }

    /**
     * Update a task.
     *
     * @param  mixed  $resource_id
     * @param  array  $data
     * @return JsonResponse
     */
    public function update($resource_id, array $data): JsonResponse
    {
        $task = Task::find($resource_id);
        if (!$task) {
            return $this->error("Task Not Found", 404);
        }
        $task->update($data);
        return $this->success("Task Updated Successfully", TaskResource::make($task));
    }

    /**
     * Delete a task.
     *
     * @param  mixed  $resource_id
     * @return JsonResponse
     */
    public function delete($resource_id): JsonResponse
    {
        $task = Task::find($resource_id);
        if (!$task) {
            return $this->error("Task Not Found", 404);
        }
        $task->delete();
        return $this->success("Task Deleted Successfully");
    }

    /**
     * Find tasks by user.
     *
     * @param  mixed  $user_id
     * @return JsonResponse
     */
    public function findTaskByUser($user_id): JsonResponse
    {
        $tasks = Task::userTasks($user_id);
        if (!$tasks) {
            return $this->error("Task Not Found", 404);
        }
        return $this->success("User Tasks Retrieved Successfully", TaskResource::collection($tasks));
    }

    /**
     * Assign a task to a user.
     *
     * @param  Task  $task
     * @param  mixed  $user_id
     * @return JsonResponse
     */
    public function assigneTask($task, $user_id): JsonResponse
    {
        if (!$task) {
            return $this->error("Task Not Found", 404);
        }

        $task->update(['user_id' => $user_id]);

          event( new AssignedTaskEvent($task) );

        return $this->success("User assigned Task Successfully", TaskResource::make($task));
    }

    /**
     * Change  Priority Of task .
     *
     * @param  Task  $task
     * @param  int  $priority
     * @return JsonResponse
     */
    public function ChangePriority($task, $priority): JsonResponse
    {
        if (!$task) {
            return $this->error("Task Not Found", 404);
        }

        $task->update($priority);

        return $this->success("User change  Task  Priority Successfully", TaskResource::make($task));
    }

    /**
     * Change  status Of task .
     *
     * @param  Task  $task
     * @param  int  $status
     * @return JsonResponse
     */
    public function ChangeStatus($task, $status): JsonResponse
    {  
        if (!$task) {
            return $this->error("Task Not Found", 404);
        }

        $task->update($status);
        event(new ChangeStatusTaskEvent($task));
        return $this->success("User change status Task Successfully", TaskResource::make($task));
    }
}

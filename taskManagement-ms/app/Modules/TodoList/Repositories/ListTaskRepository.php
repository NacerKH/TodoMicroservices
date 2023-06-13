<?php

namespace App\Modules\TodoList\Repositories;


use App\Modules\Concerns\BaseApiRepository;
use App\Modules\TodoList\Contracts\ListTaskRepositoryInterface;
use App\Modules\TodoList\Models\ListTask;
use App\Modules\TodoList\Resources\ListTaskResource;

class ListTaskRepository  extends BaseApiRepository   implements ListTaskRepositoryInterface
{



    public function index()
    {    

      return $this->success("Lists of   Tasks  Retrieved succesffully ", ListTaskResource::collection(ListTask::with('tasks')->get()) );
  
    }

    public function store(array $data)
    {
        $listTask = ListTask::create($data);
        return $this->success("List Task Created Successfully",  ListTaskResource::make($listTask));
    }
    public function show($resource_id)
    {
        $listTask = ListTask::find($resource_id);
        if (!$listTask) {
            return $this->error("List Task Not Found", 404);
        }
        return $this->success("List Task Retrieved Successfully",  ListTaskResource::make($listTask->load(['tasks'])));
    }


    public function update($resource_id, array $data)
    {
        $listTask = ListTask::find($resource_id);
        if (!$listTask) {
            return $this->error("List Task Not Found", 404);
        }
        $listTask->update($data);
        return $this->success("List Task Updated Successfully",  ListTaskResource::make($listTask));
    }


    public function delete($resource_id)
    {
        $listTask = ListTask::find($resource_id);
        if (!$listTask) {
            return $this->error("List Task Not Found", 404);
        }
        $listTask->delete();
        return $this->success("List Task Deleted Successfully",  ListTaskResource::make($listTask));
    }
}

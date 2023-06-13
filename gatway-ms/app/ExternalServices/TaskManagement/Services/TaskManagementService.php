<?php

namespace App\ExternalServices\TaskManagement\Services;

use App\ExternalServices\TaskManagement\Contracts\TaskManagementServiceInterface;
use App\Traits\ServiceCommunicationTrait;
use Illuminate\Http\Request;

class TaskManagementService extends BaseTaskManagementService implements TaskManagementServiceInterface
{
    use ServiceCommunicationTrait;

   public  function baseServiceUrl()
    {
        return 'TaskManagement/task';
    }

   public function UserGetHisTask()
   {
        return $this->forwardRequest(Request::METHOD_GET, $this->getFullServiceUrl(). '/User/Tasks');
  
   }

    public function UserAssignTask($task_id,$request_data)
    {   
       
        return $this->forwardRequest(Request::METHOD_POST, $this->getFullServiceUrl(). "/assign/$task_id", $request_data);

    }
    public function UserChangeStatusTask($task_id, $request_data)
    {

        return $this->forwardRequest(Request::METHOD_POST, $this->getFullServiceUrl() . "/User/change-status/$task_id", $request_data);
    }

    public function UserChangePriorityTask($task_id, $request_data)
    {

        return $this->forwardRequest(Request::METHOD_POST, $this->getFullServiceUrl() . "/User/change-priority/$task_id", $request_data);
    }
}

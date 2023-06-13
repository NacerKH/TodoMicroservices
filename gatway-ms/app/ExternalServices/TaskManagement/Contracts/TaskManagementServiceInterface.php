<?php
namespace App\ExternalServices\TaskManagement\Contracts;

use App\ExternalServices\Contracts\BaseApiServiceInterface;

interface TaskManagementServiceInterface   extends BaseApiServiceInterface
{
    public function UserGetHisTask();
    public function UserAssignTask($task_id, $request_data);
    public function UserChangeStatusTask($task_id, $request_data);
    public function UserChangePriorityTask($task_id, $request_data);
}

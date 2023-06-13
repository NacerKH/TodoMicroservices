<?php

namespace App\Modules\TodoList\Contracts;
use App\Modules\Concerns\BaseApiRepositoryInterface;

interface TaskRepositoryInterface extends BaseApiRepositoryInterface
{

  public function  findTaskByUser($user_id);
  public function  assigneTask($resource_id, $user_id);
  public function ChangePriority($task, $priority);
  public function  ChangeStatus($task, $status);
  

 
}

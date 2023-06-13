<?php

namespace App\Modules\TodoList\Contracts;
use App\Modules\Concerns\BaseApiRepositoryInterface;

interface TaskRepositoryInterface extends BaseApiRepositoryInterface
{

  public function  findTaskByUser($user_id);
  public function  assigneTask($resource_id, $user_id);

 
}

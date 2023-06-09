<?php

namespace App\Modules\ActivityLog\Repositories;


use App\Modules\ActivityLog\Models\ActivityLog;
use App\Modules\ActivityLog\Resources\ActivityLogResource;
use App\Modules\BaseApiRepository;


class ActivityLogRepository extends BaseApiRepository
{

    function model()
    {
        return ActivityLog::class;
    }

    public function index()
    {
      
        return $this->success(__('log.index'), ActivityLogResource::collection($this->model()::get()));
    }
}
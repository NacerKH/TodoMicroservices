<?php

namespace App\Modules\ActivityLog\Controllers;

use App\Modules\ActivityLog\Models\ActivityLog;
use App\Modules\ActivityLog\Repositories\ActivityLogRepository;

class ActivityLogController
{

    /**
     * ActivityLogsController constructor
     * @param ActivityLogRepository $activityLogRepository
     * @param ActivityLog $activityLog
     */
    public function __construct(private ActivityLogRepository $activityLogRepository, private ActivityLog $activityLog)
    {
        $this->activityLogRepository = $activityLogRepository;
        $this->activityLog = $activityLog;
    }


    public function index()
    {
        return $this->activityLogRepository->index();
    }
}
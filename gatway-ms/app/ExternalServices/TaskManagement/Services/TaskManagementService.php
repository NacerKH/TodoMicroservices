<?php

namespace App\ExternalServices\TaskManagement\Services;


use App\Traits\ServiceCommunicationTrait;

class TaskManagementService extends BaseTaskManagementService
{
    use ServiceCommunicationTrait;

    function baseServiceUrl()
    {
        return 'TaskManagement';
    }
}

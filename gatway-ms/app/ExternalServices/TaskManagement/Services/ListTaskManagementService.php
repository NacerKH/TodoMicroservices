<?php

namespace App\ExternalServices\TaskManagement\Services;

use App\ExternalServices\TaskManagement\Contracts\ListTaskManagementServiceInterface;
use App\Traits\ServiceCommunicationTrait;

class ListTaskManagementService extends BaseTaskManagementService implements ListTaskManagementServiceInterface
{
    use ServiceCommunicationTrait;

    function baseServiceUrl()
    {
        return 'TaskManagement/list-task';
    }
}

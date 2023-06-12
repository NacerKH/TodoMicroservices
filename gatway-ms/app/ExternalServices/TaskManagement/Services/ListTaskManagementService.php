<?php

namespace App\ExternalServices\TaskManagement\Services;


use App\Traits\ServiceCommunicationTrait;

class ListTaskManagementService extends BaseTaskManagementService
{
    use ServiceCommunicationTrait;

    function baseServiceUrl()
    {
        return 'TaskManagement/list-task';
    }
}

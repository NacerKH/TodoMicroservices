<?php
namespace App\ExternalServices\Contracts\Services;

use App\ExternalServices\Contracts\BaseApiServiceInterface;
use App\Traits\ServiceCommunicationTrait;
use Illuminate\Http\Request;

abstract class BaseApiService implements BaseApiServiceInterface
{
    use ServiceCommunicationTrait;

    abstract protected function getFullServiceUrl();

    public function index()
    {
        return $this->forwardRequest(Request::METHOD_GET, $this->getFullServiceUrl());
    }

    public function store($request_data)
    {
        return $this->forwardRequest(Request::METHOD_POST, $this->getFullServiceUrl(), $request_data);
    }

    public function show($resource_id)
    {
        return $this->forwardRequest(Request::METHOD_GET, $this->getFullServiceUrl() . '/' . $resource_id);
    }

    public function update($resource_id, $request_data)
    {
        return $this->forwardRequest(Request::METHOD_PUT, $this->getFullServiceUrl() . '/' . $resource_id, $request_data);
    }

    public function delete($resource_id)
    {
        return $this->forwardRequest(Request::METHOD_DELETE, $this->getFullServiceUrl() . '/' . $resource_id);
    }

    public function patch($request_data)
    {
        return $this->forwardRequest(Request::METHOD_PATCH, $this->getFullServiceUrl() . '/', $request_data);
    }


}

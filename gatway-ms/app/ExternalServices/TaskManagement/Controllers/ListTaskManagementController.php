<?php
namespace App\ExternalServices\TaskManagement\Controllers;

use App\ExternalServices\TaskManagement\Services\ListTaskManagementService;
use App\Http\Controllers\Controller;
use App\Traits\BaseApiResponse;
use Illuminate\Http\Request;

class ListTaskManagementController extends Controller
{
    use BaseApiResponse;


    /**
     * TaskManagementController constructor.
     * @param ListTaskManagementService $listTaskManagementService
     * 
     */
    public function __construct(private ListTaskManagementService $listTaskManagementService){}
    

    public function index()
    {
        return $this->listTaskManagementService->index();
    }
    public function store(Request $request)
    {
        return $this->listTaskManagementService->store($request->all());
    }

    public function show($resource_id)
    {
        return $this->listTaskManagementService->show($resource_id);
    }
 

    public function update(Request $request, $resource_id)
    {
        return $this->listTaskManagementService->update($resource_id, $request->all());
    }

    public function destroy($resource_id)
    {
        return $this->listTaskManagementService->delete($resource_id);
    }
}

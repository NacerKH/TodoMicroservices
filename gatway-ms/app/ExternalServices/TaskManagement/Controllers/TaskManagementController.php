<?php
namespace App\ExternalServices\TaskManagement\Controllers;




use App\ExternalServices\TaskManagement\Services\TaskManagementService;
use App\Http\Controllers\Controller;
use App\Traits\BaseApiResponse;
use Illuminate\Http\Request;

class TaskManagementController extends Controller
{
    use BaseApiResponse;


    /**
     * TaskManagementController constructor.
     * @param TaskManagementService $taskManagementService
     * 
     */
    public function __construct(private TaskManagementService $taskManagementService){}
    

    public function index()
    {
        return $this->taskManagementService->index();
    }
    public function store(Request $request)
    {
        return $this->taskManagementService->store($request->all());
    }

    public function show($resource_id)
    {
        return $this->taskManagementService->show($resource_id);
    }
 

    public function update(Request $request, $resource_id)
    {
        return $this->taskManagementService->update($resource_id, $request->all());
    }

    public function destroy($resource_id)
    {
        return $this->taskManagementService->delete($resource_id);
    }
}

<?php

namespace App\Modules\TodoList\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TodoList\Repositories\ListTaskRepository;
use App\Modules\TodoList\Requests\ListTaskRequest;

class ListTaskController extends Controller
{

    public function __construct(private ListTaskRepository $listTaskRepository)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->listTaskRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListTaskRequest $request)
    {
        return $this->listTaskRepository->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($resource_id)
    {
        return $this->listTaskRepository->show($resource_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListTaskRequest $request, $resource_id)
    {
        return $this->listTaskRepository->update($resource_id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($resource_id)
    {
        return $this->listTaskRepository->delete($resource_id);
    }
}

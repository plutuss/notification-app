<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\QueryFilter;
use App\Filters\TaskFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Requests\Api\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{


    /**
     * @param TaskFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(TaskFilter $filter): AnonymousResourceCollection
    {
        $tasks = Task::query()
            ->with(['taskStatus', 'user'])
            ->filter($filter)
            ->paginate(9);

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreTaskRequest $request): Response
    {

    }


    /**
     * @param Task $task
     * @return TaskResource
     */
    public function show(Task $task): TaskResource
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTaskRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateTaskRequest $request, int $id): Response
    {
        dd($request->validate(), '1213');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        Task::find($id)->delete();
        return response(['msg' => 'Ok! Task delete']);
    }
}

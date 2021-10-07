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
     * @param StoreTaskRequest $request
     * @return Response
     */
    public function store(StoreTaskRequest $request): Response
    {
        $task = Task::query()->create(
            $request->only([
                'title',
                'deadline',
                'description',
                'user_id',
                'task_status_id',
            ])
        );

        return response([
            'task' => new TaskResource($task),
            'msg' => __('messages.add_task')
        ]);
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
     * @param Task $task
     * @return Response
     */
    public function update(UpdateTaskRequest $request, Task $task): Response
    {
        $task->update($request->only([
            'title',
            'deadline',
            'description',
            'user_id',
            'task_status_id',
        ]));

        return response([
            'task' => new TaskResource($task),
            'msg' => __('messages.update_task')
        ]);
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
        return response([
            'msg' => __('messages.delete_task')
        ]);
    }
}

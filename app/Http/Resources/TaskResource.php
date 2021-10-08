<?php

namespace App\Http\Resources;

use App\Models\TaskStatus;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->id,
            'title' => $this->title,
            'deadline' => $this->deadline,
            'description' => $this->description,
            'user' => [
                'id' => $this->user_id,
                'name' => $this->user->name
            ],
            'task_status' => [
                'id' => $this->task_status_id,
                'name' => $this->taskStatus->name
            ],
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        $tasksStatusId = TaskStatus::query()->inRandomOrder()->first()->id;

        return [
            'title' => $this->faker->sentence(3),
            'deadline' => $this->getDeadlineDate($tasksStatusId),
            'description' => $this->faker->paragraphs(2, true),
            'user_id' => User::factory(),
            'task_status_id' => $tasksStatusId,
        ];
    }

    /**
     * @param int $tasksStatusId
     * @return Carbon
     */
    protected function getDeadlineDate(int $tasksStatusId): Carbon
    {
        if ($tasksStatusId != 4) {
            return $deadlineDate = Carbon::now()->addDay(rand(1, 30));
        }

        return $deadlineDate = Carbon::now()->subDays(10);
    }
}

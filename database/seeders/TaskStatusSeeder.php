<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TaskStatusSeeder extends Seeder
{
    private $statuses = ['Pending', 'In progress', 'Testing', 'Done'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses as $status) {
            TaskStatus::query()->create([
                'name' => $status,
            ]);
        }
    }
}

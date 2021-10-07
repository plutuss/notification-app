<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatus extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug',
    ];


    /**
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->HasMany(Task::class);
    }
}

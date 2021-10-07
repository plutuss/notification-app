<?php

namespace App\Models;

use App\Filters\QueryFilter;
use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    use UuidForKey;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'deadline',
        'description',
        'user_id',
        'task_status_id',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'deadline'
    ];


    /**
     * @return BelongsTo
     */
    public function taskStatus(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder $builder
     * @param QueryFilter $filter
     * @return Builder
     */
    public function scopeFilter(Builder $builder, QueryFilter $filter): Builder
    {
        return $filter->apply($builder);
    }
}
